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

$post_id = strip_tags($_POST['post_id']);
$title = strip_tags($_POST['title']);
$postid  = $post_id;
$like = '1';


if ($post_id == ''){
exit();
}

include('db_connection.php');


if($post_id != ''){

$timer = time();


//check if User has already like the post

$resu = $db->prepare('SELECT * FROM post_like WHERE  postid=:postid and userid=:userid');
$resu->execute(array(':postid' => $post_id, ':userid' => $userid_sess));
$rowpu = $resu->fetch();
$c_count= $resu->rowCount();
if($c_count == '1'){

$return_arr = array("msg"=>"failed");
echo json_encode($return_arr);
exit();
}




// insert into post_like table
$statement = $db->prepare('INSERT INTO post_like
(postid,like_count,timer1,userid,fullname,photo)
 
                          values
(:postid,:like_count,:timer1,:userid,:fullname,:photo)');

$statement->execute(array( 
':postid' => $post_id,
':like_count' => $like,
':timer1' => $timer,
':userid' => $userid_sess,
':fullname' => $fullname_sess,
':photo' => $photo_sess

));


//$res = $db->query("SELECT LAST_INSERT_ID()");
//$commentID = $res->fetchColumn();


// query table comments to get data
$result = $db->prepare('SELECT * FROM posts WHERE id =:id');
$result->execute(array(':id' => $post_id));
$db_count = $result->rowCount();

if($db_count ==0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>This post does not exist Yet.. <b></b></div>";
}
$row = $result->fetch();


$t_like= htmlentities(htmlentities($row['total_like'], ENT_QUOTES, "UTF-8"));
$postid= htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$totallike = $t_like + 1;
$post_userid= htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
$reciever_userid = $post_userid;
$title= htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$title_seo= htmlentities(htmlentities($row['title_seo'], ENT_QUOTES, "UTF-8"));

            

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
':type' => 'post_like',
':timing' => $timer,
':title' => $title,
':title_seo' => $title_seo
));






// update like conts for posts

$cct = $db->prepare('select * from posts where id=:id');
$cct->execute(array(':id' =>$post_id));
$rct_row = $cct->fetch();
$totallikes = $rct_row['total_like'];
$total_l = $totallikes + 1;

$update2= $db->prepare('UPDATE posts set total_like =:total_like where id=:id');
$update2->execute(array(':total_like' => $total_l, ':id' =>$post_id));



}

//$resultp = $db->prepare('SELECT COUNT(*) AS cnt FROM post_like WHERE postid=:postid');
$resultp = $db->prepare('SELECT COUNT(*) AS cnt FROM post_like WHERE  postid=:postid');
$resultp->execute(array(':postid' => $post_id));
$rowp = $resultp->fetch();
$totalliking = $rowp['cnt'];


$return_arr = array("like"=>$totalliking, "msg"=>"success");
echo json_encode($return_arr);