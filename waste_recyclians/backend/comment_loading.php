﻿<?php
error_reporting(0); 
ob_start();
session_start();


$userid_sess =  htmlentities(htmlentities($_SESSION['uid_s'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname_s'], ENT_QUOTES, "UTF-8"));
$country_sess =   htmlentities(htmlentities($_SESSION['country_s'], ENT_QUOTES, "UTF-8"));
$country_nickname_sess =   htmlentities(htmlentities($_SESSION['country_nickname_s'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo_s'], ENT_QUOTES, "UTF-8"));
$address_sess =  htmlentities(htmlentities($_SESSION['address_s'], ENT_QUOTES, "UTF-8"));
$lat_sess = htmlentities(htmlentities($_SESSION['lat_s'], ENT_QUOTES, "UTF-8"));
$lng_sess = htmlentities(htmlentities($_SESSION['lng_s'], ENT_QUOTES, "UTF-8"));
$map_zoom_sess = htmlentities(htmlentities($_SESSION['map_zoom_s'], ENT_QUOTES, "UTF-8"));

include('db_connection.php');
$post_id= strip_tags($_POST['post_id']);




$result_comment = $db->prepare("SELECT * FROM comments where postid =:postid");
$result_comment->execute(array(':postid' => $post_id));

$count_comment = $result_comment->rowCount();
if($count_comment ==0){
echo "<div style='background:red;color:white;padding:4px;border:none;' id='no_comment_hide'>No Comments Found for this Posts Yet..<b></b></div>";
}

while ($rowComment= $result_comment->fetch()) {

$commentid = htmlentities(htmlentities($rowComment['id'], ENT_QUOTES, "UTF-8"));
$pid = htmlentities(htmlentities($rowComment['postid'], ENT_QUOTES, "UTF-8"));
$comment = htmlentities(htmlentities($rowComment['comment'], ENT_QUOTES, "UTF-8"));
$comment_userid = htmlentities(htmlentities($rowComment['userid'], ENT_QUOTES, "UTF-8"));
$comment_fullname = htmlentities(htmlentities($rowComment['fullname'], ENT_QUOTES, "UTF-8"));
$comment_photo = htmlentities(htmlentities($rowComment['photo'], ENT_QUOTES, "UTF-8"));
$comment_timer1 = htmlentities(htmlentities($rowComment['timer1'], ENT_QUOTES, "UTF-8"));




            ?>


<!--comment div starts-->
 <div class="postx comment_css">
                    
<img class='' style='border-style: solid; border-width:3px; border-color:#ec5574; width:40px;height:40px; max-width:40px;max-height:40px;border-radius: 50%;' 
src='backend/user_photos/<?php echo $comment_photo; ?>'></a><br>
<b style='color:#ec5574;font-size:14px;' >Name: <?php echo $comment_fullname; ?>  </b><br>
<b style='font-size:12px;text-align:left;'>Comment: <?php echo $comment; ?></b><br>

<span style='color:#800000;'><b> Time: </b> <span data-livestamp="<?php echo $comment_timer1;?>"></span></span> 
</div><p></p>

           
<!--comment div ends-->

<?php
// close while in comments
                }
            ?>




<!-- comment starts-->
<div class="conatinerx rowx">



<div id="loader_comments_send"></div>
<div id="result_comments_send"></div>

<div class="col-sm-12 form-group">
 <textarea id="comdesc"  class="col-sm-12 form-control" style="color:black;"  placeholder="Enter Comments">
</textarea><br>
</div>


<div class="col-sm-12 form-group">
<button  data-postid='<?php echo $post_id; ?>' id="<?php echo $post_id; ?>" class="comment_send_btn pull-right readmore_btn">Comments</button>
</div><br><br>

</div>

<!-- comment ends-->






<?php 
ob_flush();
?>














