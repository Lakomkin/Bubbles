<?php 
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');

session_start();

if (isset($_POST['title'])){
//$("div.content").remove()
  $title = $_POST['title'];
  $info = $_POST['info'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  
  
  $connect->query("UPDATE marckers SET title = '".$title."' WHERE ID = '".$_SESSION['marcker_id']."'");
  $connect->query("UPDATE marckers SET info = '".$info."' WHERE ID = '".$_SESSION['marcker_id']."'");
  $connect->query("UPDATE marckers SET address = '".$address."' WHERE ID = '".$_SESSION['marcker_id']."'");
  $connect->query("UPDATE marckers SET phone = '".$phone."' WHERE ID = '".$_SESSION['marcker_id']."'");
}
 ?>
 <!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>master</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.coms/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
       #map {
        height: 600px;
        width: 100%;
       }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">
    </script>
    <script>
    jQuery(document).ready(function($) {
      $('.icon-menu').click(function(event) {
        $('.sidebar').toggleClass('active');
      });
    });
    </script>
  </head>
  <body>

    <div class="container map">
      <div class="row">
        <div class="col-md-7"><h3>events</h3></div>
        <div class="col-md-5">    
          <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><h3></h3></a>

         

          <ul class="dropdown-menu" aria-labelledby="dLabel"">
            <form action="/" method="POST">
               <li></li>
          
               <li><input type="text" name="login"></li>
          
               <li>пароль</li>
          
               <li><input type="password" name="password"></li>
          
               <li><input type="submit" ></li>
            </form>
          </ul> 
        </div>

      </div>
    </div>


    
      <div class="sidebar"><div class="information"><?php echo $_SESSION['info']; ?></div></div>
      <div id="map" class="content"></div>
    


    <script>


    
      

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


    function before(){
      $("#info").text ("waiting");
    }

    function success(data){
      $("#info").text (data);
    }

    function addMarcker(coords , map ){
          var marker = new google.maps.Marker({
            position: coords ,
            map: map,
            icon: 'img/lvl1.png', 
          }); 
          //------
          $('head').append('   <style>.sidebar {left: -100%;width: 100%;background-color: #b5b5b5;height: 35%;}.sidebar.active {bottom: 0;}</style>');

          $('.sidebar').append('<form action="/master" method="POST">'+
              '<label for="titile">titile</label><input type="text" name="title">'+
              '<label for="info">info</label><input type="text" name="info"><br>'+
              '<label for="address">address</label><input type="text" name="address">'+
              '<label for="phone">phone</label><input type="text" name="phone">'+
              '<input type="submit">'+
            '</form>');

          $('.sidebar').toggleClass('active');
          //----
            var coordinat = String(coords);

              var from = coordinat.search(',') + 1; 
              var to = coordinat.length-1;
              var lng = coordinat.substring(from,to);
              to = coordinat.search(',');
              var lat = coordinat.substring(1,to);

              //var title =<?php  $title; ?>;
              //var address = <?php  $address; ?>;
              //var phone = <?php  $phone; ?>;
              //var info = <?php  $info; ?>;
            
        $.ajax({
          url : "IniMarcker.php",
          type: "POST" , 
          data : ({lat : lat, lng : lng }),
          dataType: "html",
          beforeSend : before,
          success: success 
        });
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

              <form action="home.php" method="post">
                <input type="text" placeholder="login" name="login"><br><br>
                <input type="password" placeholder="password" name="password" id="pass"><br><br>
                <input type="submit" value="enter" id="sub">
              </form>
              
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