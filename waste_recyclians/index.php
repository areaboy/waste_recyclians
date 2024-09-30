<?php 
//error_reporting(0);
include('backend/settings.php');
//check if Site Url is Empty in the settings.php file

if($site_url == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set the Site URL to point to main application folder by editing
<b>(backend/settings.php)</b> File</div>";
exit();
}


// Check if Google Map Javascript API Key has been Set
if($google_map_keys == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set  Google Map Javascript API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


//Check if OpenAI ChatGPT API Key has been Set
if($chatgpt_accesstoken == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set  OpenAi ChatGPT API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


// Check if Google Gemini API Key has been Set
if($google_gimini_apikey == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set Google Gemin API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
 <title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo $description; ?>" />

<link rel="stylesheet" href="css/index1.css">
<link rel="stylesheet" href="bootstraps/bootstrap.min.css">
<script src="jquery/jquery.min.js"></script>
<script src="bootstraps/bootstrap.min.js"></script>


</head>
<body>

<!--start left column all-->
<div class="left-column-all left_shifting">
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
     <li class="navbar-brand home_click imagelogo_li_remove" ><img title='<?php  echo $title; ?>-logo' alt='<?php  echo $title; ?>-logo' class="img-rounded imagelogo_data" src="image/logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">



      <ul class="nav navbar-nav navbar-right">





      </ul>


    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->


<script>

// users signup starts

function imagePreview(e) 
{
 var readImage = new FileReader();
 readImage.onload = function()
 {
  var displayImage = document.getElementById('imageupload_preview');
  displayImage.src = readImage.result;
 }
 readImage.readAsDataURL(e.target.files[0]);
}


            $(function () {
                $('#save_btn').click(function () {
					
				
                    var email = $('#email_u').val();
                    var password = $('#password_u').val();
                    var confirm_password =$('#confirm-password_u').val();
                    var fullname = $('#fullname_u').val();
                    var file_fname = $('#file_content').val();
                    var country = $(".country_selected").val();
                    var address = $('#address_u').val();
                    //preparing Email for validations
                    var atemail = email.indexOf("@");
                    var dotemail = email.lastIndexOf(".");

if(password != confirm_password){
alert('Password Does not Match');
return false;
}

// start if validate
if(file_fname==""){
alert('please Select File to Upload');
}




else if(email==""){
alert('please Enter Email Address');
}

else  if (atemail < 1 || ( dotemail - atemail < 2 )){
alert("Please enter valid email Address")
}


else if(password==""){
alert('please Enter Password');
}


else if(fullname==""){
alert('please Enter Your Fullname');
}

else if(address==""){
alert('please Enter Your Full Location Address');
}


else if(country==""){
alert('please Reload or Refresh the Page and Try Again..');
}


else{

var fname=  $('#file_content').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a Valid image. Only Images Files are allowed");
return false;
    }


          var form_data = new FormData();
          form_data.append('file_content', $('#file_content')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('email', email);
          form_data.append('fullname', fullname);
          form_data.append('password', password);
          form_data.append('country', country);
          form_data.append('address', address);

                    $('.upload_progress').css('width', '0');
                    $('#btn').attr('disabled', 'disabled');
					$('#loaderx').hide();
                    $('#loader').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Data is being  Submitted.</div>');
                    $.ajax({
                        url: 'backend/signup.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress').css('width', upload_percent + '%');
                                    $('.upload_progress').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader').hide();
				$('.result_data').fadeIn('slow').prepend(msg);
				$('#alerts_signup').delay(5000).fadeOut('slow');
                                $('#alerts_signupx').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content').val('');
$('#email_u').val('');
$('#fullname_u').val('');
$('#password_u').val('');
$('#confirm-password_u').val('');
$('#address_u').val('');
$(".country_selected").val('');
}




                        }
                    });
} // end if validate




                });
            });

// user registration ends





//users login starts

$(document).ready(function(){
$('#login_btn_user').click(function () {

var email  = $('#email_user').val();
var password = $('#password_user').val();



 if(email==""){
alert('please Enter Email');
}

else if(password==""){
alert('please Enter Password');
}




else{


$("#loader-login_user").fadeIn(400).html('<br><div style="color:black;background:#ccc;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Your are being login as User...</div>');
var datasend = {email:email, password:password};


	
		$.ajax({
			
			type:'POST',
			url:'backend/login.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-login_user").hide();
$("#result-login_user").html(msg);
setTimeout(function(){ $("#result-login_user").html(''); }, 5000);

                        
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (sucessful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/sucessful/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#email_user').val('');		
$('#password_user').val('');	
}

	
}
			
		});
		
		}

});

});

