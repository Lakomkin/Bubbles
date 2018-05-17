<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$result = $connect->query("SELECT * FROM relations WHERE (id1 = '".$_SESSION['id']."' AND status = '1') OR (id2 = '".$_SESSION['id']."' AND status = '1')  ");







 ?>

<link href="css/friends.css" rel="stylesheet">

<script>
	jQuery(document).ready(function() {

		$("#search_friends").keyup(function(){
			var search = $("#search_friends").val();
			if (1> 0) {
				$.ajax({
					url : "/page/search_handler.php",
					type: "POST",
					dataType: "html",
					data:({query : search})
				})
				.done(function(html){

					$("#card_holder").empty().append(html);
					
				});
			}
		});
    	

	});
</script>

<div class="left">
	
<div class="search_friends">
	<img src="/img/search_icon.png" alt="" style="">
	<input type="text" id="search_friends" placeholder="Введите имя друга" autocomplete="off" style="width: 180px;">
</div>
	<div id="card_holder">
	<?php 

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
	?>



	</div>
</div>
<?php 
	$result = $connect->query("SELECT * FROM relations WHERE id2 = '".$_SESSION['id']."' AND status = '0'  ");
	$n = $result->num_rows;
	if ($n > 0) {
		$content = 'Заявки в друзья <span class="num">'.$n.'</span>';
	}else $content = 'Заявок нет';

 ?>
<div class="right_column">
	<div class="options">
		<h3 class="option_txt"><?php echo $content; ?></h3>
		<h3 class="option_txt">Друзья в сети   <span class="num">23</span></h3>
		<hr id="hr">
		<h3 class="option_txt possible_friends">Возможные друзья</h3>
	</div>

	<div class="filters">
		<h3 class="option_txt" style="margin-left: -4px;">Поисковые фильтры:</h3>
		<hr id="hr">
	</div>
</div>




