<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();


$connect->query("INSERT INTO relations VALUES ('','".$_POST['id1']."','".$_POST['id2']."','1')");
echo "string";
 ?>