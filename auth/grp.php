
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="css/groups.css" rel="stylesheet">
<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');



session_start();
$result= $connect->query("SELECT id FROM post ORDER BY id DESC ");
$row = $result->fetch_assoc();
$_SESSION['last_post'] = $row['id'] + 1;

?>


<script type="text/javascript">

jQuery(document).ready(function() {

	id = document.location.href.substring(28);
	

	$.ajax({
		url : "/group/group_builder.php",
		type: "POST",
		dataType: "html",
		data:({id : id})
	})
	.done(function(html){
		$("#group_holder").prepend(html);
	});
			
	$.ajax({
		url : "/group/post_generator.php",
		type: "POST",
		dataType: "html",
		data:({user : id, times : 8})
	})
	.done(function(html){
		$("div.posts").append(html);
	});
	$(window).scroll(function() {
	     if ($(window).scrollTop() > $(document).height() - $(window).height() - 300){
			$.ajax({
				url : "/group/post_generator.php",
				type: "POST",
				dataType: "html",
				data:({user : id, times : 15})
			})
			.done(function(html){
				$("div.posts").append(html);
			});
	     }
	});

});
	
</script>





<div id="group_holder" >


		<div class="container-fluid" >
			<div class="col-sm-1"></div>
			<div class="col-sm-10 posts">
			</div>
			<div class="col-sm-1"></div>
		</div>
	</div>