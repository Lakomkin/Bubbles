<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();
$b =1 ;
$k = 0 ;
$last = $_SESSION['last_post'];
$n = $_POST['times'];
$id = $_POST['user'];
$res= $connect->query("SELECT * FROM users WHERE id = '".$id."' ");
$user = $res->fetch_assoc();
$result= $connect->query("SELECT  * FROM post ORDER BY id DESC ");



while ($row = $result->fetch_assoc()){
	if ($n < 1) {
		$_SESSION['last_post'] = $last - 1;
		break;
	}
	if ($row['page'] == $id && $row['id'] && $row['id'] < $last){
		$res= $connect->query("SELECT * FROM users WHERE id = '".$row['author_id']."' ");
		$data = $res->fetch_assoc();
		$img_query = $connect->query("SELECT * FROM img WHERE id = '".$row['post_img']."' ");
		$img_info = $img_query->fetch_assoc();

		$likes =0;

		$comment =	'';
		$name = 	$data['name'];
		$date = 	$row['post_time'];
		$commen = 	0;
		$text =		$row['post_text'];
		$img = 		$img_info['link'];
		$ava = 		'<img src="'.$data['avatar'].'" id="post_av" >';
	  	$ava2 = 	'';
	  	$style = 	'';
	  	$like_icon= '<h5 id="like_label" class="lll'.$row['id'].'">Нравится<img src="/img/like_icon1.png" onclick="like('.$row['id'].',0);" class="like" ></h5>';
		if ($text !=''){
			$ava = ''; 
			$ava2 = '<img src="'.$data['avatar'].'" id="post_av2">';
			$style = 2;}
		$comments= $connect->query("SELECT * FROM comments ORDER BY id DESC");
		$data= $connect->query("SELECT * FROM likes");
		
		while ($line = $comments->fetch_assoc()){
			if ($line['post_id'] == $row['id']){
				if ($i < 2){
					$comor= $connect->query("SELECT * FROM users WHERE id = '".$line['author_id']."' ");
					$com = $comor->fetch_assoc();
					$part = '<div class="row" style="padding-top : 15px;">
									<div class="col-sm-1"></div>
									<div class="col-sm-10">
									
										<img style="width: 40px;margin-top: 8px;" src="'.$com['avatar'].'" id="post_av" alt="">
										<h5 id="PName" style ="padding-left: 40px;">'.$com['name'].'</h5>
										<h5 id="Ptime" style ="padding-left: 40px;">'.$line['com_date'].'</h5>
										<h5>'.$line['com_body'].'</h5>
										<hr style ="margin-bottom: 5px;background-color: #b7b7b7;color:#b7b7b7; opacity : 0.5;">
									</div>
									<div class="col-sm-1" ></div>
								</div>';
					$comment = $comment.$part; 
					$i++;
				}else if ($b < 2){
					$l= '<div class="row" style="padding-top : 15px;">
									<div class="col-sm-1"></div>
									<div class="col-sm-10">
									<h5>показать еще </h5>
									</div>
									<div class="col-sm-1" ></div></div>';
					$comment = $comment.$l;
					$b++;
				}
				$commen++;
			}
		}
		while ($like = $data->fetch_assoc()){
			if ($like['post']==$row['id']) {
				if ($like['author_id']==$_SESSION['id']) {
					$like_icon = '<h5 id="like_label">Нравится<img src="/img/like_icon2.png" onclick="like('.$row['id'].',1);" class="like"></h5>';
				}
				$likes ++;
			}}
		//<img src="/img/like_icon.png" id="like"><input type="checkbox" id="like_box"><label for="like_box"></label>
		echo ' 
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-8 post">
					<div class="cointainer-fluid" style="padding: 0;margin: 0;">
						<div class="row">
							<div class="col-sm-4" style="display: inline-block;"> 
								'.$ava2.'
								<h5 id="PName'.$style.'">'.$name.'</h5>
								<h5 id="Ptime'.$style.'">'.$date.'</h5>
							</div>
							<div class="col-sm-5"></div>
							<div class="col-sm-3">
								<h5 id="likes" class="likes_'.$row['id'].'">'.$likes.'</h5>
								'.$like_icon.'
							</div>
						</div>
						<div class="row">
							
							<div class="col-sm-10"><h4>'.$text.'</h4></div>
							
						</div>
						<div class="row">
							'.$ava.'
								<img src="'.$img.'" id="post_bg" class="postimg" style="width:100%;" data-toggle="modal" data-target="#details" onclick="Open_Details('.$row['id'].');">
								
							
						</div>

						<div class="row">
							<div class="col-sm-6">
								<img src="/img/comment_icon.png" id="comment_icon">
								<h5 id="comment">'.$commen.'</h5>
								<h5 id="comment_label"  onclick="AddCom('.$row['id'].',1);">+Комментий</h5>
							</div>
							<div class="col-sm-6"></div>
						</div>
						<hr style = "background-color: #f3f3f3;color: #f3f3f3; height : 5px; width :100%; padding-left:40px;margin-left:-20px;">
						<span id="PostId_'.$row['id'].'" >'.$comment.'</span>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>';

	
		$n = $n - 1;
		$last = $row['id'];
		$k = $k + 1; 
	}
	$commen = 0;
	$i= 0;
	$b =1;
}

/*if ($k == 0 && $_SESSION['post_end']== false ) {
	echo '			
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-8 post">
				<div class="cointainer-fluid">
					<div class="row">
						<div class="col-sm-12 "><h3 class="center-block">нет записей</h3></div>
					</div>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>';

	$_SESSION['post_end']= true;
	
	

}*/

$_SESSION['last_post'] = $last - 1; 
	
?>
	
<link href="css/page.css" rel="stylesheet">



