<?php
session_start();
session_unset();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
$link = rand(0,99999999);
$_SESSION['idgame'] = $link;
$_SESSION['id'] = 1;
$_SESSION['isprotegon'] = 1;
try{
  require_once("connectionData.php");
  $stmt = $conn->prepare("INSERT INTO player (idgame, isprotegon , isend, id) VALUES ($link, 1, NULL, 1)");
  $stmt->execute();
  $conn = null;
}catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Create a GAME</title>
    <link rel="icon" href="PROTEGON/Logo no bg.png" type="image/png">
    <style>
        #copy{
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%,-50%);
        }
        #btncopy{
          position: relative;
          width: 5%;
        }
    </style>
</head>
<body>
  <div class="container">
   <h1><font>Create a GAME</font><br> <hr><img style="width: 40%;" src="PROTEGON/WAIT GIF.gif" alt=""></h1>
   <div class="input-group mb-3 d-flex justify-content-center" >
    <input type="text" id="link" class="form-control" value="http://localhost/PROTEGON%20GAME/wait.php?idgame=<?php echo $link; ?>">
    <button class="btn btn-outline-secondary" id="btncopy" onclick="copyInputContent()"><img id="copy" src="img/copy.png" alt=""></button>
    <script>
        function copyInputContent() {
          var link = document.getElementById("link");
          link.select();
          link.setSelectionRange(0, 99999);
          document.execCommand("copy");
        var img = document.getElementById("copy");
        img.src = "img/tick.png";
        setTimeout(()=>(img.src = "img/copy.png"),3000)
        }
      </script>
  </div><br>
   <p>Copy the link and send it to your friends.
     The game will start as soon as the first three people enter the link. Please keep this page open and await their arrival.</p>
  <br>
  </div>
</body>

</html>
<script src="js/Rules.js"></script>



<script>
var xhr = new XMLHttpRequest();
xhr.onload = function(){
  if(this.responseText == '1'){
    clearInterval(l);
    window.location.href = "./Choosetype.php";
  }
}
let l = setInterval(function(){
  xhr.open('GET',"phpToAsk/gameStartProtegon.php",true);
  xhr.send();
},3000)
</script>


