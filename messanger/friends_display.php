<span class="body"><?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();


 ?>	



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<style>
	.new_message{
		font-size: 10pt;
		margin-top: 18px;
		margin-right: 18px;
		position: absolute;
		color: #fff;
		right: 0;
		padding-top: 1px;
		padding-left: 5px;
		padding-right: 5px;
		padding-bottom: 1px;
		background-color: #f84848;
		border-radius: 20px;
	}
	#grey_txt{
		padding: 0;
		font-size: 18px;
		font-family: "reg";
		color: #a8a8a8;
	}
	#avatar{
		padding: 0;
		border-radius: 30px;
		width: 50px;
		margin-bottom: -15px;
		margin-right: 22px;
	}
	h5.name{
		margin: 0;
		padding: 0;
		font-family: "reg";
		padding-left: 15px;
	}
	.selected{
		background-color: #ededed;
	}
</style>


<script>

/*function mate(id){
	$( "#mate"+id ).addClass( "selected" );
	load();
}*/


</script>



<?php

function check ($id,$j,$a){
$k=0;

while ($j > 0){
	if ($a[$j] == $id) {
		return(false);
		$k++;
	}
	$j=$j-1;
}
if ($k == 0) {
	return(true);
}
}



$i=1;
$result1=$connect->query("SELECT * FROM messages ORDER BY id DESC");

while ($row1 = $result1->fetch_assoc()){

	if($row1['id1'] == $_SESSION['id']){
		if (check($row1['id2'],$i,$a) == true) {
			$num_bar='';
			$result3=$connect->query("
			SELECT * FROM messages WHERE `id1` = '".$row1['id2']."' AND `id2` = '".$_SESSION['id']."' AND `read_id2` = 'false'");
			$num_rows = $result3->num_rows;
			if ($num_rows != 0){

				$num_bar = '<span class="new_message">'.$num_rows.'</span>';
			}

			$a[$i] = $row1['id2'];
			$result2=$connect->query("SELECT * FROM users WHERE id = '".$row1['id2']."'");
			$row2 = $result2->fetch_assoc();
			echo "<div 
			class='friend_bar'			
			id='mate".$row2['id']."'  
			style='padding-top: 0px;padding-top:7px;padding-bottom:15px;'>
			<h5 id='grey_txt' class='name'>
			<img src='".$row2['avatar']."' id='avatar'>".$row2['name'].$num_bar."</h5></div>";
			$i=$i+1;
		}
	}
	if($row1['id2'] == $_SESSION['id']){
		if (check($row1['id1'],$i,$a) == true) {
			$num_bar='';
			$result3=$connect->query("
			SELECT * FROM messages WHERE `id1` = '".$row1['id1']."' AND `id2` = '".$_SESSION['id']."' AND `read_id2` = 'false'");
			$num_rows = $result3->num_rows;
			if ($num_rows != 0){

				$num_bar = '<span class="new_message">'.$num_rows.'</span>';
			}

			$a[$i] = $row1['id1'];
			$result2=$connect->query("SELECT * FROM users WHERE id = '".$row1['id1']."'");
			$row2 = $result2->fetch_assoc();
			echo "<div 
			class='friend_bar'
			id='mate".$row2['id']."'  
			style='padding-top: 0px;padding-top:7px;padding-bottom:15px;'>
			<h5 id='grey_txt' class='name'>
			<img src='".$row2['avatar']."' id='avatar'>".$row2['name'].$num_bar."</h5></div>";
			$i=$i+1;
		}
	}
	
} 
echo "<hr style='background-color: #bdbdbc;border:0;border-top: 1px solid #bdbdbc;'>";
$result=$connect->query("SELECT * FROM relations ");

while ($row = $result->fetch_assoc()){
	if ($row['id1'] == $_SESSION['id'] && check($row['id2'],$i,$a) == true ) {
		
		$result1=$connect->query("SELECT * FROM users WHERE id = '".$row['id2']."'");
		$row1 = $result1->fetch_assoc();
		echo "<div 
		class='friend_bar'
		id='mate".$row1['id']."' 
		style='padding-top: 0px;padding-top:7px;padding-bottom:15px;'>
		<h5 id='grey_txt' class='name'>
		<img src='".$row1['avatar']."' id='avatar'>".$row1['name']."</h5></div>";
	}
	if ($row['id2'] == $_SESSION['id'] && check($row['id1'],$i,$a ) == true) {
		
		$result1=$connect->query("SELECT * FROM users WHERE id = '".$row['id1']."'");
		$row1 = $result1->fetch_assoc();
		echo "<div 
		class='friend_bar'
		id='mate".$row1['id']."' 
		style='padding-top: 0px;padding-top:7px;padding-bottom:15px;'>
		<h5 id='grey_txt' class='name'>
		<img src='".$row1['avatar']."' id='avatar'>".$row1['name']."</h5></div>";
	}
} 
	

 ?>
</span>
