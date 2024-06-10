<?php
session_start();
session_unset();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
if(!isset($_GET['idgame'])){
  header("Location: index.php");
  exit();
}
else{
  $_SESSION['idgame'] = $_GET['idgame'];
}
try{
  require_once("connectionData.php");
  $idgame = $_SESSION['idgame'];
  $stmt = $conn->prepare("SELECT COUNT(idgame) as total FROM player WHERE idgame = :idgame");
  $stmt->bindParam(':idgame', $idgame);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $Count = $result['total'];
  if($Count > 3){
    header("Location: noGAME.php");
    exit();
  }
  else{
    $Count += 1;
    $_SESSION['id'] = $Count;
    $stmt = $conn->prepare("INSERT INTO player (idgame, isprotegon , isend, id) VALUES ($idgame, 0, NULL, $Count)");
    $stmt->execute();
  }
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
    <title>PROTEGON</title>
    <link rel="icon" href="PROTEGON/Logo no bg.png" type="image/png">
</head>
<body>
  <div class="container">
   <h1><font>You have been added to the game.</font><br> <hr><img style="width: 40%;" src="PROTEGON/WAIT GIF.gif" alt=""></h1>
   <p>Please kindly await the arrival of other participants to the game.
     Your patience is appreciated as we wait for additional players to join</p>
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
    window.location.href = "./waitRoundType.php"; 
  }
}
let l = setInterval(function(){
  xhr.open('GET',"phpToAsk/gameStart.php",true);
  xhr.send();
},3000)
</script>