<?php 


$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();
$result=$connect->query("SELECT * FROM messages WHERE `id2` = '".$_SESSION['id']."' ");//AND `read_id2` = 'false'

$i = 1;

while($row = $result->fetch_assoc()){
	$j = $i;
	$k = 0;
	while ($j > 0){
		if ($a[$j] == $row['id1']) {
			$k++;
		}
		$j--;
	}

	if ($k == 0) {
		$a[$i] = $row['id1'];
		$i++;
	}

	
}

$j = 1;

while ($j < $i){
	$k=0;
	$result=$connect->query("SELECT * FROM messages WHERE `id1` = '".$a[$j]."' AND `id2` = '".$_SESSION['id']."'");
	while ($row = $result->fetch_assoc()){

		if ($row['read_id2'] == 'false') {
			$k=$k+1;
		}
	}
	echo $a[$j].'-'.$k.',';
	$j++;
}
echo ".";



 ?>	
