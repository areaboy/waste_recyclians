<?php
error_reporting(0); 

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


$post_userid_vaidate = $userid_sess;


include('backend/db_connection.php');
$cctx = $db->prepare('select * from users where userid =:userid');
$cctx->execute(array(':userid' =>$post_userid_vaidate));
$rctx_row = $cctx->fetch();
$fullname_data = htmlentities(htmlentities($rctx_row['fullname'], ENT_QUOTES, "UTF-8"));
$address_data = htmlentities(htmlentities($rctx_row['address'], ENT_QUOTES, "UTF-8"));
$points_data = htmlentities(htmlentities($rctx_row['points'], ENT_QUOTES, "UTF-8"));
$email_data = htmlentities(htmlentities($rctx_row['email'], ENT_QUOTES, "UTF-8"));
$country_data = htmlentities(htmlentities($rctx_row['country'], ENT_QUOTES, "UTF-8"));
$photo_data = htmlentities(htmlentities($rctx_row['photo'], ENT_QUOTES, "UTF-8"));
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
     
<li class="navbar-brand home_click imagelogo_li_remove" ><img title='<?php  echo $titlex; ?>-logo' alt='<?php  echo $titlex; ?>-logo' class="img-rounded imagelogo_data" src="image/logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">


      <ul class="nav navbar-nav navbar-right">




<!--start post comments notification-->

<script>

$(document).ready(function(){

var userid_sess_data = '<?php echo $userid_sess; ?>';
$("#loader-notify_alert_posts").fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i></div>');
var datasend = {userid_sess_data:userid_sess_data};

//alert(userid_sess_data);
	
		$.ajax({
			
			type:'POST',
			url:'backend/notify_alert.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

//alert(msg);

$("#loader-notify_alert_posts").hide();
$("#result-notify_alert_posts").html(msg);
//setTimeout(function(){ $('#result-notify_alert_posts').html(''); }, 5000);	


			
	
}
			
		});
		
		

});


</script>


<li>
<span style='color:white;' class="dropdown fa fa-bell">
  <a style="color:white;font-size:14px;cursor:pointer;" title='Real-Time Notification System' class="btn1 btn-default1 dropdown-toggle"  data-toggle="dropdown">
  <span class="notify_count"><span id="loader-notify_alert_posts"></span><span id="result-notify_alert_posts"></span></span>
</a>

<ul class="dropdown-menu" style='width:350px;height: 400px;overflow-y : scroll;'>
<h4 style='color:blue;'>Real-Time Notification System</h4>
<button class="btn btn-primary" id="refresh_notify" title="Refresh Notification">Refresh Notification</button>
<br>


<script>

$(document).ready(function(){


var userid_sess_data = '<?php echo $userid_sess; ?>';
var username_sess_data = '<?php echo $userid_sess; ?>';

var sender_id=userid_sess_data;
var sender_username=username_sess_data;


if(sender_id ==''){
alert('something is wrong with Senders Id');
}


else{


$("#loader-load-notify-post").fadeIn(400).html('<br><div style="color:white;background:#ec5574;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait,Loading Your Notification Alerts...</div>');
var datasend = {sender_id:sender_id, sender_username:sender_username};


	
		$.ajax({
			
			type:'POST',
			url:'backend/notification_load.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-load-notify-post").hide();
$("#result-load-notify-post").html(msg);
//setTimeout(function(){ $('#result-load-notify-post(''); }, 5000);				

//location.reload();	
}
			
		});
		
		}


});










$(document).ready(function(){

  $('#refresh_notify').click(function () {
var userid_sess_data = '<?php echo $userid_sess; ?>';
var username_sess_data = '<?php echo $userid_sess; ?>';

var sender_id=userid_sess_data;
var sender_username=username_sess_data;


if(sender_id ==''){
alert('something is wrong with Senders Id');
}


else{


$("#loader-load-notify-post").fadeIn(400).html('<br><div style="color:white;background:#ec5574;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait,Loading Your Notification Alerts...</div>');
var datasend = {sender_id:sender_id, sender_username:sender_username};


	
		$.ajax({
			
			type:'POST',
			url:'backend/notification_load.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-load-notify-post").hide();
$("#result-load-notify-post").html(msg);
//setTimeout(function(){ $('#result-load-notify-post(''); }, 5000);				

//location.reload();	
}
			
		});
		
		}





// start notify 1


var userid_sess_data = '<?php echo $userid_sess; ?>';
$("#loader-notify_alert_posts").fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i></div>');
var datasend = {userid_sess_data:userid_sess_data};

//alert(userid_sess_data);
	
		$.ajax({
			
			type:'POST',
			url:'backend/notify_alert.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

//alert(msg);

$("#loader-notify_alert_posts").hide();
$("#result-notify_alert_posts").html(msg);
//setTimeout(function(){ $('#result-notify_alert_posts').html(''); }, 5000);	


			
	
}
			
		});
		


// end notify 1


});


});


