<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$text = $_POST['text'];
$id2 = $_SESSION['id2'];
$last = $_SESSION['last_message'];

$result=$connect->query("INSERT INTO messages  VALUES ('','".$_SESSION['id']."','".$id2."','".$text."','','true','false') ");

$result=$connect->query("SELECT LAST_INSERT_ID()");
$row = $result->fetch_assoc();
$last = $row['LAST_INSERT_ID()'];
$_SESSION['last_message'] = $last;
$result=$connect->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."' ");
$row = $result->fetch_assoc();
$avatar = $row['avatar'];

echo '<div style="float: right;padding-bottom: 10px;" id="bubble">
		<div style="color: #fff;width: 250px;background-color: #48337f;border-radius: 5px 5px 0 5px;display: inline-block;"><h5 class="replica" style="margin:0;padding:0;padding-top: 10px;padding-bottom:10px;padding-left:15px;font-family:"reg";">'.$text.'</h5></div>
		<img src="'.$avatar.'" style="width: 50px; border-radius: 50px; margin-bottom: -20px; ">
	</div>';



 ?>	