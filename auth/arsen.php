

<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>


<script>
function pass(card) {
         alert(2);
         if($("input.window1").val() == 'f'){alert(1);}
}
</script>

<style>
a.card_btn:hover{
	background-color: #0c67d0;
}
div.card{
	text-transform: none;
	font-family: 'Montserrat', sans-serif;	
	background-color: #e4eaf0;
	border: 1px solid #e4eaf0;
	border-radius: 6px;
}	
h1.card_h1{	
	color: #212529;
	font-size: 32pt;
	padding-top: 40px;
	padding-left: 30px;
}
h5.card_h5{
	font-size: 13pt;
	color: #000;
	padding-left: 30px;		
}
h4.card_h4{
	font-size: 15pt;
	margin-top: -10px;
	color: #212529;
	padding-left: 30px;
}
h3.card_h3{
	padding-left: 30px;
}
hr.card_hr{
	margin-right: 30px;
	color: #ff002a;
}
a.card_btn{
	margin-bottom: 70px;
	display: block;
	width: 120px;
	padding-top: 10px;
	padding-bottom: 10px;
	padding-left: 15px;
	padding-right: 15px;
	color: #fff;
	border: 1px solid #127af4;
	border-radius: 6px;
	background-color: #127af4;
    transition: 1s;
}
</style>
<input type="text" class="window1">
<div class="card">
  <h1 class="card_h1">Hello, world!</h1>
  <h4 class="card_h4">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="card_hr" noshade color="#cbd1d7" align="center">

  <h5 class="card_h5">It uses utility classes for typography and spacing to space content out within the larger container.</h5>
  <h3 class="card_h3">
    <a class="card_btn" onclick="pass();">Learn more</a>
  </p>
</div>