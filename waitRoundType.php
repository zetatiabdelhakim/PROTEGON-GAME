<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
if(!isset($_SESSION['idgame'])){
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <title>PROTEGON</title>
    <link rel="icon" href="PROTEGON/Logo no bg.png" type="image/png">
</head>
<body>
  <div class="container">
   <h1><font>PROTEGON</font><br> <hr><img style="width: 40%;" src="PROTEGON/WAIT GIF.gif" alt=""></h1>
   <p>Please wait for the PROTEGON to determine the round's type.</p>
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
    window.location.href = "./gameLand.php";
  }
}
let l = setInterval(function(){
  xhr.open('GET',"phpToAsk/choiceWasMade.php",true);
  xhr.send();
},3000)
</script>