</script>



<!-- form START-->
<div id="loader-load-notify-post"></div>
<div id="result-load-notify-post"></div>


<!--form ENDS-->

<p></p>

</ul></span>
&nbsp;&nbsp;
</li>


<!--end post comments notifications-->




 <li style='display:none' class="navgate_no"><a title='Recycle New Waste' data-toggle='modal' data-target='#myModal_recycling' style="color:white;font-size:14px;">
<button class="category_post1">Recycle <br>New Waste</button></a></li>



 <li class="navgate_no"><a title='Go Back to Dashboard' href="dashboard.php" style="color:white;font-size:14px;">
<button class="category_post1">Go Back to Dashboard</button></a></li>


 <li style='display:none' class="navgate_no"><a title='Logout' href="logout.php" style="color:white;font-size:14px;">
<button class="category_post1">Logout</button></a></li>


             
<li class="navgate"><img style="max-height:60px;max-width:60px;" class="img-circle" width="60px" height="60px"
 src="backend/user_photos/<?php echo $photo_sess; ?>" width="80px" height="80px">



<span class="dropdown">
  <a style="color:white;font-size:14px;cursor:pointer;" title='View More Data' class="btn1 btn-default1 dropdown-toggle"  data-toggle="dropdown"><?php echo $fullname_sess; ?>
  <span class="caret"></span></a>

<ul class="dropdown-menu col-sm-12">
<li><a title='My Profile' href="my_profile.php">My Profile</a></li>
<li><a title='Logout' href="logout.php">Logout</a></li>

</ul></span>

</li>



      </ul>




    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->

<script>


$(document).ready(function(){

 $(".email_send_btn").click(function(){

//window.open('mailto:test@gmail.com?subject=subject&body=body');
var user_email ='<?php echo $email_data; ?>';
if(confirm('This Email will be sent via your Browser Clients. Please Ensure that your Browser allows Opening a Popup Window')){
window.open("mailto:"+user_email);
}
});
});

</script>



<div class='row'>
<br><br><br>

<center class='wellx'><h4>Welcome 
<b style='color:purple'> <?php echo $fullname_data; ?></b> To Your Profile. 
</h4>

<img style="max-height:60px;max-width:60px;" class="img-rounded" width="60px" height="60px"
 src="backend/user_photos/<?php echo $photo_data; ?>" width="80px" height="80px"><br>
<b> Your Email: </b> <?php echo $email_data; ?>  <br>

<b> Your Total Points Earned so far for Recycling Contributions:</b>  <?php echo $points_data; ?>(Points) <br>
<b> Your Address: </b> <?php echo $address_data; ?>  <br>
<b> Your Country: </b> <?php echo $country_data; ?>  <br>
 <button  class="email_send_btn readmore_btn">Send Email to Yourself "(<?php echo $fullname_data; ?>)" </button><br>



</center><br>


<!--Start Left-->
<div class='col-sm-3 well'>

<style>

</style>

<h4>List of NearBy <b style='color:purple'><?php echo $country_nickname_sess; ?></b> Waste Recycling Companies</h4>



<?php
include('backend/db_connection.php');
$result = $db->prepare('SELECT * FROM company WHERE country=:country order by id desc');
$result->execute(array(':country'=>$country_sess));
$nosofrows = $result->rowCount();
if($nosofrows  == 0){
echo "<div style='background:red;color:white;padding:10px;border:none'>No Waste Recycling Company Registered for <b>$country_sess</b> Yet....</div>";
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
?>
    





<div style='background:#ccc;color:black;border-radius:15%;padding:6px; border:none;' class='cat_cssx col-sm-12'>

<b><?php echo $company_name; ?><b><br>
<div class='col-sm-6'>
<button class='map_call_btn btn_map_locations btn btn-success btn-xs' data-country='<?php echo $country; ?>' data-company_name='<?php echo $company_name; ?>' data-company_address='<?php echo $address; ?>' data-id='<?php echo $id; ?>' data-lat='<?php echo $lat; ?>' data-lng='<?php echo $lng; ?>' title='Map Geo-Location' data-toggle='modal' data-target='#myModal_maploc'>Map Geo-Location</button></div>

<div class='col-sm-6'>
<button class='btn_map_refresh map_call_btn btn_map_locations btn btn-warning btn-xs' data-country='<?php echo $country; ?>' data-company_name='<?php echo $company_name; ?>' data-company_address='<?php echo $address; ?>'  data-id='<?php echo $id; ?>' data-lat='<?php echo $lat; ?>' data-lng='<?php echo $lng; ?>' title='Map Direction' data-toggle='modal' data-target='#myModal_mapdir'>Map Direction</button></div>


</div>


<br>
<?php
}

