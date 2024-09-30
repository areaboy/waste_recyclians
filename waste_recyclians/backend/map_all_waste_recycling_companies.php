<?php 
 // ensure that there is no whitespace and included file db_connection.php does not have whitespace
//error_reporting(0);
session_start();
$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$country_sess =   htmlentities(htmlentities($_SESSION['country'], ENT_QUOTES, "UTF-8"));
$country_nickname_sess =   htmlentities(htmlentities($_SESSION['country_nickname'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo'], ENT_QUOTES, "UTF-8"));
$address_sess =  htmlentities(htmlentities($_SESSION['address'], ENT_QUOTES, "UTF-8"));
$lat_sess = htmlentities(htmlentities($_SESSION['lat'], ENT_QUOTES, "UTF-8"));
$lng_sess = htmlentities(htmlentities($_SESSION['lng'], ENT_QUOTES, "UTF-8"));
$map_zoom_sess = htmlentities(htmlentities($_SESSION['map_zoom'], ENT_QUOTES, "UTF-8"));
header("Content-type: text/xml");
include('db_connection.php');
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
//$company_id = strip_tags($_GET['company_id']);
$result = $db->prepare("SELECT * FROM company where country=:country");
$result->execute(array(':country' =>$country_sess));
//header("Content-type: text/xml");
while ($v1 = $result->fetch()) {
                $id = $v1['id'];
                $companyid = $v1['id'];
                $email = $v1['email'];
                $company_name = $v1['company_name'];
                $company_desc = $v1['company_desc'];
                $timing = $v1['timing'];
                $photo = $v1['photo'];
                $address = $v1['address'];
                $lat = $v1['lat'];
                $lng = $v1['lng'];
                $country = $v1['country'];
                $data ='public';
                $type = 1;
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id",$id);
  $newnode->setAttribute("email",$email);
$newnode->setAttribute("company_name", $company_name);
$newnode->setAttribute("company_desc", $company_desc);
$newnode->setAttribute("timing", $timing);
$newnode->setAttribute("photo", $photo);
  $newnode->setAttribute("address", $address);
  $newnode->setAttribute("lat", $lat);
  $newnode->setAttribute("lng", $lng);
  $newnode->setAttribute("type", $type);
  $newnode->setAttribute("data_type", $data);
 $newnode->setAttribute("country", $country);
}
echo $dom->saveXML();
?>
