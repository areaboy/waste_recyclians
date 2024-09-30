<?php
error_reporting(0); 
?>



<?php
session_start();
include ('backend/session_authenticate.php');
include ('backend/settings.php');

$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$country_sess =   htmlentities(htmlentities($_SESSION['country'], ENT_QUOTES, "UTF-8"));
$country_nickname_sess =   htmlentities(htmlentities($_SESSION['country_nickname'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo'], ENT_QUOTES, "UTF-8"));
$address_sess =  htmlentities(htmlentities($_SESSION['address'], ENT_QUOTES, "UTF-8"));
$lat_sess = htmlentities(htmlentities($_SESSION['lat'], ENT_QUOTES, "UTF-8"));
$lng_sess = htmlentities(htmlentities($_SESSION['lng'], ENT_QUOTES, "UTF-8"));
$map_zoom_sess = htmlentities(htmlentities($_SESSION['map_zoom'], ENT_QUOTES, "UTF-8"));
?>




<!DOCTYPE html>
<html lang="en">

<head>
 <title><?php echo $title; $titlex = $title; ?> - Welcome <?php echo $fullname_sess; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="<?php echo $description; ?>" />

<link rel="stylesheet" href="css/index_dashboard3.css">
<link rel="stylesheet" href="bootstraps/bootstrap.min.css">
<script src="jquery/jquery.min.js"></script>
<script src="bootstraps/bootstrap.min.js"></script>
<script src="javascript/moment.js"></script>
<script src="javascript/livestamp.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
<script>

// stopt all bootstrap drop down menu from closing on click inside
$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

</script>



</head>

<body>
    <div>



<!-- start column nav-->


<div class="text-center">
<nav class="navbar navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navgator">
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span> 
        <span class="navbar-header-collapse-color icon-bar"></span>                       
      </button>
     
<li class="navbar-brand home_click imagelogo_li_remove" ><img title='logo' alt='logo' class="img-rounded imagelogo_data" src="image/logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">


      <ul class="nav navbar-nav navbar-right">





 <li class="navgate_no">
<a title='Back to Dashboard' href="dashboard.php" style="color:white;font-size:14px;border-radius:50%">
<button class="category_post1">Back to Dashboard</button></a></li>

       <li class="navgate_no" >
<a title='Logout' href="logout.php" style="color:white;font-size:14px;border-radius:50%">
<button class="category_post1">Logout</button></a></li>       



      </ul>




    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->








<br>

<center><h3>Welcome  <b><?php echo $fullname_sess;?></b></h3></center>

<center><h3> Map Locations of all Waste Recycling Companies in <b><?php echo $country_sess;?></b> </h3></center>





<!-- map  modal starts here -->



<!-- start map loading-->
<style>
#map {
        height: 80%;
      }
    
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
.res_center_css{
position:absolute;top:50%;left:50%;margin-top: -50px;margin-left -50px;width:100px;height:100px;
}

</style>

<div id="loader" class='res_center_css'></div>

    <div style='height:1000px;' id="map"></div>

    <script>
      var customLabel = {
        Vaccine: {
          label: 'P'
        }
      };


var latx='<?php echo $lat_sess; ?>';
var lngx='<?php echo $lng_sess; ?>';
var zoomx ='<?php echo $map_zoom_sess; ?>';

// convert Latitude Longitue to Float
const latx_convert = parseFloat(latx);
const lngx_convert = parseFloat(lngx);
const zoomx_convert = parseFloat(zoomx);


//   center: new google.maps.LatLng(39.78373, -100.445882),
//zoom: 5
        function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(latx_convert, lngx_convert),
          zoom: zoomx_convert
        });
        var infoWindow = new google.maps.InfoWindow;

$('#loader').fadeIn(400).html('<br><div style="color:black;background:#c1c1c1;padding:10px;"><img src="loader.gif">  &nbsp; &nbsp;Please Wait, Google Map is being Loaded...</div>');

          //downloadUrl('map1_backend.php', function(data) {
			  downloadUrl('backend/map_all_waste_recycling_companies.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              
var id = markerElem.getAttribute('id');
              //var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
var timing = markerElem.getAttribute('timing');
//var data_type = markerElem.getAttribute('data_type');
 var type = markerElem.getAttribute('type');
var email = markerElem.getAttribute('email');
var company_name = markerElem.getAttribute('company_name');
var photo =markerElem.getAttribute('photo');
var company_desc =markerElem.getAttribute('company_desc');
var country =markerElem.getAttribute('country');
var lati =markerElem.getAttribute('lat');
var lngi =markerElem.getAttribute('lng');

              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

$('#loader').hide();

              var infowincontent = document.createElement('div');
             var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};


                var map_data = "<div style='background:#c1c1c1; border-bottom: 2px dashed #008080;'>" +
"<div style='background:purple;color:white;padding:10px;'>Map Location</div><br />" +
//"<a target='_blank' title='Click' class='btn btn-primary' href=map.php?id=" + timing +" >Click</a><br><br>" +

"<img src='backend/company_photos/" + photo +"' style='width:100px;max-width:100px;max-height:100px;height:100px;' class='pull-right img-rounded'>" +
"<h3><b>Company Name:</b> " + company_name + "</h3>" +
"<span><b>Company Description:</b> " + company_desc + "</span><br />" +
"<span><b>Company Email:</b> " + email + "</span><br />" +
"<span><b>Latitude:</b> " + lati + "</span><br />" +
"<span><b>Longitude:</b> " + lngi + "</span><br />" +
"<span><b>Location Address: </b>" + address + "</span><br />" +
"<span><b>Country: </b>" + country + "</span><br />" +

  "<span><b> <span class='fa fa-calendar'></span>Time Published: </b></span>" +
"<span data-livestamp='" + timing + "'></span></span><br /><br />"+
                    "</div>";



              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label,
 title : 'welcome'
              });
              marker.addListener('click', function() {
                //infoWindow.setContent(infowincontent);

//infoWindow.setContent('<b>'+name + "</b><br>" + address);

infoWindow.setContent(map_data);
                infoWindow.open(map, marker);
              });
            });
          });
		  
		  // });  // close jquery clickbutton
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}

 $('#myModal_map').on('shown.bs.modal', function(){
    //init();
initMap();

    });


    </script>

  


<!-- end map loading-->


<!-- map modal ends here -->


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_keys; ?>&callback=initMap">
    </script>








</body>
</html>