?>


</div>

<!--End Left-->










<!--Start Center-->
<div class='col-sm-9'>


  <script>
        
        $(document).ready(function(){
            
            //$(window).scroll(function(){
 $('#loadmore_btn').click(function () {

                
                //var position = $(window).scrollTop();
                //var bottom = $(document).height() - $(window).height();



             // if( position == bottom ){


                    var row_limit = Number($('#row_limit').val());
                    var total_count = Number($('#total_count').val());
		    var querytotal  = total_count;
                    var rowpage = 2;
                    row_limit = row_limit + rowpage;

					
					 if(row_limit >= querytotal){
               
                   alert('No More Content to Load');
$("#nomore_content_check").html("<div style='background:purple;color:white;padding:10px;bottom:0'>No More Content to Load <br> <center><button style='background:#3b5998;border:none;color:white;padding:10px;cursor:pointer' title='Refresh Page' class='reloadData'>Refresh Page</button></center> </div>");   
$('#loader_posts').hide();
                }

                    if(row_limit <= querytotal){
                        $('#row_limit').val(row_limit);
$("#loader_posts").fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><img src="loader.gif"> Please Wait. Loading Content</div>');

                        $.ajax({
                            url: 'backend/posts_paginate.php',
                            type: 'post',
                            data: {row_limit:row_limit},
                            success: function(response){
                                $(".post:last").after(response).show().fadeIn("slow");
$('#loader_posts').hide();
                            }
                        });
                    }
                //}

            });
        
        });


// Load Waste Recycling Companies Start Here
$(document).ready(function(){

$('.company_call_btns').click(function(){
var id = $(this).data('id');
var country = '<?php echo $country_sess; ?>';
$("#company_loads_"+id).fadeIn(400).html('<br><div style="color:black;background:white;padding:4px;"><img src="loader.gif"> &nbsp;Please Wait. Loading Nearby Waste Recycling Companies.</div>');
var datasend = {id: id, country:country};

		$.ajax({
			
			type:'POST',
			url:'backend/Waste_recycle_companies_load.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){
$("#company_loads_"+id).hide();
$("#company_results_"+id).html(msg);
}			
});
                });
            });


$(document).ready(function(){
$(document).on( 'click', '.company_call_btns2', function(){ 

var id = $(this).data('id');
var country = '<?php echo $country_sess; ?>';

alert(id);
$("#company_loads_"+id).fadeIn(400).html('<br><div style="color:black;background:white;padding:4px;"><img src="loader.gif"> &nbsp;Please Wait. Loading Nearby Waste Recycling Companies.</div>');
var datasend = {id: id, country:country};

		$.ajax({
			
			type:'POST',
			url:'backend/Waste_recycle_companies_load.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){
$("#company_loads_"+id).hide();
$("#company_results_"+id).html(msg);
}			
});
                });
            });


// Load Waste Recycling Companies Ends Here



// Get Data for Comment
$(document).ready(function(){
$('.comment_btns').click(function(){



var postid = $(this).data('postid');
var title = $(this).data('title');
$('.postid_p').html(postid);
$('.title_p').html(title);
//$('.title_value').val(title).value;
var post_id = postid;


var comment_count = $(this).data('comment_countx');
//$("#comment_totalx_"+postid).html(comment_count);
$("#comment_totalx").html(comment_count);

if(post_id == ''){
alert('Post Id cannot be empty');
return false;
}
$("#loader-comment").fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Loading Comments.</span>');
        $.ajax({
            url: 'backend/comment_loading.php',
            type: 'post',
            data: {post_id:post_id},
            dataType: 'html',
            success: function(data){
$("#result_comment").html(data);
$("#loader-comment").hide();

            }
        });

});
});





