<?php
error_reporting(0);

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

include('db_connection.php');

$id = strip_tags($_POST['id']);
$country = strip_tags($_POST['country']);

$return_arr = array();


$result = $db->prepare('SELECT * FROM company WHERE country=:country order by id desc');
$result->execute(array(':country'=>$country));
$nosofrows = $result->rowCount();
if($nosofrows  == 0){
echo "<div style='background:red;color:white;padding:10px;border:none'>No Waste Recycling Company Registered for <b>$country</b> Yet....</div>";
}

if($nosofrows  > 0){
echo "<div style='background:green;color:white;padding:6px;border:none'>List of Nearby  Waste Recycling Companies in <b>$country</b></div>";
}

while($rowv = $result->fetch()){
$id = $rowv['id'];
$company_name = $rowv['company_name'];
$company_desc = $rowv['company_desc'];
$email = $rowv['email'];
$address = $rowv['address'];
$lat = $rowv['lat'];
$lng = $rowv['lng'];
$photo = $rowv['photo'];
$country = $rowv['country'];
$website = $rowv['website'];
?>



<div style='background:#ccc;color:black;border-radius:15%;padding:6px; border:none;' class='cat_cssx col-sm-12'>

<b>Company Name:</b><?php echo $company_name; ?><br>

<b>Address:</b><?php echo $company_name; ?><br>
<b>Website:</b> <a href='<?php echo $website; ?>' target='_blank'><?php echo $website; ?></a><br>
<br>
<div class='col-sm-6'>
<button class='map_call_btn2 btn_map_locations2 btn btn-success btn-xs' data-country='<?php echo $country; ?>' data-company_name='<?php echo $company_name; ?>' data-company_address='<?php echo $address; ?>' data-id='<?php echo $id; ?>' data-lat='<?php echo $lat; ?>' data-lng='<?php echo $lng; ?>' title='Map Geo-Location' data-toggle='modal' data-target='#myModal_maploc'>Map Geo-Location</button></div>

<div class='col-sm-6'>
<button class='btn_map_refresh2 map_call_btn2 btn_map_locations2 btn btn-warning btn-xs' data-country='<?php echo $country; ?>' data-company_name='<?php echo $company_name; ?>' data-company_address='<?php echo $address; ?>'  data-id='<?php echo $id; ?>' data-lat='<?php echo $lat; ?>' data-lng='<?php echo $lng; ?>' title='Map Direction' data-toggle='modal' data-target='#myModal_mapdir'>Map Direction</button></div>


</div>

<?php
}




}else{
echo "<div style='background:red;padding:8px;color:white;border:none;'>Direct PageAccess not Allowed...</div>";
}



?>
