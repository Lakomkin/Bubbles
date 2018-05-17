<?php 

$_SESSION['auth']=false; 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');

if (isset($_POST['login'])) {

  $login=$connect->query("SELECT login FROM users WHERE login = '".$_POST['login']."'" );
  $login=$login->fetch_assoc();

  if (isset($login['login'])) {
    $password=$connect->query("SELECT password FROM users WHERE password = '".$_POST['password']."'" );
    $password=$password->fetch_assoc();

    if ($password['password'] == $_POST['password'] ) {
      $props=$connect->query("SELECT * FROM users WHERE login = '".$login['login']."'" );
      $props=$props->fetch_assoc();
      session_start();
      $_SESSION['auth']='true';
      $_SESSION['id']=$props['id'];
      $_SESSION['name']=$props['name'];
      $_SESSION['coin']=$props['coin'];
      echo $props['name'];
      header( 'Location: /main');

    }
  }
}

 ?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Events</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.coms/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

      @font-face{
        font-family: "bold";
        src: url(../fonts/bold.ttf);

      }



      .sidebar {
        background-color: #fff;
        z-index: 2;
        position: fixed;
        left: -75%;
        width: 75%;
        height: 100%;
        -webkit-transition: left 0.2s ease-out 0.5s;
        -moz-transition: left 0.2s ease-out 0.5s;
        -o-transition: left 0.2s ease-out 0.5s;
        transition: left 0.2s ease-out 0.5s;
      }
      .sidebar.active {
        left: 0;
      }
      .content { 
        width: 100%;
        margin-left: 0;
      }



      a {
        text-decoration: none;
      }
      a :hover{
        text-decoration: none;
      }
      .font{
        font-family: "bold";
        color: #fff;
        font-size: 20pt;
        text-decoration: none;
      }
      .font:hover{
        text-decoration: none;
      }
      #map {
        height: 740px;
        width: 100%;
        z-index: 1;
      }
      .bar {
        display: inline-block;
        z-index: 2;
        margin-top: 0;
        position: fixed ;
          
      }
      
      #leftbar{
        left: 0;
      }
      #centerbar{
        margin-top: 7px;
        margin-left: 36%;
      }
      #rightbar{
        margin-right: -1px;
        right: 0;
        
      }
      #search{
        height: 30px;
        width: 217%;
      }
      .hub_layer1{
        z-index: 1;
      }

      /*------------------------------------*/
      .hub_layer2{
        z-index: 2;
      }
      #menu{
        position: absolute;
        padding-top: 10px;
        margin-left: 10px;
      }
      #logo{
        padding-top: 5px;
        margin-left: 100px;
        
      }
      #pointer{
        margin-top: -12px;
      }
      #Events{
        margin-left: 5px;
      }
      #bell{
        padding-top: 8px;
        right: 0;
        margin-right: 195px;
      }
      #name{
        padding-top: 10px;
        margin-right: 100px;
        right: 0;
      }
      #ava{
        padding-top: 4px;
        margin-right: 35px;
        right: 0;
      }
      img.icon-menu{
        
      }
      .name{
        font-size: 14pt
      }
      ul.dropdown-menu{
        padding-right: 100px;
        width: 300px;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">
    </script>

    <script>
      $(document).ready(function() {
        $(".icon-menu").bind("click",function() {
          $('.sidebar').toggleClass('active');
        });
      });
    
    </script>

  </head>
  <body>

    <div class="hub_layer1">
      <div class="bar" id="leftbar"><img src="img/leftbar.png" alt=""></div>
      <div class="bar center-block" id="centerbar"><input type="text" id="search"></div>
      <div class="bar" id="rightbar"><img src="img/rightbar.png" alt=""></div>
      
    </div>

    <div class="hub_layer2">
      <div class="bar" id="menu" ><a class="icon-menu"><img src="img/fafabar.png" alt=""></a></div>
      <div class="bar" id="logo"><a href="" style="text-decoration: none;">
      <img src="img/logo.png" alt="" id="pointer"><span  class="font" id="Events">Events</span></a></div>
      <div class="bar" id="name"><a data-toggle="modal" data-target="#ent"><span class="font name " >Войти</span></a>
      <ul class="dropdown-menu pull-left" aria-labelledby="dLabel"">
        <form action="/" method="POST">
            <li>логин</li>
          
            <li><input type="text" name="login"></li>
          
            <li>пароль</li>
          
            <li><input type="password" name="password"></li>
          
            <li><input type="submit" ></li>
        </form>
      </ul> </div>
      <!--
      <div class="bar" id="bell"><a href=""><img src="img/bell.png" alt=""></a></div>
      <div class="bar" id="name"><span class="font name " >Семен</span></div>
      <div class="bar" id="ava"><a href=""><img  src="img/avatar.png" alt=""></a></div>-->

    </div>

      <div class="sidebar">Авторезуйтесь чтобы получить больше информации</div>
      <div id="map" class="content"></div>


   
    <script>


    $(document).ready(function(){
          
          function showModal() {
              $("#reg").modal('show');
            }

          //setTimeout(showModal, 120000);
          //setTimeout(showModal, 60000);

        });
      

      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru,
          disableDefaultUI: true
        });


          map.addListener('click', function(e) {
            addMarcker(e.latLng, map);
          });


        <?php 


              $result=$connect->query("SELECT * FROM marckers");
              

              while ($rows = $result->fetch_assoc()){
                $lat=$rows["lat"]+0.001;
                $lng=$rows["lng"]-0.0105;

                echo '
                var marker'.$rows["ID"].' = new google.maps.Marker({
                  position: {lat: '.$rows["lat"].', lng: '.$rows["lng"].'} ,
                  map: map,
                  title: "'.$rows["title"].'",
                  icon: "img/'.$rows["icon"].'"
                  
                });
                
                marker'.$rows["ID"].'.addListener("click", function() {
                  map.setZoom(16);
                  map.panTo({lat: '.$lat.', lng: '.$lng.'});
                  $(".sidebar").toggleClass("active");
                  
                          $.ajax({
                            url : "InInfo.php",
                            type: "POST" , 
                            data : ({
                              id : "'.$rows["ID"].'",
                              title : "'.$rows["title"].'",
                              info : "'.$rows["info"].'",
                              address : "'.$rows["address"].'",
                              phone : "'.$rows["phone"].'"
                             }) ,
                            dataType: "html",
                          });

                      });

                  var tip'.$rows["ID"].'= new google.maps.InfoWindow({
                  content: "'.$rows["title"].'"
                });
                tip'.$rows["ID"].'.open(map, marker'.$rows["ID"].');';
              }
              
            ?>

}




      

    </script>
    <!--_________________________MODALS_______________________-->

    <!--_________________________ENTER_______________________-->

    <div class="modal fade" id="ent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title center-block" id="myModalLabel">autharization</h4>
            </div>
            <div class="modal-body">

            <div class="tabs">
              <ul class="nav nav-tabs">
                <li class="active">  <a href="#tab-1" data-toggle="tab">Вход</a></li>
                <li>                 <a href="#tab-2" data-toggle="tab">Регистрация</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active fade in" id="tab-1">
                  <br><br>
                  <form action="/" method="POST">
                    <input type="text" placeholder="login" name="login"><br><br>
                    <input type="password" placeholder="password" name="password" id="pass"><br><br>
                    <input type="submit" value="enter" id="sub">
                  </form>
                </div>
                <div class="tab-pane fade" id="tab-2"><br><br>Ведутся технические работы</div>
              </div>

            </div>  

          </div>
        </div>
      </div>
    </div> 
    <!--_________________________REGISTRATION_______________________-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" id="reg" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title center-block" id="myModalLabel">reg</h4>
      </div>
      <div class="modal-body">
      <a href="/reg">registration</a>
      </div>
    </div>
  </div>
</div>


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDT8QlwZXO9LoleAcnb5IzFMVDVfmhORa4&callback=initMap">
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>