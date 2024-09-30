<?php

error_reporting(0);

//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, POST');
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('db_connection.php');

$userid_sess_data = $_POST['userid_sess_data'];

$result = $db->prepare('SELECT * FROM notification where reciever_id = :reciever_id and status =:status');

		$result->execute(array(
			':reciever_id' => $userid_sess_data, ':status' =>'unread'
    ));
$nosofrows = $result->rowCount();
echo $nosofrows;




?>

