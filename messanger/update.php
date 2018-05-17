<?php 


$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$id2 = $_SESSION['id2'];
$last = $_SESSION['last_message'];


$result=$connect->query("SELECT * FROM messages ");
while ($row = $result->fetch_assoc()){

	if ($row['id2'] == $_SESSION['id'] && $row['id1'] == $id2 && $row['id'] > $last) {
		$result1=$connect->query("SELECT * FROM users WHERE id = '".$row['id1']."'");
		$row1 = $result1->fetch_assoc();
		$last = $row['id'];

		$res=$connect->query("UPDATE messages SET read_id2='true' WHERE id='".$row['id']."'");
		
		$avatar = $row1['avatar'];
		$message = $row['message'];
		echo '	
		<div style="float: left; padding-bottom: 10px;" id="bubble">
			<img src="'.$avatar.'" style="width: 50px; border-radius: 50px; margin-bottom: -20px; ">
			<div style="color: #48337f;width: 250px;background-color: #f2f2f2;border-radius: 5px 5px 5px 0;display: inline-block;"><h5 class="replica" style="margin:0;padding:0;padding-top: 10px;padding-bottom:10px;padding-left:15px;font-family:"reg";">'.$message.'</h5></div>
		</div>';
	}
}
$_SESSION['last_message']= $last ;
 ?>	