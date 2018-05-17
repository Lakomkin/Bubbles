<style>
textarea#comment_area{
	border: 0;
	margin-top: 15px;
	resize: none;
	outline: none;
	position: relative;
}	

</style>
<link href="css/person.css" rel="stylesheet">
<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');

$i = 1;
session_start();
$result = $connect->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."' ");
$row = $result->fetch_assoc();
$avatar = $row['avatar'];

$result = $connect->query("SELECT * FROM likes WHERE post = '".$_POST['post_id']."' ");
$likes = $result->num_rows;

$result = $connect->query("SELECT * FROM comments WHERE post_id = '".$_POST['post_id']."' ");
$coms = $result->num_rows;

$result = $connect->query("SELECT * FROM post WHERE id = '".$_POST['post_id']."' ");
$row = $result->fetch_assoc();


$img_prop = $connect->query("SELECT * FROM img WHERE id = '".$row['post_img']."' ");
$img = $img_prop->fetch_assoc();


$result = $connect->query("SELECT * FROM comments WHERE post_id = '".$_POST['post_id']."' ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
	$res = $connect->query("SELECT * FROM users WHERE id = '".$row['author_id']."' ");
	$user = $res->fetch_assoc();
	$ava = $user['avatar'];
	$name = $user['name'].' '.$user['last_name'];
	$text = $row['com_body'];
	$comments = $comments.'
	<div class="row" style="padding-top : 15px;" >
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<a href="#"><img style="width: 40px;margin-top: 10px;" src="'.$ava.'" id="post_av" alt=""></a>	
				<h5 id="PName" style ="padding-left: 40px;">'.$name.'</h5>
				<h5 id="Ptime" style ="padding-left: 40px;">0000-00-00</h5>
				<h5>'.$text.'</h5>
				<hr style ="margin-bottom: 5px;background-color: #b7b7b7;color:#b7b7b7; opacity : 0.5;">
			</div>
		<div class="col-sm-3" ></div>
	</div>
	';}

$result = $connect->query("SELECT * FROM img WHERE album_id = '".$img['album_id']."' ");
$res = $connect->query("SELECT * FROM albums WHERE id = '".$img['album_id']."' ");
//margin:-41px -156px -40px -30px;
$al = $res->fetch_assoc();
$album = '<span id="numb" style="display: block;padding: 0;margin: 0;font-size: 12pt;">'.$al['name'].'</span>'; 
while ($row = $result->fetch_assoc()){
	if ($i == 5) {
		break;
	}
	if ($i == 3)  {
		$album = $album.'<br>';
	}
	$album = $album.'<img src="'.$row['link'].'" style="width: 60px;" >';
	$i=$i+1;
}

echo '
<img src="'.$img['link'].'" alt="" style="width: 100%;border-radius: 5px 5px 0px 0px;"	>

<div class="contanier-fluid">
	<div class="row" style="padding-bottom: 20px;">
		<div class="col-sm-3">
			<span id="numb" style="display: block;padding: 0;margin: 0;font-size: 12pt;margin-top: 45px;margin-left: 35px;">'.$likes.'<img src="/img/like_icon2.png" id="icons"></span>
			<span id="numb" style="display: block;padding: 0;margin: 0;font-size: 12pt;margin-top: 17px;margin-left: 35px;">'.$coms.'<img src="/img/comment_icon.png" id="icons"></span>
		</div>
		<div class="col-sm-6 ">
			<center>
				<img src="'.$avatar.'" id="detail_av" ><br>
				<textarea name="" id="comment_area" cols="30" rows="1" placeholder="Прокомментируйте запись"></textarea>
				<a class="write_message " id="active_buttons" style="text-align: center;margin: 0;margin-top: 23px;display: block;position: relative;">Комментировать</a>
			</center>
		</div>
		<div class="col-sm-3 " style="text-align: center;">
			<center>
			<a class="write_message center-block" id="active_buttons" style="text-align: center;margin: 0;margin-top: 45px;display: block;">Добавить в Bubble</a>
			<span id="subs" style="text-align: center;padding: 0;margin: 0;">Из альбома :</span>
			<br><div style="position: relative;">'.$album.'</div>
			</center>
		</div>
	</div>
	<div id="comments_holder" style="padding-bottom: 30px;">
		'.$comments.'
		</div>
</div>';

?>



<!--
<img src="/img/example.jpeg" alt="" style="width: 100%;border-radius: 5px 5px 0px 0px;"	>

<div class="contanier-fluid">
	<div class="row">
		<div class="col-sm-3">
			<span id="numb" style="display: block;padding: 0;margin: 0;font-size: 12pt;margin-top: 45px;margin-left: 35px;">1324 <img src="/img/like_icon2.png" id="icons"></span>
			<span id="numb" style="display: block;padding: 0;margin: 0;font-size: 12pt;margin-top: 17px;margin-left: 35px;">1324 <img src="/img/comment_icon.png" id="icons"></span>
		</div>
		<div class="col-sm-6 ">
			<center>
				<img src="/user_files/avatar.jpg" id="detail_av" ><br>
				<textarea name="" id="comment_area" cols="30" rows="1" placeholder="Прокомментируйте запись"></textarea>
				<a class="write_message " id="active_buttons" style="text-align: center;margin: 0;margin-top: 23px;display: block;position: relative;">Комментировать</a>
			</center>
		</div>
		<div class="col-sm-3 " style="text-align: center;">
			<center>
			<a class="write_message center-block" id="active_buttons" style="text-align: center;margin: 0;margin-top: 45px;display: block;">Добавить в Bubble</a>
			<span id="subs" style="text-align: center;padding: 0;margin: 0;">Из альбома :</span>
			</center>
		</div>
	</div>
		<div class="row" style="padding-top : 15px;">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<a href="#"><img style="width: 40px;margin-top: 10px;" src="/user_files/avatar.jpg" id="post_av" alt=""></a>	
				<h5 id="PName" style ="padding-left: 40px;">ker</h5>
				<h5 id="Ptime" style ="padding-left: 40px;">0000-00-00</h5>
				<h5>у меня такой же макбук</h5>
				<hr style ="margin-bottom: 5px;background-color: #b7b7b7;color:#b7b7b7; opacity : 0.5;">
			</div>
			<div class="col-sm-3" ></div>
		</div>
</div>
-->