// Get Data for Comment for Post Pagination
$(document).ready(function(){
//$('.comment_btns2').click(function(){
$(document).on( 'click', '.comment_btns2', function(){ 


var postid = $(this).data('postid');
var title = $(this).data('title');
$('.postid_p').html(postid);
$('.title_p').html(title);
//$('.title_value').val(title).value;
var post_id = postid;


var comment_count = $(this).data('comment_countx');
//$("#comment_totalx_"+postid).html(comment_count);
$("#comment_totalx").html(comment_count);

if(post_id == ''){
alert('Post Id cannot be empty');
return false;
}
$("#loader-comment").fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Loading Comments.</span>');
        $.ajax({
            url: 'backend/comment_loading.php',
            type: 'post',
            data: {post_id:post_id},
            dataType: 'html',
            success: function(data){
$("#result_comment").html(data);
$("#loader-comment").hide();

            }
        });

});
});




// post comments


$(document).ready(function(){
$(document).on( 'click', '.comment_send_btn', function(){ 
 //$("."comment_send_btn").click(function(){
var postid = $(this).data('postid');
var id = this.id; 
var comdesc = $('#comdesc').val();

if(comdesc == ''){
alert('comment cannot be empty');
return false;
}
        // AJAX Request


$("#loader_comments_send").fadeIn(400).html('<br><div style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Sending Comments.</div>');

        $.ajax({
            url: 'backend/comment.php',
            type: 'post',
            data: {postid:postid,comdesc:comdesc},
            dataType: 'json',
            success: function(data){

                var comment = data['comment'];
                var comdesc = data['comdesc'];
                var comment_username = data['comment_username'];
                 var comment_fullname = data['comment_fullname'];
 var comment_photo = data['comment_photo'];
 var comment_time = data['comment_time'];
//$("#comment_total").text(comment);
$("#comment_total_"+postid).text(comment);

$("#comment_totalx").html(comment);

var com_counting =comment;
if(com_counting > 0){
$("#no_comment_hide").hide();
}

  var comment_json = "<div class='comment_css' style=''>" +
                   
 "<img style='border-style: solid; border-width:3px; border-color:#ec5574; width:40px;height:40px; max-width:40px;max-height:40px;border-radius: 50%;' src='backend/user_photos/" + comment_photo +" '/><br>" +
      "<span style='font-size:14px;text-align:left;color:#ec5574;'><b>Name</b>: " + comment_fullname + "</span><br>" +              
                    "<b style='font-size:12px;text-align:left;'>Comment: </b>" + comdesc + "<br>" +
"<span style='color:#800000'><b> <span class='fa fa-calendar'></span>Time:</b> <span data-livestamp='" + comment_time + "'></span></span>"+
                    "</div>";
$("#result_comments_send").append(comment_json)
alert('Comment Added Successfully');

$('#comdesc').val('');

$("#loader_comments_send").hide();

            }
        });

    });

});







$(document).ready(function(){

 //$(".plike_btns").click(function(){
$(document).on( 'click', '.plike_btns', function(){ 

 var post_id = this.id; 
var id = post_id;
var title = $(this).data('title');

if(id == ''){
alert('Post Id cannot be empty');
return false;
}
        // AJAX Request


$("#loader-plike_"+id).fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Sending your Likes.</span>');

        $.ajax({
            url: 'backend/post_like.php',
            type: 'post',
            data: {post_id:post_id, title:title},
            dataType: 'json',
            success: function(data){

var msg = data['msg'];
if(msg=='failed'){
alert('You Already Like This Posts');
$("#loader-plike_"+id).hide();
}
if(msg=='success'){
                var like = data['like'];       
$("#plike_total_"+id).text(like);
alert('Like Sent Successfully');
$("#loader-plike_"+id).hide();
}

            }
        });
    });
});

// post like ends



</script>






        <div class="content">

            <?php


		
            $rowpage = 1000;
            $limit = 0;

$res= $db->prepare("SELECT count(*) as totalcount FROM posts WHERE userid=:userid");
$res->execute(array(':userid' =>$post_userid_vaidate));
$t_row = $res->fetch();
$totalcount = $t_row['totalcount'];

if($totalcount == 0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>No Post Created by User <b>$fullname_data</b> Yet...</div>";
//exit();
}


