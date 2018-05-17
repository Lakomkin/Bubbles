<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$result = $connect->query("SELECT * FROM users WHERE id = '".$_POST['id']."'");
$res = $connect->query("SELECT * FROM relations WHERE (id1 = '".$_SESSION['id']."' AND id2 = '".$_POST['id']."') OR (id2 = '".$_SESSION['id']."' AND id1 = '".$_POST['id']."')");

$n = $result->num_rows;
$i = $res->num_rows;

if ($n > 0) {
	if ($_POST['id']!=$_SESSION['id']) {
		if ($i > 0){
			$row = $res->fetch_assoc();
			if ($row['status'] == 1) {
			$buttons = '		
			<a class="center-block friend" id="buttons" style="margin-top: 20px;">Уже ваш друг</a>
			<a class="center-block write_message" id="active_buttons" style="margin-top: 10px;">Написать сообщение</a>';			
			}else if ($row['status'] == 0){
			$buttons = '		
			<a class="center-block request_sent" id="buttons" style="margin-top: 20px;">Заявка отправлена</a>
			<a class="center-block write_message" id="active_buttons" style="margin-top: 10px;">Написать сообщение</a>';			
			}
		}else $buttons = '
			<a onclick="Send_request();" class="center-block send_request" id="active_buttons" style="margin-top: 20px;">Добавить в друзья</a>
			<a class="center-block write_message" id="active_buttons" style="margin-top: 10px;">Написать сообщение</a>';
	
		
	}else if ($_POST['id']==$_SESSION['id']){
		$buttons = '		
			<a class="center-block inactive_btn" id="buttons" style="margin-top: 20px;">Ваша страница</a>
			<a class="center-block edit_btn" id="active_buttons" style="margin-top: 10px;">Редактировать</a>';
	}
	$row = $result->fetch_assoc();
	$res = $connect->query("SELECT * FROM relations WHERE (id1 = '".$_POST['id']."' AND status = '0') OR (id2 = '".$_POST['id']."' AND status = '0')");
	$subs = $res->num_rows;
	$res = $connect->query("SELECT * FROM relations WHERE (id1 = '".$_POST['id']."' AND status = '1') OR (id2 = '".$_POST['id']."' AND status = '1')");
	$friends = $res->num_rows;
	echo '
	<div class="card container-fluid " style="width: 810px; float: left;margin-bottom: 20px;">
		<div class="row">
			<img src="/img/photo.jpg" style="width: 100%;"><br>
			
				<div class="row">
					<div class="col-sm-5">
						<img src="'.$row['avatar'].'" alt="" id="person_avatar">
						<div class="stats_holder">
							<h4 id="name">'.$row['name'].' '.$row['last_name'].'</h4><br>
							<h5 id="stats">
								<span id="numb">'.$subs.'</span>
								<span id="subs">Подписчиков</span>
								<span id="city">Барнаул</span>
							</h5>
						</div>
					</div>		
					<div class="col-sm-3" >
					'.$buttons.'
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3 common">
						<h5 id="common">
							<span id="numb" style="padding: 0;margin: 0;margin-left: 0px;">'.$friends.'</span>
							<span id="subs" style="padding: 0;margin: 0;margin-left: 5px;">Друзей</span>
							<span id="numb" style="padding: 0;margin: 0;margin-left: 40px;">3</span>
							<span id="subs" style="padding: 0;margin: 0;margin-left: 3px;">Общих</span>
						</h5>
						<div class="common_friends">
							<img src="/user_files/avatar.jpg"  alt="" id="common_friends">
							<img src="/user_files/avatarf.jpg" alt="" id="common_friends">
							<img src="/user_files/sasha.jpg"   alt="" id="common_friends">
						</div>
					</div>	

				</div>
			</div>

		</div>
	';

}else echo "Страница не найдена";

//echo $row['name'];


 ?>

 	