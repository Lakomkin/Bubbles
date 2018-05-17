<?php 

$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');


session_start();


$id = $_SESSION['id'];
$res= $connect->query("SELECT * FROM users WHERE id = '".$id."' ");
$user = $res->fetch_assoc();
$avatar = $user['avatar'];
// Путь загрузки
$path = 'user_files/';

// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_POST['text'] != '')
{
  if ($_FILES['photo']['name']!='') {$link = $path.$_FILES['photo']['name'];}

 // Загрузка файла и вывод сообщения
 if (@copy($_FILES['photo']['tmp_name'], $path . $_FILES['photo']['name'])){
    $array = array( $link );
    $img = serialize( $array );


  }
    $text = $_POST['text'];
    $connect->query("INSERT INTO post
    VALUES ('','".$id."','".$_SESSION['id']."','".$text."','','".$img."','1','','13','123')");
    $_POST = NULL;
    header("Location: /frame" );
    exit();
}


 ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>events</title>

    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/frame.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">

    var page = <?php if ($_SESSION['page']=="") echo 2; else echo $_SESSION['page'];?>;
    jQuery(document).ready(function() {

      if (document.location.href.substring(25,27)=="id")    {page = 1 ;}
      if (document.location.href.substring(25)=="feed")     {page = 2 ;}
      if (document.location.href.substring(25)=="dialogs")  {page = 3 ;}
      if (document.location.href.substring(25)=="groups")   {page = 4 ;}
      if (document.location.href.substring(25)=="friend_list"){page = 5 ;}
      if (document.location.href.substring(25)=="map")      {page = 6 ;}
      if (document.location.href.substring(25,28)=="gr_")   {page = 7 ;}
      if (document.location.href.substring(25)=="music")    {page = 8 ;}

      if (page!=0){
        if (page==1) {$( ".content" ).load( "/person" );    history.pushState(null, null, '/id'+document.location.href.substring(27));}
        if (page==2) {$( ".content" ).load( "/fed" );       history.pushState(null, null, '/feed');}
        if (page==3) {$( ".content" ).load( "/messager" );  history.pushState(null, null, '/dialogs');}
        if (page==4) {$( ".content" ).load( "/grps" );      history.pushState(null, null, '/groups');}
        if (page==5) {$( ".content" ).load( "/mates" );     history.pushState(null, null, '/friend_list');}
        if (page==6) {$( ".content" ).load( "/mp" );        history.pushState(null, null, '/map');}
        if (page==7) {$( ".content" ).load( "/grp" );       history.pushState(null, null, '/gr_'+document.location.href.substring(28));}
        if (page==8) {$( ".content" ).load( "/player" );    history.pushState(null, null, '/music');}
      }else alert('erorr');
    $( "#comment_label" ).click(function() {
      alert(1);
    });


    });


    function OpenPage(page){

          if (page == 1) {link ='/person';      num =1; page = 'id'+<?php echo $_SESSION['id'] ?>}
          if (page == 2) {link ='/fed';         num =2; page = 'feed'}
          if (page == 3) {link ='/messager';    num =3; page = 'dialogs'}
          if (page == 4) {link ='/grps';        num =4; page = 'groups'}
          if (page == 5) {link ='/mates';       num =5; page = 'friend_list'}
          if (page == 6) {link ='/mp';          num =6; page = 'map'}
          if (page == 8) {link ='/player';      num =8; page = 'music'}
          history.pushState(null, null, '/'+page);
          $( ".content" ).load( link );
          // <//?php echo $_SESSION['id'] ;?>
          $.ajax({
            url : "IniPage.php",
            type: "GET" ,
            data : ({page : num}) 
          });
    }

    function AddCom(post,from){
      html = 
      '<span id="com_block"><textarea name="comment" cols="50" id="com" rows="2"></textarea><input type="submit" onclick="Ini_comment('+post+');"></span>'

      if (from == 1){$("#PostId_"+post).prepend(html);}else 
      if (from == 2){$("#PostId_"+post).prepend(html);}}

    function Ini_comment(post){
      var text= $('#com').val();
      $.ajax({
        url : "IniCom.php",
        type: "POST" ,
        data : ({post_id : post, text : text}) 
      }).done(function(html){
        $("#com_block").detach();
        $("#PostId_"+post).prepend(html);
      });  }

    function like(post,liked){
      var author = <?php echo $_SESSION['id']; ?>;
      if(liked != 1){
        $.ajax({
          url : "IniLike.php",
          type: "POST" ,
          dataType: "html",
          data : ({post : post,author: author}) 
        }).done(function(html){
          $(".likes_"+post).html(html);
          $(".lll"+post).html('Нравится<img src="/img/like_icon2.png" onclick="like('+post+',1);" id="like">');
        });
      }else alert(1);
    }
    function Open_Details(post_id){
      $('div#details_body').empty();

      $.ajax({
        url : "/page/details_builder.php",
        type: "POST",
        dataType: "html",
        data:({post_id : post_id})
      })
      .done(function(html){
        $("div#details_body").append(html);
      });
    }


  
    </script>
    <style>

      .page{
        display: none;
      }
      .page.active {
        display: block;
      }
    </style>
  </head>
  <body style="background-color: #f3f3f3;">
 
    <header>

      <div class="container-fluid fixed">
      <span id="bar_bg"></span>
        <div class="row ">
          <div class="col-sm-3 menu_bg bar1">
            <h3 id="view_1"><img src="/img/pointer_icon.png" id="pointer" alt="">Bubbles</h3><hr>
          <a onclick="OpenPage(1);"><h4 id="view_3"><img src="/img/page_icon.png    " alt=""><span class="menu">Моя Страница  </span></h4></a><hr>
          <a onclick="OpenPage(2);"><h4 id="view_3"><img src="/img/feed_icon.png    " alt=""><span class="menu">Лента         </span></h4></a><hr>
          <a onclick="OpenPage(8);"><h4 id="view_3"><img src="/img/music_note.png   " alt=""><span class="menu">Музыка        </span></h4></a><hr>
          <a onclick="OpenPage(3);"><h4 id="view_3"><img src="/img/dialogs_icon.png " alt=""><span class="menu">Диалоги       </span></h4></a><hr>
          <a onclick="OpenPage(4);"><h4 id="view_3"><img src="/img/groups_icon.png  " alt=""><span class="menu">Группы        </span></h4></a><hr>
          <a onclick="OpenPage(5);"><h4 id="view_3"><img src="/img/friends_icon.png " alt=""><span class="menu">Друзья        </span></h4></a><hr>
          <a onclick="OpenPage(6);"><h4 id="view_3"><img src="/img/map_icon.png     " alt=""><span class="menu">Карта         </span></h4></a><hr>
          </div>
          <span class="bar2">
          <span class="col-sm-2"></span>
          <div class="col-sm-2">
          <input type="text" id="search"></div>
          <div class="col-sm-4 centerr">
            <h4 style="display: inline-block;" id="view_2">События</h4>
            <h4 style="display: inline-block;" id="view_2">+Фотографию</h4>
            <h4 style="display: inline-block;" id="view_2"><a data-toggle="modal" data-target="#add_post">+Запись</a></h4>
          </div>
          
          <div class="col-sm-4" >
          <span id="info">
              <img src="/img/bell_icon.png" id="bell" alt="">
              <img style="display: inline-block;" id="message" src="/img/message_icon.png" alt="">
              <h4 id="name"><?php echo $user['name']; ?></h4>
              <img src="<?php echo $avatar; ?>" id="ava" alt="">
              <img src="/img/settings_icon.png" id="set" alt=""></span>
          </div>
          </span>
        </div>
      </div>
      
      <div class="container-fluid">
        <div class="row">

          <div class="col-sm-2" style="width: 220px;"></div>
           <div class="col-sm-10 content"></div>
          
        </div>
      </div>
      
    </header>
    <!--_________modals_________-->
    <div class="modal fade" id="add_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title center-block" id="myModal
              Label">Добавление записи </h4>
            </div>
            <div class="modal-body">
              <form method="post"  enctype="multipart/form-data">
                <textarea rows="2" cols="45" name="text" ></textarea>
                <input type="file" name="photo" multiple accept="image/*,image/jpeg">
                <input type="submit" value="sent">
              </form>
          </div>
        </div>
      </div>
    </div> 
    <!--_________modals_________-->
      <div class="modal fade bs-example-modal-lg" id="details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg" >
          <div class="modal-content" id="details_body" style="padding: 0;margin: 0;"  style="border-radius: 5px 5px 0px 0px;">
            ...
          </div>
        </div>
      </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>