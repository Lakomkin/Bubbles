<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$author_id = $_POST['author'];
$post = $_POST['post'];
$likes = 0;
$result = $connect->query("INSERT INTO likes
	VALUES ('','".$author_id ."','".$post."','')");

$result = $connect->query("SELECT * FROM likes");
while ($row = $result->fetch_assoc()){
			if ($row['post']==$post) {
				$likes ++;
			}
		}
echo $likes;
 ?>