$result = $db->prepare("SELECT * FROM posts WHERE userid=:userid order by id desc limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($rowpage), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($limit), PDO::PARAM_INT);
$result->bindValue(':userid', trim($post_userid_vaidate), PDO::PARAM_STR);
//$result->bindValue(':uid', trim($projectid), PDO::PARAM_INT);
$result->execute();

$count_post = $result->rowCount();

while($row = $result->fetch()){


$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$postid = $id;
$title = htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$title_seo = htmlentities(htmlentities($row['title_seo'], ENT_QUOTES, "UTF-8"));
$content = htmlentities(htmlentities($row['content'], ENT_QUOTES, "UTF-8"));
$fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
$userphoto = htmlentities(htmlentities($row['userphoto'], ENT_QUOTES, "UTF-8"));
$timer1 = htmlentities(htmlentities($row['timer'], ENT_QUOTES, "UTF-8"));
$post_userid = htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
$recycle_image = htmlentities(htmlentities($row['recycle_image'], ENT_QUOTES, "UTF-8"));
$microcontent = substr($content, 0, 120)."...";
$microtitle = substr($title, 0, 80)."..";
$points = htmlentities(htmlentities($row['points'], ENT_QUOTES, "UTF-8"));
$total_comment = htmlentities(htmlentities($row['total_comments'], ENT_QUOTES, "UTF-8"));
$t_like = htmlentities(htmlentities($row['total_like'], ENT_QUOTES, "UTF-8"));
$rewards = htmlentities(htmlentities($row['reward_type'], ENT_QUOTES, "UTF-8"));
$ai_model = htmlentities(htmlentities($row['ai_model'], ENT_QUOTES, "UTF-8"));
$country_nickname = htmlentities(htmlentities($row['country_nickname'], ENT_QUOTES, "UTF-8"));
$country_name = htmlentities(htmlentities($row['country_name'], ENT_QUOTES, "UTF-8"));

//style='display:inline-block;height:600px;'
      ?>

                    <div class="post col-sm-4_no well" id="post_<?php echo $id; ?>">



<img style='max-height:60px;max-width:60px;' class='img-circle' src='backend/user_photos/<?php echo $userphoto; ?>' alt='User Image'>

<span style='color:blue;'><b>Recycled By: </b> <?php echo $fullname;?></span>

<a class='readmore_btn2 pull-right' title='Visit Users Profile' style='color:white;' href='user_profile.php?userid=<?php echo $post_userid; ?>'>Visit Users Profile</a>
<br>



<h3 style='font-size:16px;color:<?php echo $header_color; ?>'>Title: <?php echo $microtitle; ?></h3>

<b style='font-size:16px;color:#800000'>Recycled Materials Processed by AI: --- <?php echo $content; ?></b><br>
<span style='color:purple;'><b> AI Model Used: </b> <?php echo $ai_model; ?></span> <br>
<span style='color:purple;'><b> Means for Getting Rewards By: </b> <?php echo $rewards; ?></span> <br>
<span style='color:fuchsia;'><b> Points Awarded So Far for Recycling Contributions: </b> <span class='point_count'><?php echo $points; ?> (Points)</span></span> <br>
<span>

&nbsp;<span data-comment_countx='<?php echo $total_comment; ?>' data-title='<?php echo $title; ?>' data-postid='<?php echo $postid; ?>' id="<?php echo $postid; ?>" data-toggle='modal' data-target='#myModal_comments' style="color:#800000;font-size:26px;cursor:pointer;" title="Comments" class="fa fa-comments-o comment_btns" title='Comments' data-toggle='modal' data-target='#myModal_comments' id='<?php echo $postid; ?>' data-total_comment='<?php echo $total_comment; ?>'> <span style='font-size:14px;'>Comments</span>  </span>
<span style='font-size:14px;color:#800000;'>(<span id="comment_total_<?php echo $postid; ?>"><?php echo $total_comment; ?></span>)</span>

</span>


<span>

<span data-title='<?php echo $title; ?>' style="font-size:26px;color:#800000;cursor:pointer;" class="plike_btns fa fa-heart-o" id="<?php echo $postid; ?>" title="Like">
&nbsp;<span id="<?php echo $postid; ?>"  style="color:#800000;" /></span>
<span style='font-size:14px'>(<span id="plike_total_<?php echo $postid; ?>"><?php echo $t_like; ?></span>)</span>
</span> 

<span id="loader-plike_<?php echo $postid; ?>"></span>
</span>

<br>
<span style='color:#800000;'><b> Recycled Since: </b> <span data-livestamp="<?php echo $timer1;?>"></span></span> <br>





<button style='display:none' class='readmore_btn btn btn-warning'><a title='Click to Comment and Like' style='color:white;' 
href='dashboard_post.php?title=<?php echo $title_seo; ?>'>Click to Comment and Like </a></button>
<br>


<b>Image Processed By AI</b><br>
<img style='min-height:200px;min-width:200px;max-height:200px;max-width:200px;' class='img-rounded' src='backend/recycle_waste_images/<?php echo $recycle_image; ?>' alt='User Image'><br>
 
<br>
<div id='company_loads_<?php echo $id; ?>'></div>
<div id='company_results_<?php echo $id; ?>'></div>
<button  data-id='<?php echo $id; ?>' class='btn btn-primary company_call_btns'>View & Connect  Nearby Waste<br> Recycling Companies in <b>(<?php echo $country_sess; ?>)</b>
</button>
<br> 


         
</div>





            <?php

                }
            ?>
<center style='display:none;'>
<div id="loader_posts" class="loader_posts"></div>
<div id="nomore_content_check_no"></div>
            <input type="hidden" id="row_limit" value="0">
            <input type="hidden" id="total_count" value="<?php echo $totalcount; ?>">
<br><br>
<button disabled id="loadmore_btn" title='Load More Content' class="loadmore_css col-sm-12">Load More Content</button>
<br><br>
</center>
<div class="col-sm-12">.</div>
<br class="col-sm-12"><br class="col-sm-12">



</div>








</div>
<!--End Center-->





</div>
<!--Row-->



<script>

// Recycling starts

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
                $('#recycle_btn').click(function () {
				
                    var file_fname = $('#file_content').val();
                    var ai_model = $(".ai_model:checked").val();
                    var rewards = $(".rewards:checked").val();

// start if validate
if(file_fname==""){
alert('please Select File to Upload');
}

else if(ai_model==undefined){
alert('please Select Your AI Model..');
}

else if(rewards==undefined){
alert('please Select How you want to be Rewarded..');
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
          form_data.append('ai_model', ai_model);
          form_data.append('rewards', rewards);



if(ai_model =='Google Gemini AI'){

                    $('.upload_progress').css('width', '0');
					$('#loaderx').hide();
                    $('#loader_recycle').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Waste Material is being Processed By Google Gemini AI.</div>');
                    $.ajax({
                        url: 'backend/recycle_image_gemini_ai.php',
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
				$('#loader_recycle').hide();
				$('.result_recycle').fadeIn('slow').prepend(msg);
				$('#alerts_recycle').delay(5000).fadeOut('slow');
                                $('#alerts_recyclex').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content').val('');
this.checked = false;  //javascript
$("input:radio").attr("checked", false);
//$(this).prop('checked', false);
}

}
});
}// end gemini AI if Statement








if(ai_model =='OpenAI ChatGPT'){

                    $('.upload_progress').css('width', '0');
					$('#loaderx').hide();
                    $('#loader_recycle').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Waste Material is being Processed By OpenAI chatGPT.</div>');
                    $.ajax({
                        url: 'backend/recycle_image_chatgpt_ai.php',
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
				$('#loader_recycle').hide();
				$('.result_recycle').fadeIn('slow').prepend(msg);
				$('#alerts_recycle').delay(5000).fadeOut('slow');
                                $('#alerts_recyclex').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content').val('');
this.checked = false;  //javascript
$("input:radio").attr("checked", false);
//$(this).prop('checked', false);
}

}
});
}// end  OpenAI if Statement





} // end if validate




                });
            });

