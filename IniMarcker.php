<?php 


echo "lat : ".$_POST['lat']."  lng :  ".$_POST['lng'];

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$connect->query("INSERT INTO marckers VALUES ('','".$_POST['lat']."','".$_POST['lng']."','".$_SESSION['id']."','lvl1.png','','','','','')");

$result=$connect->query("SELECT ID FROM marckers 
	WHERE lat = '".$_POST['lat']."' AND lng = '".$_POST['lng']."' AND author_id = '".$_SESSION['id']."'");
$id = $result->fetch_assoc();
$_SESSION['marcker_id']=$id['ID'];
 ?>