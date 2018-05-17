<?php 
$result= $connect->query("SELECT * FROM post");
while ($row = $result->fetch_assoc()){
	$last=$row['id'];
}

$_SESSION['last_note'] = $last + 1;
 ?>



    
	<link href="css/page.css" rel="stylesheet">
	<link href="css/feed.css" rel="stylesheet">

	<section style="margin-left: 220px;">
		<div class="stories" style="background-color: #fff;width: 85px;margin-left: 10px; margin-top: 30px; position: absolute;">
			<img src="/user_files/avatar.jpg" style="width: 50px; border-radius: 50px;margin-left: 17px;margin-top: 7px;">
			<h5 id="inputtext" style="padding-left: 20px;">Semen</h5>
		<img src="/user_files/avatar.jpg" style="width: 50px; border-radius: 50px;margin-left: 17px;margin-top: 7px;">
			<h5 id="inputtext" style="padding-left: 20px;">Semen</h5></div>
			<div class="container">
				<div class="row" style="padding-top: 85px;padding-left: 10px;">
					<div class="col-sm-1" style="margin-left: 115px ;background-color: #fff;height: 50px;margin-top: -55px;width: 125px;">
						<img src="/img/adds_arrow.png" alt="" style="margin-left: -22px;">
						<img src="/img/adds_plus.png" alt="" style="display: inline-block; padding-left:5px;">
						<h5 style="display: inline-block;padding-left: 15px;" id="inputtext">Историю</h5>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-8" id="input_div">
						<img src="/img/lett_smile.png" alt="">
						<textarea rows="1" cols="65" name="my_news" placeholder="Что у вас нового?"></textarea>
						<img src="/img/lett_clip.png" alt="">
						<img src="/img/lett_sent.png" alt="">
					</div>
				</div>
			</div>

		<!--<div class="statistic" style="background-color: #fff;margin-right: 155px; margin-top: -56px; position: fixed;right: 0;">
			<h5>За неделю :</h3>
			<h5 id="inputtext">Мои лайки : 132<img src="/img/like_icon2.png"   		alt="" width="12"></h3>
			<h5 id="inputtext">Мои письма : 12<img src="/img/dialogs_icon.png" 		alt="" width="12"></h3>
			<h5 id="inputtext">Просмотреные посты: 1<img src="/img/feed_icon.png" 	alt="" width="12"></h3>
		</div>-->
		
	</section>
	<section id="posts" style="margin-left: 220px;padding-top: 5px;">
		<div id="feed_notes" class="container-fluid" style="margin-bottom:-200px; ">
		</div></section>

	<script>
	jQuery(document).ready(function() {
		var id = <?php echo $_SESSION['id']; ?>;
		$.ajax({
		   url : "/IniFeed.php",
		   type: "POST",
		   dataType: "html",
		   data:({ user : id , times : 8})
		})
		.done(function(html){
		  $("#feed_notes").append(html);
		});

			
	});
	$(window).scroll(function() {
	     if  ($(window).scrollTop() > $(document).height() - $(window).height() - 300) {
	     	var id = <?php echo $_SESSION['id']; ?>;
			$.ajax({
	    		url : "/IniFeed.php",
	    		type: "POST",
	    		dataType: "html",
		   		data:({user : id , times : 15})
	  		})
	  		.done(function(html){
	  			$("#feed_notes").append(html);
	  		});	 

	     }
	});
	</script>

		
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
