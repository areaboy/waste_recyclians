<?php
error_reporting(0);
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

$postid = strip_tags($_POST['postid']);
$comdesc = strip_tags($_POST['comdesc']);


if ($comdesc == ''){
exit();
}

include('db_connection.php');


if($comdesc != ''){

$token= md5(uniqid());
$timer = time();


$statement = $db->prepare('INSERT INTO comments
(postid,comment,timer1,userid,fullname,photo)
 
                          values
(:postid,:comment,:timer1,:userid,:fullname,:photo)');

$statement->execute(array( 
':postid' => $postid,
':comment' => $comdesc,
':timer1' => $timer,
':userid' => $userid_sess,
':fullname' => $fullname_sess,
':photo' => $photo_sess

));





$res = $db->query("SELECT LAST_INSERT_ID()");
$commentID = $res->fetchColumn();


// query table posts to get data
$result = $db->prepare('SELECT * FROM posts WHERE id =:id');
$result->execute(array(':id' => $postid));
$db_count = $result->rowCount();

if($db_count ==0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>This Post does not exist Yet.. <b></b></div>";
}
$row = $result->fetch();

$post_userid= htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
$reciever_userid = $post_userid;
$title= htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$title_seo= htmlentities(htmlentities($row['title_seo'], ENT_QUOTES, "UTF-8"));
$t_comments= htmlentities(htmlentities($row['total_comments'], ENT_QUOTES, "UTF-8"));;
$totalcomment = $t_comments + 1;


               


// insert into notification post table



$statement2 = $db->prepare('INSERT INTO notification
(post_id,userid,fullname,photo,reciever_id,status,type,timing,title,title_seo)
                        values
(:post_id,:userid,:fullname,:photo,:reciever_id,:status,:type,:timing,:title,:title_seo)');
$statement2->execute(array( 

':post_id' => $postid,
':userid' => $userid_sess,
':fullname' => $fullname_sess,
':photo' => $photo_sess,
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'comment',
':timing' => $timer,
':title' => $title,
':title_seo' => $title_seo
));





// update comments conts for posts

$cct = $db->prepare('select * from posts where id=:id');
$cct->execute(array(':id' =>$postid));
$rct_row = $cct->fetch();
$totalcom = $rct_row['total_comments'];
$total_comment_post = $totalcom + 1;

$update2= $db->prepare('UPDATE posts set total_comments =:total_comments where id=:id');
$update2->execute(array(':total_comments' => $total_comment_post, ':id' =>$postid));



}


$comment_result = $db->prepare('SELECT COUNT(*) AS cntcomment FROM comments WHERE postid=:postid');
$comment_result->execute(array(':postid' => $postid));
$comment_row = $comment_result->fetch();
$totalcomment = $comment_row['cntcomment'];
$return_arr = array("comment"=>$totalcomment,"comdesc"=>$comdesc,"comment_username"=>$userid,"comment_fullname"=>$fullname_sess,"comment_photo"=>$photo_sess,"comment_time"=>$timer);

echo json_encode($return_arr);