
<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();


$text = $_POST['text'];
$id = 	$_POST['post_id'];
$author_id = $_SESSION['id'];

$result = $connect->query("INSERT INTO comments 
	VALUES ('','".$author_id ."','".$id."','".$text."','','','')");

$comor= $connect->query("SELECT * FROM users WHERE id = '".$author_id."' ");
$com = $comor->fetch_assoc();

$avatar = '<a href="/id'.$author_id.'"><img style="width: 40px;" src="'.$com['avatar'].'" id="post_av" alt=""></a>';
echo '	<div class="row" style="padding-top : 15px;">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
									
				'.$avatar.'
				<h5 id="PName" style ="padding-left: 40px;">'.$com['name'].'</h5>
				<h5 id="Ptime" style ="padding-left: 40px;">0000-00-00</h5>
				<h5>'.$text.'</h5>
				<hr style ="margin-bottom: 5px;background-color: #b7b7b7;color:#b7b7b7; opacity : 0.5;">
			</div>
			<div class="col-sm-1" ></div>
		</div>';
 ?>