// Recycling ends

</script>








<!-- Recyclng  Modal starts -->



<div id="myModal_recycling" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header"  style='background: #B931B9;color:white;padding:10px;'>
        <h4 class="modal-title">Recycle Your Waste Materials</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


<div class="form-group">
<label style="">Select Waste Recycling Image: (Eg. Image containing the  Products to be Reycled)</label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" accept="image/*" onchange="imagePreview(event)" />
 <img id="imageupload_preview"/>
</div><br>


<div class="form-group">
<label style="">Pick AI Model to be Used</label><br>

<div class='col-sm-6 country_css'>
<input type="radio" id="ai_model" name="ai_model" value="OpenAI ChatGPT" class="ai_model"/>
OpenAI ChatGPT<br>
</div>

<div class='col-sm-6 country_css'>
<input type="radio" id="ai_model" name="ai_model" value="Google Gemini AI" class="ai_model"/>
Google Gemini AI<br>
</div>


</div>



<div class="form-group col-sm-12">
<label style="">Select How You want to be Rewarded</label><br>

<div class='col-sm-4 country_css'>
<input type="radio" id="rewards" name="rewards" value="Cash" class="rewards"/>
Cash<br>
</div>

<div class='col-sm-4 country_css'>
<input type="radio" id="rewards" name="rewards" value="Gift" class="rewards"/>
Gift<br>
</div>

<div class='col-sm-4 country_css'>
<input type="radio" id="rewards" name="rewards" value="Meal" class="rewards"/>
Meal<br>
</div>


</div>

<br>

 <div class="form-group col-sm-12">
                            <div id="alerts_recyclex" class="upload_progress" style="width:0%">0%</div>
                        <div id="loaderx_recycle"></div>
						<div id="loader_recycle"></div>
                        <div class="result_recycle"></div>
                    </div>

                    <input type="button" id="recycle_btn" class="btn btn-primary" value="ReCycle Now" />


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- Recyclng  Modal ends -->

<script>
$(document).ready(function(){
$('.map_call_btn').click(function(){

var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

$('.country_call_p').html(country_call);
$('.company_address_call_p').html(company_address_call);
$('.company_name_call_p').html(company_name_call);

$('.company_address_call_value').val(company_address_call).value;

});
});



$(document).ready(function(){
$(document).on( 'click', '.map_call_btn2', function(){ 


var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

$('.country_call_p').html(country_call);
$('.company_address_call_p').html(company_address_call);
$('.company_name_call_p').html(company_name_call);

$('.company_address_call_value').val(company_address_call).value;

});
});



// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_maploc').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   //$('.maploc_clean').empty();  
 console.log("modal closed and content cleared");
 });
});


$(document).ready(function(){
$('#myModal_mapdir').on('hidden.bs.modal', function() {
//alert('Modal Closed dir');
 $('.mapdir_clean_dir').empty();  
 console.log("modal closed and content cleared");
 });
});


</script>



<!-- map  Geo Location modal starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_maploc" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">
 

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h4 class="modal-title">Map Locations for <span style='color:purple' class='company_name_call_p'></span></h4>

<b>Address: </b> <span class='company_address_call_p'></span> (<span class='country_call_p'></span>)

        </div>
        <div class="modal-body">


<!-- start map loading-->
<style>
/*
#map {
        height: 80%;
      }
    
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
*/
.res_center_css{
position:absolute;top:50%;left:50%;margin-top: -50px;margin-left -50px;width:100px;height:100px;
}

