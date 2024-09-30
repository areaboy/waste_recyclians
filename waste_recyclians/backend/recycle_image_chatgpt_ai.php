<?php
//error_reporting(0);

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

session_start();
$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$country_sess =   htmlentities(htmlentities($_SESSION['country'], ENT_QUOTES, "UTF-8"));
$country_nickname_sess =   htmlentities(htmlentities($_SESSION['country_nickname'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo'], ENT_QUOTES, "UTF-8"));
$address_sess =  htmlentities(htmlentities($_SESSION['address'], ENT_QUOTES, "UTF-8"));
$lat_sess = strip_tags($_SESSION['lat']);
$lng_sess = strip_tags($_SESSION['lng']);
$map_zoom_sess = strip_tags($_SESSION['map_zoom']);

$title_post="Waste Recycling by $fullname_sess";

include('settings.php');
include('db_connection.php');

$ai_model = strip_tags($_POST['ai_model']);
$rewards = strip_tags($_POST['rewards']);


$file_content = strip_tags($_POST['file_fname']);
	
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$mt = microtime(true);
$mdx = md5($mt);
$uidx = uniqid();
$userid = $uidx.$timer.$mdx;
$tit = $uidx.$timer.$mdx;


if ($file_content == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Files Upload is empty</div>";
exit();
}


if ($ai_model == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>AI Model is empty</div>";
exit();
}

if ($rewards == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Users Rewards is empty</div>";
exit();
}



$upload_path = "recycle_waste_images/";

$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>File Formats not allowed. Only Images are allowed.<br></div>";
exit();
}


$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

if ($fsize > 50 * 1024 * 1024) { // allow file of less than 5 mb
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>File greater than 50 mb not allowed<br></div>";
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
 echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Only Images are allowed<br><br></div>";
exit();
}

//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);


if ( ! ( in_array($mime, $allowed_types) ) ) {
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Only Images are allowed...<br></div>";
exit();
}
finfo_close($finfo);

$final_filename =$userid.$filename_string;



if (move_uploaded_file($ftmp, $upload_path . $final_filename)) {

//Process the Uploaded Image by AI..



// Start ChatGPT Image Analysis

$url ="https://api.openai.com/v1/chat/completions";

//$file_path = $_FILES["file_content"]["name"];

$file_path = "recycle_waste_images/$final_filename";
$file_type = pathinfo($file_path, PATHINFO_EXTENSION);
$file_image = file_get_contents($file_path);
$image_base64 = 'data:image/' . $file_type . ';base64,' . base64_encode($file_image);

$data_param='{
    "model": "gpt-4o",
    "messages": [
      {
        "role": "user",
        "content": [
          {
            "type": "text",
            "text": "What is in this image.? list their quantities"
          },
          {
            "type": "image_url",
            "image_url": {
              "url": "'.$image_base64.'"
            }
          }
        ]
      }
    ],
    "max_tokens": 300
  }';



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $chatgpt_accesstoken"));  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch); 

if($output == ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>API Call to Chatgpt AI Failed. Ensure there is an Internet  Connections...</div><br>";
exit();
}

$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// catch error message before closing
if (curl_errno($ch)) {
   //echo $error_msg = curl_error($ch);
}

curl_close($ch);



$json = json_decode($output, true);
$id = $json["id"];

$mx_error = $json["error"]["message"];
if($mx_error != ''){
echo "<div id='alerts_recyclea' style='background:red;color:white;padding:10px;border:none;'>Chatgpt API Error Message: $mx_error.</div><br>";
//exit();
}

if($http_status == 400){
echo "<div id='alerts_recycle' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT request was malformed or missing some required parameters</div><br>";
exit();
}

if($http_status == 429){
echo "<div id='alerts_recycle' style='background:red;color:white;padding:10px;border:none;'>You have hit your OpenAI/ChatGPT assigned rate limit.</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_recycle' style='background:red;color:white;padding:10px;border:none;'>You have exceeded the allowed number of tokens in your OpenAI/ChatGPT request.</div><br>";
exit();
}

if($http_status == 401){
echo "<div id='alerts_recycle' style='background:red;color:white;padding:10px;border:none;'> OpenAI/ChatGPT API key or token was invalid, expired, or revoked.</div><br>";
exit();
}

if($http_status == 404){
echo "<div id='alerts_recycle' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT requested resource API Model was not found</div><br>";
exit();
}

if($http_status == 500){
echo "<div id='alerts_recycle' style='background:red;color:white;padding:10px;border:none;'>An issue occurred on the OpenAI/ChatGPT server side</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_recycle' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT API key or token lacks the required permissions</div><br>";
exit();
}

if($http_status == 200){
//echo "<div style='background:green;color:white;padding:10px;border:none;'>Chatgpt API Call Successful....</div><br>";

if($id != ''){
//echo "<div style='background:green;color:white;padding:10px;border:none;'>Chatgpt API Response Successfully Generated....</div><br>";
$content = $json["choices"][0]["message"]["content"];

//$val = str_replace(',', ',<br>', $content);
//$val2 = str_replace('.', '<br>', $content);




// Database OPERTAION Starts

$statement = $db->prepare('INSERT INTO posts
(title,title_seo,content,fullname,timer,userid,userphoto,points,total_comments,total_like,reward_type,ai_model,country_nickname,country_name,recycle_image)
                          values
(:title,:title_seo,:content,:fullname,:timer,:userid,:userphoto,:points,:total_comments,:total_like,:reward_type,:ai_model,:country_nickname,:country_name,:recycle_image)');

$statement->execute(array( 
':title' => $title_post,
':title_seo' => $tit,
':content' => $content,		
':fullname' => $fullname_sess,
':timer' => $timer,
':userid' =>$userid_sess,
':userphoto' =>$photo_sess,
':points' =>$points,
':total_comments' =>'0',
':total_like' =>'0',
':reward_type' =>$rewards,
':ai_model' =>$ai_model,
':country_nickname' =>$country_nickname_sess,
':country_name' =>$country_sess,
':recycle_image' => $final_filename
));


$stmtx = $db->query("SELECT LAST_INSERT_ID()");
$lastInserted_Id = $stmtx->fetchColumn();




// get users points and make updates
$result_u = $db->prepare('SELECT * FROM users where userid =:userid');
$result_u->execute(array(':userid' => $userid_sess));
$nosofrows_u = $result_u->rowCount();
$row_u = $result_u->fetch();
$user_point = $row_u['points'];
$user_point_added = $user_point + 100;	

// update users Tables for users points
$result = $db->prepare('UPDATE users set points=:points where userid =:userid');
$result->execute(array(':points' => $user_point_added, ':userid' => $userid_sess));

// update posts table for users points
$result = $db->prepare('UPDATE posts set points=:points where userid =:userid');
$result->execute(array(':points' => $user_point_added, ':userid' => $userid_sess));


// send post broadcast notifications to all Recyclers of a Particular Country when  new Waste is Recycled or Post is created

$result = $db->prepare('SELECT * FROM users where country_nickname =:country_nickname');
$result->execute(array(':country_nickname' => $country_nickname_sess));
$nosofrows = $result->rowCount();


if($nosofrows > 0){
//foreach($row['data'] as $v1){
while($row = $result->fetch()){

$reciever_userid = $row['id'];
$reciever_userid2 = $row['userid'];
		    
//insert into notification table	

$statement1 = $db->prepare('INSERT INTO notification
(post_id,userid,fullname,photo,reciever_id,status,type,timing,title,title_seo)
                        values
(:post_id,:userid,:fullname,:photo,:reciever_id,:status,:type,:timing,:title,:title_seo)');
$statement1->execute(array( 

':post_id' => $lastInserted_Id,
':userid' => $userid_sess,
':fullname' => $fullname_sess,
':photo' => $photo_sess,
':reciever_id' => $reciever_userid2,
':status' => 'unread',
':type' => 'post',
':timing' => $timer,
':title' => $title_post,
':title_seo' => $tit
));

}
}

if($statement){
echo  "<script>alert('Image AI Analysis Successfully Generated');</script>";
echo "<div style='background:green;padding:8px;color:white;border:none;'>Image AI Analysis Successfully Generated..</div>";
echo "<script>
location.reload();

</script>
";

}else{
echo "<div id='alerts_recycle' style='background:red;padding:8px;color:white;border:none;'>Image AI Processing  Failed...</div>";
}

// Database Operation Ends






}



}

// end ChatGpt Image Analysis







}// close file upload

}


?>



