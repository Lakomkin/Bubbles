<?php 

session_start();
$_SESSION['info']=
 ' 	<h1 class="center-block">'.$_POST['title'].'</h1>
 	<h5 class ="center-block">адрес :'.$_POST['address'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; телефон :'.$_POST['phone'].' </h5>
 	<h3 class ="center-block">'.$_POST['info'].'</h3>';

 ?>

