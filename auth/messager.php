<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();



 ?>	



	
	<link href="css/messanger.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<style>
		@font-face{
		  font-family: "bold";
		  src: url('/fonts/bold.ttf');

		}

		@font-face{
		  font-family: "reg";
		  src: url('/fonts/regular.ttf');

		}
		h5.replica{
			font-family: "reg";
			color: red;
			padding: 0;
			margin: 0;
		}

	</style>
	<script>
var friend_id = <?php if ( $_SESSION['id2'] != '') {echo $_SESSION['id2'];}else echo 0; ?>;
var last_id = 0;

function myWindow5() {
  var childWindow = document.getElementById('message_list').contentWindow;
  var height  = $('iframe#message_list').contents().height();
  childWindow.scrollTo(0, height);
}


		$( document ).ready(function() {
			$('iframe#friend_list').load(function() {
				$("#message_input").keyup(function(event) {
					/*___________enter_btn____________*/

					if(event.keyCode==13) {
						var text = $("#message_input").val();
						$('#message_input').val('');
						if (text != '') {
							$.ajax({
					    		url : "/messanger/add_message.php",
					    		type: "POST",
					    		dataType: "html",
						   		data:({text : text})
					  		})
					  		.done(function(html){
					  			$('iframe#message_list').contents().find('div.content').append(html);
					  		
					  			if (html != '') {
						  			var childWindow = document.getElementById('message_list').contentWindow;
									var height  = $('iframe#message_list').contents().height();
									childWindow.scrollTo(0, height);
				  				}
					  		});	
							}else {alert('сообщение не набрано');}
		 
						}});//отправка по enter  

				  	/*__________send_button___________*/

					$('#send_button').click(function(){
						var text = $("#message_input").val();
						$('#message_input').val('');
						if (text != '') {
						$.ajax({
				    		url : "/messanger/add_message.php",
				    		type: "POST",
				    		dataType: "html",
					   		data:({text : text})
				  		})
				  		.done(function(html){
				  			$('iframe#message_list').contents().find('div.content').append(html);
				  			if (html != '') {
					  			var childWindow = document.getElementById('message_list').contentWindow;
								var height  = $('iframe#message_list').contents().height();
								childWindow.scrollTo(0, height);
				  			}
				  		});	
						}else {alert('сообщение не набрано');}});

					/*__________rememberimg___________*/

					if (friend_id != 0) {
						$.ajax({
				    		url : "/messanger/load.php",
				    		type: "POST",
				    		dataType: "html",
					   		data:({id2 : friend_id })
				  		})
				  		.done(function(html){
				  			$('iframe#friend_list').contents().find('div#mate'+friend_id).addClass( "selected" );
				  			$('iframe#message_list').contents().find('div.content').empty().append(html);
				  			last_id = friend_id;

				  			var childWindow = document.getElementById('message_list').contentWindow;
							var height  = $('iframe#message_list').contents().height();
							childWindow.scrollTo(0, height);
				  		});} //отправка открыте диалога после f5 
				  	/*___________selection____________*/	

					$('iframe#friend_list').contents().find('div.friend_bar').click(function(){
						full_id=$(this).attr('id');
						var id = full_id.substring(4);
						if (last_id != id) {
						
						$('iframe#friend_list').contents().find('div#mate'+last_id).removeClass( "selected" );
						$('iframe#friend_list').contents().find('div#mate'+id).addClass( "selected" );
						last_id = id ;
						}else $('iframe#friend_list').contents().find('div#mate'+id).addClass( "selected" );
						$.ajax({
				    		url : "/messanger/load.php",
				    		type: "POST",
				    		dataType: "html",
					   		data:({id2 : id })
				  		})
				  		.done(function(html){
				  			$('iframe#message_list').contents().find('div.content').empty().append(html);

							var childWindow = document.getElementById('message_list').contentWindow;
							var height  = $('iframe#message_list').contents().height();
							childWindow.scrollTo(0, height);
				  		});});

					/*___________updating_____________*/

					setInterval(function() {
						$.ajax({
				    		url : "/messanger/update.php",
				    		type: "POST",
				    		dataType: "html",
					   		data:({id2 : window.id })
				  		})
				  		.done(function(html){
				  			$('iframe#message_list').contents().find('div.content').append(html);

				  			if (html.indexOf('<') != -1) {
					  			var childWindow = document.getElementById('message_list').contentWindow;
								var height  = $('iframe#message_list').contents().height();
								childWindow.scrollTo(0, height);
				  			}
				  		});}, 300);

					/*____________num_bar_____________*/

					/*
					last_html = 0;
					setInterval(function() {
						$.ajax({
				    		url : "/messanger/friends_display.php",
				    		type: "POST",
				    		dataType: "html"
				  		})
				  		.done(function(html){
				  			if(last_html != html){
				  				alert(html);
				  				$('iframe#friend_list').contents().find('span.body').html(html);
				  				last_html = html;
				  				$('iframe#friend_list').contents().find('div#mate'+las).addClass( "selected" );
				  			}
				  		});
					}, 1000);*/

					setInterval(function() {
						$.ajax({
				    		url : "/messanger/num_bar.php",
				    		type: "POST",
				    		dataType: "html"
				  		})
				  		.done(function(html){
				  			i=0;
				  			while (html[i] != '.'){
				  			j = html.indexOf('-',i);
				  			id = html.substring(i,j);
				  			n = html.substring(j+1,html.indexOf(',',j));
				  			//alert(id);
				  			//alert(n);

				  				//alert(html[i]);
				  				//alert(html[i+2]);
				  				if (n != 0) {
$('iframe#friend_list').contents().find('div#mate'+id).find('h5#grey_txt').append('<span class="new_message" style="background-color: #f84848;">'+n+'</span>');//48337f
				  				}else if (n == 0){
$('iframe#friend_list').contents().find('div#mate'+id).find('span.new_message').remove();
				  				}
				  				i=html.indexOf(',',j)+1;
				  			}
				  		});}, 2000);
			});
		});

	</script>



<section id="dialogs" style="padding-left: 220px;">
	<div id="frame">
		<input type="text" id="friend_serch" style="border :0; outline: none;background-image: url(../img/search_icon.png);background-repeat: no-repeat;background-position: 5px; border-bottom: 1px solid #bdbdbc; padding-right:20px;padding-top: 5px;padding-bottom: 5px;margin-left: 15px;margin-right: 15px;margin-top:15px;">
		<span id="friends">
			<iframe id="friend_list" src="/messanger/friends_display.php" width="200" height="500" align="left" style="border: 0;margin-top:15px;"></iframe>
		</span>
	</div>
</section>

<section style="padding-left: 220px;padding-bottom: 15px;">
	<div id="disp">
		<div class="container">
			<div class="row"  >
				<div class="col-sm-3"></div>
				<div class="col-sm-6" id="display"><h3 id="grey_txt" class="interlocutor" onclick="myWindow5();">Semen Kuznetsov</h3><hr id="hr">
					<iframe id="message_list" src="/messanger/message_display.php" width="565" height="601" align="left" style="border:0;"></iframe>
				</div>

			</div>
			<div class="row">
				<div class="col-sm-3"></div>
					<div class="col-sm-6" id="input_div">
						<img src="/img/lett_smile.png" alt="">
						<textarea rows="1" cols="73" id="message_input" name="my_news" placeholder="Напишите сообщение"></textarea>
						<img src="/img/lett_clip.png" alt="">
						<img src="/img/lett_sent.png" id="send_button">
					</div>
			</div>
		</div>
	</div>
</section>




        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>



