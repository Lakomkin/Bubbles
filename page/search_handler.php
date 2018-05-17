<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();


$query = $_POST['query'];

$result = $connect->query("SELECT * FROM users WHERE name LIKE '".$_POST['query']."%' OR last_name LIKE '".$_POST['query']."%'");


if ($query != ''){



while ($row = $result->fetch_assoc()){
if ($row['id'] != $_SESSION['id']) {
	
	$avatar = '<a href="/id'.$row['id'].'"><img src="'.$row['avatar'].'" alt=""></a>';
	$subed = $connect->query("SELECT * FROM relations WHERE  (id1 = '".$_SESSION['id']."' AND id2 = '".$row['id']."') OR (id2 = '".$_SESSION['id']."' AND id1 = '".$row['id']."')");
	$n = $subed->num_rows;


	$name =  $row['name'].' '.$row['last_name'];
	$name2 = strtolower($name);
	$query = strtolower($query);

	$l  =    strlen($query);  											  #echo "длинна запроса : ".$l.'<br>';
	$pos =   strpos($name2,$query);										  #echo "позиция в имени : ".$pos.'<br>';
	$past =  substr($name,$pos,$l);										  #echo "выделение : ".$past.'<br>';
	$rep =   '<span style="background-color:#cccaef;">'.$past.'</span>';  #echo "покарска: ".$rep.'<br>';
	$name =  str_replace($past,$rep,$name);								  #echo "результат : ".$name.'<br>';


	if ($n > 0) {
		$btn = '<a href="" class="center-block" id="buttons" style="margin-top: 16px;">Уже ваш друг</a>';
	}else $btn = '<a href="" class="center-block" id="active_buttons" style="margin-top: 16px;">Добавить в друзья</a>';
	echo '		
		<div class="container friend_card" style="">
			<div class="row">
				<div class="col-sm-3">'.$avatar.'</div>
				<div class="col-sm-1"></div>
				<div class="col-sm-3" style="text-align: center;">
					<h3 id="friends_name">'.$name.'</h3>
					<h5 id="label">Общие друзья</h5>
					<h3 id="friends_number">41</h3>
				</div>
				<div class="col-sm-2"></div>
				<div class="col-sm-3 ">
					'.$btn.'
					<a href="" class="center-block" id="active_buttons" style="margin-top: 10px;">Написать сообщение</a>
				</div>
			</div>
		</div>';

	}
}
}else {
	$result = $connect->query("SELECT * FROM relations WHERE (id1 = '".$_SESSION['id']."' AND status = '1') OR (id2 = '".$_SESSION['id']."' AND status = '1')  ");
	while ($row = $result->fetch_assoc()){
		if ($row['id1'] == $_SESSION['id']) {
			$res = $connect->query("SELECT * FROM users WHERE id = '".$row['id2']."'");
			$friend_row = $res->fetch_assoc();
			$avatar = '<a href="/id'.$row['id2'].'"><img src="'.$friend_row['avatar'].'" alt=""></a>';
			#$common_fr = $connect->query("SELECT * FROM relations WHERE (id1 = '".$row['id2']."' AND id2 = '".$_SESSION."' AND status = '1')");
			echo '		
			<div class="container friend_card" style="">
				<div class="row">
					<div class="col-sm-3">'.$avatar.'</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3" style="text-align: center;">
						<h3 id="friends_name">'.$friend_row['name'].' '.$friend_row['last_name'].'</h3>
						<h5 id="label">Общие друзья</h5>
						<h3 id="friends_number">41</h3>
					</div>
					<div class="col-sm-2"></div>
					<div class="col-sm-3 ">
						<a href="" class="center-block" id="buttons" style="margin-top: 18px;">Уже ваш друг</a>
						<a href="" class="center-block" id="active_buttons" style="margin-top: 10px;">Написать сообщение</a>
					</div>
				</div>
			</div>';
		}
		if ($row['id2'] == $_SESSION['id']) {
			$res = $connect->query("SELECT * FROM users WHERE id = '".$row['id1']."'");
			$friend_row = $res->fetch_assoc();
			$avatar = '<a href="/id'.$row['id1'].'"><img src="'.$friend_row['avatar'].'" alt=""></a>';
			#$common_fr = $connect->query("SELECT * FROM relations WHERE (id1 = '".$row['id2']."' AND id2 = '".$_SESSION."' AND status = '1')");
			echo '		
			<div class="container friend_card" style="">
				<div class="row">
					<div class="col-sm-3">'.$avatar.'</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3" style="text-align: center;">
						<h3 id="friends_name">'.$friend_row['name'].' '.$friend_row['last_name'].'</h3>
						<h5 id="label">Общие друзья</h5>
						<h3 id="friends_number">41</h3>
					</div>
					<div class="col-sm-2"></div>
					<div class="col-sm-3 ">
						<a href="" class="center-block" id="buttons" style="margin-top: 18px;">Уже ваш друг</a>
						<a href="" class="center-block" id="active_buttons" style="margin-top: 10px;">Написать сообщение</a>
					</div>
				</div>
			</div>';
		}
		
		}
}

 ?>