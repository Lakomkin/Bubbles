<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();
$_SESSION['inter'] = $_POST['id'];
 ?>	




<link href="css/messanger.css" rel="stylesheet">
<style>
	h5{
		font-family: "reg";
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="/js/messanger.js"></script>
<script>



/*setInterval(function() {
	display();
}, 2000);*/


//setInterval(function() {}, 1000);




</script>


<div id="body" class="content">

<h3>Выберете диалог</h3>

</div>


<div id="bottom"></div>