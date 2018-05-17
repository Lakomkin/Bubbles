
<?php 
if ($_SERVER['REQUEST_URI'] == '/') $page='home';
else {

	$page = substr($_SERVER['REQUEST_URI'], 1);
	
}



$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');
session_start();
if (file_exists('all/'.$page.'.php')) include 'all/'.$page.'.php';
elseif(file_exists('guest/'.$page.'.php')) include 'guest/'.$page.'.php';
elseif($_SESSION['auth'] == 'true' && file_exists('auth/'.$page.'.php')) include 'auth/'.$page.'.php';
elseif($_SESSION['page'] !='' && $_SESSION['auth'] == 'true' ) include 'auth/frame.php';
else exit('not_found 404');





 ?>

