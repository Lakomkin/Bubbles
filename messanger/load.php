
<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$_SESSION['id2']= $_POST['id2'];
$id2 = $_POST['id2'];
$last = 0;
$result=$connect->query("SELECT * FROM messages /*ORDER BY id DESC*/");
while ($row = $result->fetch_assoc()){



if ($row['id1'] == $_SESSION['id'] && $row['id2'] == $id2) {
	$result1=$connect->query("SELECT * FROM users WHERE id = '".$row['id1']."'");
	$row1 = $result1->fetch_assoc();
	$last = $row['id'];

	$res=$connect->query("UPDATE messages SET read_id2='true' WHERE id='".$row['id']."'");
	
	$avatar = $row1['avatar'];
	$message = $row['message'];
	echo '	
	<div style="float: right;padding-bottom: 10px;" id="bubble">
		<div style="color: #fff;width: 250px;background-color: #48337f;border-radius: 5px 5px 0 5px;display: inline-block;"><h5 class="replica" style="margin:0;padding:0;padding-top: 10px;padding-bottom:10px;padding-left:15px;font-family:"reg";">'.$message.'</h5></div>
		<img src="'.$avatar.'" style="width: 50px; border-radius: 50px; margin-bottom: -20px; ">
	</div>';
}else
if ($row['id2'] == $_SESSION['id'] && $row['id1'] == $id2) {
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
$_SESSION['last_message']=$last;
$_SESSION['id2']= $_POST['id2'];
 ?>	