//  users login ends




// company regitration  starts

function imagePreview2(e) 
{
 var readImage2 = new FileReader();
 readImage2.onload = function()
 {
  var displayImage2 = document.getElementById('imageupload_preview2');
  displayImage2.src = readImage2.result;
 }
 readImage2.readAsDataURL(e.target.files[0]);
}


            $(function () {
                $('#register_btn').click(function () {
					
				
                    var email = $('#company_email').val();
                    var company_name = $('#company_name').val();
                    var company_desc =$('#company_desc').val();
                    var address = $('#address').val();
                    var file_fname = $('#file_content2').val();
                    var country = $(".country_selected2").val();
var website = $('#website').val();

                    //preparing Email for validations
                    var atemail = email.indexOf("@");
                    var dotemail = email.lastIndexOf(".");



// start if validate
if(file_fname==""){
alert('please Select File logo to Upload');
}




else if(email==""){
alert('please Enter Email Address');
}

else  if (atemail < 1 || ( dotemail - atemail < 2 )){
alert("Please enter valid email Address")
}


else if(company_name==""){
alert('please Enter Company Name');
}


else if(company_desc==""){
alert('please Enter Your Company Description');
}


else if(website==""){
alert('please Enter Your Company Website URL');
}


else if(address==""){
alert('please Enter Your Company Full Location Address');
}


else{

var fname=  $('#file_content2').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a Valid image. Only Images Files are allowed");
return false;
    }


          var form_data = new FormData();
          form_data.append('file_content', $('#file_content2')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('email', email);
          form_data.append('company_name', company_name);
          form_data.append('company_desc', company_desc);
          form_data.append('address', address);
          form_data.append('country', country);
form_data.append('website', website);

                    $('.upload_progress2').css('width', '0');
                    $('#btn').attr('disabled', 'disabled');
					$('#loaderx').hide();
                    $('#loader2').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Company Data is being  Submitted.</div>');
                    $.ajax({
                        url: 'backend/recycling_company_register.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress2').css('width', upload_percent + '%');
                                    $('.upload_progress2').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader2').hide();
				$('.result_data2').fadeIn('slow').prepend(msg);
				$('#alerts_rego').delay(5000).fadeOut('slow');
                                $('#alerts_reg').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content2').val('');
$('#company_email').val('');
$('#company_name').val('');
$('#company_desc').val('');
$('#address').val('');
$(".country_selected2").val('');
$('#website').val('');
}




                        }
                    });
} // end if validate




                });
            });


// company registration ends



// Show Country Selection Modal on Page Load
$(document).ready(function(){
$('#myModal_country').modal('show');
});

// Gemini Text Prompt Analysis starts

$(document).ready(function(){
$(".co_btn").click(function() {

var country = $(".co:checked").val();
 if(country==undefined){
alert('Please Select Country to Proceed');
return false;
}
//$(".co").val('');


 $('.country_selected').val(country).value;
$('.country_selected2').val(country).value;

 $('.country_selected_html').html(country);

if(confirm("You Selected...." +country)){
//hide Country selection Modal...	  
$('#myModal_country').modal('hide');
this.checked = false;  //javascript
//$(this).prop('checked', false);	
}

});
});
</script>





<!-- Recyclng Companies Registration Modal starts -->



<div id="myModal_recycling_company_registers" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header"  style='background: #B931B9;color:white;padding:10px;'>
        <h4 class="modal-title">Waste Recycling Company Data Registration System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


