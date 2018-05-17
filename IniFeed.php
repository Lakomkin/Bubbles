<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();

$k = 0;
$last = $_SESSION['last_note'];
$n = $_POST['times'];
$id = $_POST['user'];
$res= $connect->query("SELECT * FROM users WHERE id = '".$id."' ");
$user = $res->fetch_assoc();
$b= 1;


$result_1= $connect->query("SELECT * FROM post ORDER BY id DESC");

while ($row_1 = $result_1->fetch_assoc()){

	if ($n < 1) {
		$_SESSION['last_post'] = $last - 1;
		break;
	}

	$result_2 = $connect->query("SELECT * FROM relations ");

	while ($row_2 = $result_2->fetch_assoc()){

		if ($row_2['id1'] == $_SESSION['id'] && $row_1['id'] < $last ){
			if($row_2['id2'] == $row_1['author_id']){

				
				if ($row_2['status'] == '3') {
					$res= $connect->query("SELECT * FROM groups WHERE id_2 = '".$row_1['author_id']."' ");
					
				}else $res= $connect->query("SELECT * FROM users WHERE id = '".$row_1['author_id']."' ");
				$data = $res->fetch_assoc();
				

				if ($row_2['status'] == '3') {
					$ava ='<a href="/gr_'.$row_1['author_id'].'"><img src="'.$data['avatar'].'" id="post_av" ></a>';
				}else $ava ='<a href="/id'.$row_1['author_id'].'"><img src="'.$data['avatar'].'" id="post_av" ></a>';				
				
				$img_query = $connect->query("SELECT * FROM img WHERE id = '".$row_1['post_img']."' ");
				$img_info = $img_query->fetch_assoc();


				$likes =0;
				$name = 	$data['name'];
				$date = 	$row_1['post_time'];
				$commen = 0;
				$text =		$row_1['post_text'];
				$img = 		$img_info['link'];
				$ava2 = 	'';
				$style = 	'';
				$comment =	'';
				$commen = 0;
				$like_icon= '<h5 id="like_label" class="lll'.$row_1['id'].'">Нравится<img src="/img/like_icon1.png" onclick="like('.$row_1['id'].',0);" id="like"></h5>';


				if ($text !=''){
					$ava = '';
					$ava2 = '<a href="/id'.$row_1['author_id'].'"><img src="'.$data['avatar'].'" id="post_av2"></a>';
					if ($row_2['status'] == '3') {
						$ava2 = '<a href="/gr_'.$row_1['author_id'].'"><img src="'.$data['avatar'].'" id="post_av2"></a>';
					}
					$style = 2;
				}

				$comments= $connect->query("SELECT * FROM comments ORDER BY id DESC");
				$data= $connect->query("SELECT * FROM likes");
//___________coments 1_________
				while ($line = $comments->fetch_assoc()){
					if ($line['post_id'] == $row_1['id'] ){
						if ($i < 2){
							$comor= $connect->query("SELECT * FROM users WHERE id = '".$line['author_id']."' ");
							$com = $comor->fetch_assoc();
							$avatar = '<a href="/id'.$line['author_id'].'"><img style="width: 40px;margin-top: 8px;" src="'.$com['avatar'].'" id="post_av" alt=""></a>';
							$part = '<div class="row" style="padding-top : 15px;">
											<div class="col-sm-1"></div>
											<div class="col-sm-10">
											
												'.$avatar.'
												<h5 id="PName" style ="padding-left: 40px;padding-top: 0px;">'.$com['name'].'</h5>
												<h5 id="Ptime" style ="padding-left: 40px;padding-top: 0px;">'.$line['com_date'].'</h5>
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
				}//комментарии 
				while ($like = $data->fetch_assoc()){
					if ($like['post']==$row_1['id']) {
					if ($like['author_id']==$_SESSION['id']) {
						$like_icon = '<h5 id="like_label">Нравится<img src="/img/like_icon2.png" onclick="like('.$row_1['id'].',1);" class="like"></h5>';
						}
						$likes ++;
					}
				}//лайки
				echo ' 
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-8 post">
								<div class="cointainer-fluid">
									<div class="row">
										<div class="col-sm-9" style="display: inline-block;"> 
											'.$ava2.'
											<h5 id="PName'.$style.'">'.$name.'</h5>
											<h5 id="Ptime'.$style.'">'.$date.'</h5>
										</div>
										
										<div class="col-sm-3">
										<h5 id="likes" class="likes_'.$row_1['id'].'">'.$likes.'</h5>
										'.$like_icon.'
											
										</div>
									</div>
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-10"><h4>'.$text.'</h4></div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row">
										'.$ava.'
											<img src="'.$img.'" id="post_bg" class="postimg">
											
										
									</div>

									<div class="row">
										<div class="col-sm-6">
											<img src="/img/comment_icon.png" id="comment_icon">
											<h5 id="comment">'.$commen.'</h5>
											<h5 id="comment_label" onclick="AddCom('.$row_1['id'].',2);">+Комментий</h5>
										</div>
										<div class="col-sm-6"></div>
									</div>
									<hr style = "background-color: #f3f3f3;color: #f3f3f3; height : 5px; width :100%; padding-left:40px;margin-left:-20px;">
									<span id="PostId_'.$row_1['id'].'" >'.$comment.'</span>
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>';
				$last = $row_1['id'] ;
			}
		}

		if ($row_2['id2'] == $_SESSION['id'] && $row_1['id'] < $last ){
			if($row_2['id1'] == $row_1['author_id']){

				$res= $connect->query("SELECT * FROM users WHERE id = '".$row_1['author_id']."' ");
				$data = $res->fetch_assoc();

				$img_query = $connect->query("SELECT * FROM img WHERE id = '".$row_1['post_img']."' ");
				$img_info = $img_query->fetch_assoc();



				$likes = 0;
				$name = 	$data['name'];
				$date = 	$row_1['post_time'];
				$commen = 0;
				$text =		$row_1['post_text'];
				$img = 		$img_info['link'];
				$ava = 		'<a href="/id'.$row_1['author_id'].'"><img src="'.$data['avatar'].'" id="post_av" ></a>';
				$ava2 = 	'';
				$style = 	'';
				$comment =	'';
				$like_icon= '<h5 id="like_label" class="lll'.$row_1['id'].'">Нравится<img src="/img/like_icon1.png" onclick="like('.$row_1['id'].',0);" class="like"></h5>';


				if ($text !=''){$ava = '';$ava2 = '<a href="/id'.$row_1['author_id'].'"><img src="'.$data['avatar'].'" id="post_av2"></a>';$style = 2;}
				
				$comments= $connect->query("SELECT * FROM comments ORDER BY id DESC");
				$data= $connect->query("SELECT * FROM likes");
//___________coments 2_________
				while ($line = $comments->fetch_assoc()){
					if ($line['post_id'] == $row_1['id'] ){
						if ($i < 2){
							$comor= $connect->query("SELECT * FROM users WHERE id = '".$line['author_id']."' ");
							$com = $comor->fetch_assoc();
							$avatar = '<a href="/id'.$line['author_id'].'"><img style="width: 40px;margin-top: 8px;" src="'.$com['avatar'].'" id="post_av" alt=""></a>';
							$part = '<div class="row" style="padding-top : 15px;">
											<div class="col-sm-1"></div>
											<div class="col-sm-10">
											
												'.$avatar.'
												<h5 id="PName" style ="padding-left: 40px;padding-top: 0px;">'.$com['name'].'</h5>
												<h5 id="Ptime" style ="padding-left: 40px;padding-top: 0px;">'.$line['com_date'].'</h5>
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
				}//комментарии 
				while ($like = $data->fetch_assoc()){
					if ($like['post']==$row_1['id']) {
					if ($like['author_id']==$_SESSION['id']) {
						$like_icon = '<h5 id="like_label">Нравится<img src="/img/like_icon2.png" onclick="like('.$row_1['id'].',1);" class="like"></h5>';
						}
						$likes ++;
					}
				}//лайки
				echo ' 
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-8 post">
								<div class="cointainer-fluid">
									<div class="row">
										<div class="col-sm-9" style="display: inline-block;"> 
											'.$ava2.'
											<h5 id="PName'.$style.'">'.$name.'</h5>
											<h5 id="Ptime'.$style.'">'.$date.'</h5>
										</div>
										
										<div class="col-sm-3">
										<h5 id="likes" class="likes_'.$row_1['id'].'">'.$likes.'</h5>
										'.$like_icon.'
											
										</div>
									</div>
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-10"><h4>'.$text.'</h4></div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row">
										'.$ava.'
											<img src="'.$img.'" id="post_bg" class="postimg">
											
										
									</div>

									<div class="row">
										<div class="col-sm-6">
											<img src="/img/comment_icon.png" id="comment_icon">
											<h5 id="comment">'.$commen.'</h5>
											<h5 id="comment_label" onclick="AddCom('.$row_1['id'].',2);">+Комментий</h5>
										</div>
										<div class="col-sm-6"></div>
									</div>
									<hr style = "background-color: #f3f3f3;color: #f3f3f3; height : 5px; width :100%; padding-left:40px;margin-left:-20px;">
									<span id="PostId_'.$row_1['id'].'" >'.$comment.'</span>								
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>';
				$last = $row_1['id'];
				$n=$n-1;
			}
		}
	}
	$i= 0;
	$b= 1;
}












/*


	while ($row = $result->fetch_assoc()){

		if ($row['id1'] == $_SESSION['id']) {
			echo "1";
			$res= $connect->query("SELECT * FROM post ORDER BY id DESC");
			
			while ($rows = $res->fetch_assoc()){
				
				if ($rows['author_id'] == $row['id2']/* && $rows['id'] < $last*//*){
					echo "2";
					$res= $connect->query("SELECT * FROM users WHERE id = '".$rows['author_id']."' ");
					$data = $res->fetch_assoc();
					$array = unserialize( $rows['post_img']);
					
					$name = 	$data['name'];
					$date = 	$rows['post_time'];
					$likes = 	$rows['post_likes'];
					$comments = $rows['post_comments'];
					$text =		$rows['post_text'];
					$img = 		$array['0'];
					$ava = 		'<img src="'.$data['avatar'].'" id="post_av" >';
				  	$ava2 = 	'';
				  	$style = '';
					if ($text !=''){
						$ava = ''; 
						$ava2 = '<img src="'.$data['avatar'].'" id="post_av2">';
						$style = 2;
						
					
					}
					
					echo ' 
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-8 post">
								<div class="cointainer-fluid">
									<div class="row">
										<div class="col-sm-4" style="display: inline-block;"> 
											'.$ava2.'
											<h5 id="PName'.$style.'">'.$name.'</h5>
											<h5 id="Ptime'.$style.'">'.$date.'</h5>
										</div>
										<div class="col-sm-5"></div>
										<div class="col-sm-3">
											<h5 id="likes">'.$likes.'</h5>
											<h5 id="like_label">Нравится<img src="/img/like_icon.png" id="like"></h5>
											
										</div>
									</div>
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-10"><h4>'.$text.'</h4></div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row">
										<div class="col-sm-12">'.$ava.'
											<img src="'.$img.'" id="post_bg" class="postimg">
											
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<img src="/img/comment_icon.png" id="comment_icon">
											<h5 id="comment">'.$comments.'</h5>
											<h5 id="comment_label">Комментариев</h5>
										</div>
										<div class="col-sm-6"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>';
					$last = $rows['id'];
				}

			}

		}else if ($row['id2'] == $_SESSION['id']) {
			$res= $connect->query("SELECT * FROM post ORDER BY id DESC");
			echo "1";
			while ($rows = $res->fetch_assoc()){
				
				if ($rows['author_id'] == $row['id1'] /*&& $rows['id'] < $last*//*){
					echo "2";
					$res= $connect->query("SELECT * FROM users WHERE id = '".$rows['author_id']."' ");
					$data = $res->fetch_assoc();
					$array = unserialize( $rows['post_img']);

					$name = 	$data['name'];
					$date = 	$rows['post_time'];
					$likes = 	$rows['post_likes'];
					$comments = $rows['post_comments'];
					$text =		$rows['post_text'];
					$img = 		$array['0'];
					$ava = 		'<img src="/img/avatar.jpg" id="post_av" >';
				  	$ava2 = 	'';
				  	$style = '';
					if ($text !=''){
						$ava = ''; 
						$ava2 = '<img src="/img/avatar.jpg" id="post_av2">';
						$style = 2;
						
					}
					
					echo ' 
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-8 post">
								<div class="cointainer-fluid">
									<div class="row">
										<div class="col-sm-4" style="display: inline-block;"> 
											'.$ava2.'
											<h5 id="PName'.$style.'">'.$name.'</h5>
											<h5 id="Ptime'.$style.'">'.$date.'</h5>
										</div>
										<div class="col-sm-5"></div>
										<div class="col-sm-3">
											<h5 id="likes">'.$likes.'</h5>
											<h5 id="like_label">Нравится<img src="/img/like_icon.png" id="like"></h5>
											
										</div>
									</div>
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-10"><h4>'.$text.'</h4></div>
										<div class="col-sm-1"></div>
									</div>
									<div class="row">
										<div class="col-sm-12">'.$ava.'
											<img src="'.$img.'" id="post_bg" class="postimg">
											
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<img src="/img/comment_icon.png" id="comment_icon">
											<h5 id="comment">'.$comments.'</h5>
											<h5 id="comment_label">Комментариев</h5>
										</div>
										<div class="col-sm-6"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>';
					$last = $rows['id'];
				}
			}		
			$k=$k+1;
		}
		
	}
*/
$_SESSION['last_note'] = $last; 


	
 ?>