</style>

<div id="loader_map_locx" class='res_center_css'></div>

    <div  style='width:600px; height:600px;' id="map" class='maploc_clean'></div>

    <script>
   var customLabel = {
        Vaccine: {
          label: 'P'
        }
      };

        function initMap() {


$(document).on( 'click', '.btn_map_locations2', function(){ 

var company_id = $(this).data('id');
var lngx = $(this).data('lng');
var latx = $(this).data('lat');

var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

// convert Latitude Longitue to Float
const latx_convert = parseFloat(latx);
const lngx_convert = parseFloat(lngx);


        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(latx_convert, lngx_convert),
          zoom: 11
        });
        var infoWindow = new google.maps.InfoWindow;

$('#loader_map_locx').fadeIn(400).html('<br><div style="color:black;background:#c1c1c1;padding:10px;"><img src="loader.gif">  &nbsp;Please Wait, Google Map is being Loaded...</div>');

          //downloadUrl('map1_backend.php', function(data) {
			  downloadUrl('backend/map_single_location.php?company_id='+company_id, function(data) {
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

$('#loader_map_locx').hide();

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
}); //end  jquery click button 2


$('.btn_map_locations').click(function(){


var company_id = $(this).data('id');
var lngx = $(this).data('lng');
var latx = $(this).data('lat');

var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

// convert Latitude Longitue to Float
const latx_convert = parseFloat(latx);
const lngx_convert = parseFloat(lngx);

//alert(company_address_call);

        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(latx_convert, lngx_convert),
          zoom: 11
        });
        var infoWindow = new google.maps.InfoWindow;

$('#loader_map_locx').fadeIn(400).html('<br><div style="color:black;background:#c1c1c1;padding:10px;"><img src="loader.gif">  &nbsp;Please Wait, Google Map is being Loaded...</div>');

          //downloadUrl('map1_backend.php', function(data) {
			  downloadUrl('backend/map_single_location.php?company_id='+company_id, function(data) {
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

$('#loader_map_locx').hide();

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
		  
		   });  // close jquery clickbutton


const lat_data ='<?php echo $lat_sess; ?>';
const lng_data ='<?php echo $lng_sess; ?>';

// convert Latitude Longitue to Float
const lat_datax = parseFloat(lat_data);
const lng_datax = parseFloat(lng_data);

//start map direction

const directionsRenderer = new google.maps.DirectionsRenderer();
  const directionsService = new google.maps.DirectionsService();
  const mapx = new google.maps.Map(document.getElementById("gmap"), {
    zoom: 7,
    center: { lat: lat_datax, lng: lng_datax },
    disableDefaultUI: true,
  });

  directionsRenderer.setMap(mapx);
  directionsRenderer.setPanel(document.getElementById("gmap_sidebar"));

  const control = document.getElementById("gmap_floating-panel");

  mapx.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

 //const onChangeHandler = function () {


$(document).ready(function(){
$('.btn_map_send').click(function(){
    calculateAndDisplayRoute(directionsService, directionsRenderer);
});
});

$(document).ready(function(){
$(document).on( 'click', '.btn_map_send2', function(){ 
    calculateAndDisplayRoute(directionsService, directionsRenderer);
});
});

// refresh map on each modal click
$(document).ready(function(){
$('.btn_map_refresh').click(function(){
    calculateAndDisplayRoute(directionsService, directionsRenderer);
//alert('refreshed');
});
});

$(document).ready(function(){
$(document).on( 'click', '.btn_map_refresh2', function(){ 
    calculateAndDisplayRoute(directionsService, directionsRenderer);
//alert('refreshed');
});
});

// End  Map direction





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



// start finalizing Map Direction

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  //const start = document.getElementById("start").value;
  const end = document.getElementById("end_destination").value;
$('.loading_map').fadeIn(400).html('<div style="color:black;background:#c1c1c1;padding:6px;"><img src="loader.gif">  &nbsp;Please Wait, Google Map Direction is being Loaded...</div>');

  directionsService
    .route({
      origin: '<?php echo $address_sess; ?>',
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
if(response == '[object Object]'){
//alert(response);
     $('.loading_map').hide();
}

    })
    .catch((e) => {window.alert("Directions request failed due to Internet Connection.." + status); $('.loading_map').hide();}

);
 
}