<input type='hidden' class='country_selected2' value=''>
<div class="form-group">
<label style="">Select Company Photo Logo: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content2" name="file_content2" accept="image/*" onchange="imagePreview2(event)" />
 <img id="imageupload_preview2"/>
</div><br>





 <div class="form-group">
              <label> Company Name: </label>
              <input type="text" class="col-sm-12 form-control" id="company_name" name="company_name" placeholder="Company Name.">
            </div>


 <div class="form-group">
              <label> Company Email: </label>
              <input type="text" class="col-sm-12 form-control" id="company_email" name="company_email" placeholder="Company Email.">
            </div>


 <div class="form-group">
              <label> Company Website URL: </label>
              <input type="text" class="col-sm-12 form-control" id="website" name="website" placeholder="Company Website URL.">
            </div>

 <div class="form-group">
              <label> Company Description: <span style='color:red'>(Max Length 200 Characters)</span></label>
              <textarea class="col-sm-12 form-control" id="company_desc" name="company_desc" placeholder="Company Description" maxlength="200"></textarea>
            </div>



 <div class="form-group">
              <label> Company Full Location Address followed by City Name, State Name, Country Name: <span style='color:red'>(Eg. Broadway 10012, New York, NY, USA)</span>

<span style='color:purple;font-size:12px;'>This Address will be converted into Google Geo Latitudes and Longitudes for Google Mapping...</span></label>
              <input type="text" class="col-sm-12 form-control" id="address" name="address" placeholder="Company Full Location Address">
            </div>



 <div class="form-group">
                            <div id="alerts_rego" class="upload_progress2" style="width:0%">0%</div>

                        <div id="loaderx2"></div>
						<div id="loader2"></div>
                        <div class="result_data2"></div>
                    </div>

                    <input type="button" id="register_btn" class="btn btn-primary" value="Register Company Data Now" />
<b>(Your Selected Location: <span style='color:purple' class='country_selected_html'></span>)</b>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- Recyclng Companies Registration Modal ends -->




<!-- Users signup Modal start -->



<div id="myModal_signup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header"  style='background: #B931B9;color:white;padding:10px;'>
        <h4 class="modal-title">Users Signup System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
Users Signup System....<br><br>


<div class="form-group">
<label style="">Select Profile Photo: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" accept="image/*" onchange="imagePreview(event)" />
 <img id="imageupload_preview"/>
</div><br>


<input type='hidden' class='country_selected' value=''>



 <div class="form-group">
              <label> Fullname: </label>
              <input type="text" class="col-sm-12 form-control" id="fullname_u" name="fullname_u" placeholder="Fullname">
            </div>



 <div class="form-group">
              <label>Email: </label>
              <input type="text" class="col-sm-12 form-control" id="email_u" name="email_u"  placeholder="Email">
            </div>
 


 <div class="form-group">
              <label style="" for="psw">
<span class="fa fa-eye"></span> Password</label>
              <input type="password" class="col-sm-12 form-control" id="password_u" name="password_u" placeholder="Enter password">
            </div><br>

 <div class="form-group">
              <label style="" for="psw">
<span class="fa fa-eye"></span> Confirm Password</label>
              <input type="password" class="col-sm-12 form-control" id="confirm-password_u" name="confirm-password_u" placeholder=" Confirm Password">
            </div><br>


 <div class="form-group">
              <label>Your Location Address followed by City Name, State Name, Country Name: <span style='color:purple'>(Eg. 13th Avenue 35010, Alexander City, Alabama, United State )</span>
<span style='color:red;font-size:12px;'>This Address will be used for Google Directional Mapping... It will be kept Private. Only You can access your Address</span>
</label>
              <input type="text" class="col-sm-12 form-control" id="address_u" name="address_u" placeholder="Your Full Location Address">
            </div>




 <div class="form-group">
                            <div id='alerts_signupx'  class="upload_progress" style="width:0%">0%</div>

                        <div id="loaderx"></div>
						<div id="loader"></div>
                        <div class="result_data"></div>
                    </div>

                    <input type="button" id="save_btn" class="btn btn-primary" value="Signup" />
<b>(Your Selected Location: <span style='color:purple' class='country_selected_html'></span>)</b>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Users signup Modal ends -->



<!-- users login Modal start -->
<div class="modal fade" id="myModal_login">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style='background: #B931B9;color:white;padding:10px;'>
        <h4 class="modal-title">Users Login System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
 
Users Login System.....<br><br>

 <div class="form-group">
              <label>Email: </label>
              <input type="text" class="col-sm-12 form-control" id="email_user" name="email_user" value='nigeria_test@gmail.com'>
            </div>
 
 <div class="form-group">
              <label>Password: </label>
              <input type="password" class="col-sm-12 form-control" id="password_user" name="password_user" value='123'>
            </div>

<br>
<div id="loader-login_user"></div>
<div id="result-login_user"></div>


                    <input type="button" id="login_btn_user" class="btn btn-primary" value="Login Now" /> 
 <b>(Your Selected Location: <span style='color:purple' class='country_selected_html'></span>)</b>



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Users login Modal ends -->



<!-- Country Selection Modal starts -->



<div id="myModal_country" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header"  style='background: #B931B9;color:white;padding:10px;'>
        <h4 class="modal-title">Select Your Country</h4>
   
      </div>

      <!-- Modal body -->
      <div class="modal-body">

Please Select Your Country to Proceed....<br><br>


 <div class="form-group">

<div class='col-sm-12 country_css'>
<input type="radio" id="co" name="co" value="United States" class="co co_btn"/>
United States<br>
</div>

<div class='col-sm-12 country_css'>
<input type="radio" id="co" name="co" value="United Kingdom" class="co co_btn"/>
United Kingdom<br>
</div>
<div class='col-sm-12 country_css'>
<input type="radio" id="co" name="co" value="Canada" class="co co_btn"/>
Canada<br>
</div>
<div class='col-sm-12 country_css'>
<input type="radio" id="co" name="co" value="Mexico" class="co co_btn"/>
Mexico<br>
</div>
<div class='col-sm-12 country_css'>
<input type="radio" id="co" name="co" value="Nigeria" class="co co_btn"/>
Nigeria<br>
</div>
<div class='col-sm-12 country_css'>
<input type="radio" id="co" name="co" value="Ghana" class="co co_btn"/>
Ghana<br>
</div>
<div class='col-sm-12 country_css'>
<input type="radio" id="co" name="co" value="Kenya" class="co co_btn"/>
Kenya<br>
</div>

</div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>

    </div>
  </div>
</div>

<script>
        $("#myModal_country").modal({
            backdrop: "static",
            keyboard: false,
        });
    </script>

<!-- Country Selection Modal ends -->







<div class="home_text_transparent_home" >
<div class="home_resize_padding"> 


<p class="home_content_head pull-left"><?php echo $title; ?></p>
<marquee> <p class=""><button class="contact_click marquee_button"><img class="marquee_image" src="image/home1.png" /><?php echo $title; ?></button> </p></marquee>

                      

<style>


.dropdown_color:hover{
background: black;
color:white;

}
</style>


  <p class="home_content_text">Register Your Waste Recycling Companies Data</p><br>

<p>

<a  class="category_post" data-toggle="modal" data-target="#myModal_recycling_company_registers">Register/Updates Your Recycling Company Data</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


</p>


<br> 






  <p class="home_content_text">Waste Recyclers (Users) Access</p><br>

<p>

<a  class="category_post2" data-toggle="modal" data-target="#myModal_signup">Users Signup</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a  class="category_post2" data-toggle="modal" data-target="#myModal_login">Users Login</a><br><br><br>


</p>


<br> 



     
</div> 
</div>


    </div>
<!--end left column all-->


<!--start right column all-->
    <div class="right-column-all">


<!-- ab Section start-->
<div  class="about section_padding aboutus_bgcolor" style=''>


  <h2 class="text-center"><span class="contact_name_color">About <?php echo $title; ?></span></h2>
<p class="footer_text3"><?php echo $description; ?> </p><br><br>
<img style="width:100%;min-width:100%;max-width:100%;height:400px;" src="image/home2.png">

<style>
.hh{
color:#800000;
}

.hh:hover{
color:black;
}
</style>
  <h2 style='display:none' class="text-center"><span class="contact_name_color hh">Powered...</span></h2>


</div>




<!-- ab Section ends-->



<!-- footer Section start -->

<footer class=" navbar_footer text-center footer_bgcolor">

<div class="row">

        <div class="col-sm-12">

<p class="footer_text1"><?php echo $title; ?></p>
<p class="footer_text2"><?php  echo $description; ?></p>
<br>



        </div>

 
</div>



</div>

<div class="footer_text1">
<p class="footer_text1"></p>
</div>


<div class="footer_dashedline"></div>

 </footer>

<!-- footer Section ends -->
	




<div>
  <!--end right column all-->    







   
</body>
</html>























