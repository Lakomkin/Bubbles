<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>lol</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 

   <script>
     function before (){
        $("#info").text ("waiting");
     }

      function success (data){
        $("#info").text (data);
     }

     $(document).ready (function (){
        $("#load").bind("click", function() {
          var fio = "lol";
            $.ajax({ 
              url :"IniMarcker.php",
              type : "POST",
              data : ({name : (20912.0129 , 2103912), number : 5}),
              dataType : "html",
              beforeSend : before ,
              success: success

            });
        });
     });
   </script>  

  
</head>
<body>
  <div id="load" style=" cursor: pointer;">down</div>
  <div id="info"></div>
</body>
</html>