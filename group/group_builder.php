
<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();
$result = $connect->query("SELECT * FROM groups WHERE id_2 = '".$_POST['id']."'");
$res = $connect->query("SELECT * FROM relations WHERE id1 = '".$_SESSION['id']."' AND id2 = '".$_POST['id']."'");
$s = $connect->query("SELECT * FROM relations WHERE id2 = '".$_POST['id']."' ");

$j = $result->num_rows;
$i = $result->num_rows;
$subs = $s->num_rows;
if ( $j > 0 ) {
	if ( $i > 0 ) {
		$btn = '<a class="center-block write_message" id="buttons" style="margin-top: 35px;">Вы уже подписаны</a>';
	}else {$btn = '<a class="center-block write_message" id="active_buttons" style="margin-top: 35px;">Подписаться</a>';}
	$row = $result->fetch_assoc();
	echo '
		<div class="card container-fluid " style="width: 810px; float: left;margin-bottom: 20px;">
			<div class="row">
				<img src="/img/dubai_city.jpg" style="width: 100%;"><br>
					<div class="row">
						<div class="col-sm-5">
							<img src="'.$row['avatar'].'" alt="" id="person_avatar">
							<div class="stats_holder">
								<h4 id="name">'.$row['name'].'</h4><br>
								<h5 id="stats">
									<span id="numb">'.$subs.'</span>
									<span id="subs">Подписчиков</span>
								</h5>
							</div>
						</div>		
						<div class="col-sm-3" >
						'.$btn.'
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-3 common">
							<h5 id="common" style="text-align: center;">
								<h5 id="subs" >Статус :</h5>
								<h4 id="status">'.$row['status'].'</h4>
							</h5>
						</div>	
					</div>
				</div>
			</div>';
}else echo 'такая группа была удална или еще не была создана'

?>




	<!---->