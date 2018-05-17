<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$result = $connect->query("SELECT * FROM relations WHERE (id1 = '".$_SESSION['id']."' AND status = '3') OR (id2 = '".$_SESSION['id']."' AND status = '3')  ");







 ?>

<link href="css/friends.css" rel="stylesheet">

<script>
	jQuery(document).ready(function() {

		$("#search_friends").keyup(function(){
			var search = $("#search_friends").val();
			if (1> 0) {
				$.ajax({
					url : "/group/search_handler.php",
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
	<img src="/img/search_icon.png" alt="">
	<input type="text" id="search_friends" placeholder="Введите имя друга" autocomplete="off" style="width: 180px;">
</div>
	<div id="card_holder">
	<?php 

		while ($row = $result->fetch_assoc()){
		if ($row['id1'] == $_SESSION['id']) {
			$res = $connect->query("SELECT * FROM groups WHERE id_2 = '".$row['id2']."'");
			$friend_row = $res->fetch_assoc();
			$avatar = '<a href="/gr_'.$row['id2'].'"><img src="'.$friend_row['avatar'].'" alt=""></a>';

			$subed = $connect->query("SELECT * FROM relations WHERE id1 = '".$_SESSION['id']."' AND id2 = '".$row['id2']."'");
			$n = $subed->num_rows; 
			if ($n > 0) {
				$btn = '<a href="" class="center-block" id="buttons" style="margin-top: 36px;">Вы уже подписаны</a>';
			}else $btn = '<a href="" class="center-block" id="active_buttons" style="margin-top: 36px;">Подписаться</a>';

			$s = $connect->query("SELECT * FROM relations WHERE id2 = '".$friend_row['id_2']."' ");
			$subs = $s->num_rows;
			echo '		
			<div class="container friend_card" style="">
				<div class="row">
					<div class="col-sm-3">'.$avatar.'</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3" style="text-align: center;">
						<h3 id="friends_name">'.$friend_row['name'].'</h3>
						<h5 id="label">Подпичики</h5>
						<h3 id="friends_number">'.$subs.'</h3>
					</div>
					<div class="col-sm-2"></div>
					<div class="col-sm-3 ">
						'.$btn.'

					</div>
				</div>
			</div>';
		}
		
		}
	?>



	</div>
</div>

