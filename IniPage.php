<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$_SESSION['page'] = $_GET['page'];

 ?>