// end finalizing Map Direction



      function doNothing() {}

 $('#myModal_maploc').on('shown.bs.modal', function(){
    //init();
initMap();

    });

 $('#myModal_mapdir').on('shown.bs.modal', function(){
    //init();
initMap();

    });


    </script>

  


<!-- end map loading-->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- map Geo location modal ends here -->




<style>

/* Optional: Makes the sample page fill the window. 
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
*/

.divbody{
 height: 100%;
  margin: 0;
  padding: 0;

}

#gmap_container {
  height: 100%;
  display: flex;
}

#gmap_sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 30rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#gmap {
  flex-basis: 0;
  flex-grow: 4;
  height: 100%;
}

#gmap_floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}

#gmap_floating-panel {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  padding: 5px;
  font-size: 14px;
  text-align: center;
  line-height: 30px;
  height: auto;
}

#gmap {
  flex: auto;
}

#gmap_sidebar {
  flex: 0 1 auto;
  padding: 0;
}
#gmap_sidebar > div {
  padding: 0.5rem;
}

</style>








<!-- map  direction modal starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_mapdir" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">
 

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h4 class="modal-title">Map Directions for <span style='color:purple' class='company_name_call_p'></span></h4>
<b>Address: </b> <span class='company_address_call_p'></span> (<span class='country_call_p'></span>)
        </div>
        <div class="modal-body">


<!-- start map loading-->




  <div class='divbody'>
    <div id="gmap_floating-panel">
      <strong>Start: (Your Location):</strong> <?php echo $address_sess; ?>
      
      <br />
      <strong>End: (Recycling Company Location)</strong>
<span class='company_address_call_p'></span>
<input type='hidden' class='company_address_call_value' id='end_destination' value =''>
<div class='loading_map'></div>
<button class='btn_map_send btn btn-primary btn-xs' >Get Direction</button>


     
    </div>
    <div id="gmap_container">
      <div style='width:600px; height:600px;' id="gmap"></div>
      <div id="gmap_sidebar"  class='mapdir_clean_dir'></div>
    </div>
    <div style="display: none">
      <div id="gmap_floating-panel">
        <strong>Start:</strong>
        <select id="start">
        </select>
        <br />
        <strong>End:</strong>
        <select id="end">
        </select>
      </div>
    </div>
 


  </div>


<!-- end map loading-->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- map Direction modal ends here -->







<!-- Comments starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_comments" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">
 

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h4 class="modal-title">Comments System For:  <span style='color:purple' class='title_p'></span></h4>

<center><b>Total Comments: </b> <span id="comment_totalx"></span></center><br>

        </div>
        <div class="modal-body">


<!-- start-->

<!--start comment-->



<div id="result_comment"></div>
<div id="loader-comment"></div>




<!--end comment-->


<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- Comments modal ends here -->








<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_keys; ?>&callback=initMap">
    </script>

<!-- footer Section start -->

<footer class=" navbar_footer text-center footer_bgcolor">

<div class="row">
        <div class="col-sm-12">


<p class="footer_text1"><?php echo $titlex; ?></p>
<p class="footer_text2"><?php  echo $description; ?></p>
<br>

        </div>



        </div>

<br/>
  <p></p>
</footer>

<!-- footer Section ends -->


   
</body>
</html>


