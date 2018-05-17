
<?php
$connect = new mysqli('localhost','046676100_22','2091golf','j691714_events');



if(isset($_POST['name'])){
  $result=$connect->query("SELECT * FROM users WHERE login='".$_POST['login']."'");
  $row=$result->fetch_assoc();

    if(""!=$_POST['name']){
      if(""!=$_POST['login']){
        if(""!=$_POST['password']){
          if(""!=$_POST['repass']){
              if ($row['login'] != $_POST['login']) {
                  $result=$connect->query("SELECT * FROM users WHERE login='".$_POST['password']."'");
                  $row=$result->fetch_assoc();
                if ($row['password'] != $_POST['password']) {
                  if ($_POST['repass'] == $_POST['password']) {
                    $connect->query("INSERT INTO users  
                      VALUES ('','".$_POST['name']."','1','".$_POST['login']."','".$_POST['password']."')");

                    session_start();

                    $row = $connect->query("SELECT * FROM users WHERE login = '".$_POST['login']."' ");
                    $row = $row->fetch_assoc();

                    $_SESSION['auth']='true';
                    $_SESSION['id']=$row['id'];
                    $_SESSION['name']=$row['name'];
                    $_SESSION['coin']=$row['coin'];
                    header( 'Location: /main');
                    
                    
                }else echo "8 <br>";
              }else echo "7 <br>";
            }else echo "6 <br>";
          }else echo "5 ".$_POST['repass']."<br> ";
        }else echo "4 ".$_POST['password']."<br> ";
      }else echo "3 ".$_POST['login']."<br> ";
    }else echo "2 ".$_POST['name']."<br> ";
  }



 ?>

<form action="/guest/reg.php" method="POST">
  <h3>имя</h3>
  <input type="text" name="name"><br>
  <h3>логин</h3>
  <input type="text" name="login"><br>
  <h3>пароль</h3>
  <input type="password" name="password" ><br>
  <h3>подтверждение</h3>
  <input type="password" name="repass" ><br>
  <input type="submit" >
</form>