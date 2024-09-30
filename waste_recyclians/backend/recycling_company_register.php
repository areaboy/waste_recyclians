<?php
//error_reporting(0);

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

include('settings.php');
include('db_connection.php');


if($google_map_keys ==''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Google Map API Key is Empty...Please set at folder backend/settings.php file</div>";
exit();
}

$company_name = strip_tags($_POST['company_name']);
$company_desc = strip_tags($_POST['company_desc']);
$email = strip_tags($_POST['email']);
$address = strip_tags($_POST['address']);
$country = strip_tags($_POST['country']);
$website = strip_tags($_POST['website']);

$file_content = strip_tags($_POST['file_fname']);
	
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$mt = microtime(true);
$mdx = md5($mt);
$uidx = uniqid();
$userid = $uidx.$timer.$mdx;




if ($file_content == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Files Upload is empty</div>";
exit();
}


if ($company_name == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Company Name is empty</div>";
exit();
}

if ($company_desc == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Company Detail is empty</div>";
exit();
}


if ($address == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Company Address is empty</div>";
exit();
}

if ($email == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Company Email Address is empty</div>";
exit();
}

$em= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$em){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Email Address is Invalid</div>";
exit();
}




$address_val ="$address $country";

// convert geo location address to longitude and latitude using google geo-coding API.
$address_data = urlencode($address_val);
// geocode geo location address to longitudes and latitudes

$call_url ="https://maps.googleapis.com/maps/api/geocode/json?key=$google_map_keys&address=$address_data&sensor=false";
 $res = file_get_contents($call_url);
 $json = json_decode($res, true);
//print_r($json);

        if($json['status']='OK'){

         $lat = $json['results'][0]['geometry']['location']['lat'];
         $lng = $json['results'][0]['geometry']['location']['lng'];
         $formatted_address = $json['results'][0]['formatted_address'];

}else{
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Address Could not be Formatted via Google Map Reverse Geo-Codings</div>";
exit();
}
         $lat = $json['results'][0]['geometry']['location']['lat'];
         $lng = $json['results'][0]['geometry']['location']['lng'];
	

// check if company with this email already exits
$result_verified = $db->prepare('select * from company where email=:email');
$result_verified->execute(array(':email' =>$email));

 $rows= $result_verified->fetch();
$norows= $result_verified->rowCount();

if($norows ==1){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>This Email Address already exist</div>";
exit();
}	 


$upload_path = "company_photos/";

$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>File Formats not allowed. Only Images are allowed.<br></div>";
exit();
}


$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

if ($fsize > 50 * 1024 * 1024) { // allow file of less than 5 mb
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>File greater than 50 mb not allowed<br></div>";
exit();
}



$allowed_types=array(
'image/gif',
'image/jpeg',
'image/png',
'image/jpg',
'image/GIF',
'image/JPEG',
'image/PNG',
'image/JPG'
);

if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
 echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Only Images are allowed<br><br></div>";
exit();
}

//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);


if ( ! ( in_array($mime, $allowed_types) ) ) {
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_reg'>Only Images are allowed...<br></div>";
exit();
}
finfo_close($finfo);

//insert into database
$final_filename =$userid.$filename_string;
//hash password before sending it to database...
$options = array("cost"=>4);
$hashpass = password_hash($password,PASSWORD_BCRYPT,$options);


if (move_uploaded_file($ftmp, $upload_path . $final_filename)) {

$statement = $db->prepare('INSERT INTO company
(email,company_name,company_desc,created_time,timing,address,photo,lat,lng,country_name,country,website)
                          values
(:email,:company_name,:company_desc,:created_time,:timing,:address,:photo,:lat,:lng,:country_name,:country,:website)');

$statement->execute(array( 
':email' => $email,
':company_name' => $company_name,
':company_desc' => $company_desc,		
':created_time' => $created_time,
':timing' => $timer,
':address' => $address,
':lat' => $lat,
':lng' => $lng,
':country_name' => $country,
':photo' =>$final_filename,
':country' =>$country,
':website' =>$website
));


$stmtx = $db->query("SELECT LAST_INSERT_ID()");
$lastInserted_Id = $stmtx->fetchColumn();

if($statement){
echo  "<script>alert('Company Data Successfully Created.');</script>";
echo "<div id='alerts_reg' style='background:green;padding:8px;color:white;border:none;'>Company Data Successfully Created.</div>";

}else{
echo "<div id='alerts_reg' style='background:red;padding:8px;color:white;border:none;'>Company Account Creation Failed...</div>";
}

}// close file upload

}


?>



