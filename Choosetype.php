<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
if(!isset($_SESSION['idgame']) || !isset($_SESSION['isprotegon'])){
  header("Location: index.php");
  exit();
}
try{
  require_once("connectionData.php");
  require_once("phpToAsk/functions.php");
  insertRound($conn, $_SESSION['idgame'],1);
  $mycards = getMycards($_SESSION['id'], $_SESSION['idgame'],$conn);
  $book = getBook($_SESSION['idgame'],$conn);

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
    <link rel="stylesheet" href="css/choose.css">
</head>
<body>
  <div class="container" id="id">
   <h1><font>PROTEGON</font><br> <hr><img style="width: 30%;" src="PROTEGON/WAIT GIF.gif" alt=""></h1>
   <p>
    Please choose the round type quickly.</p><br>
    <form action="phpToAsk/choiceWasMade.php" method="GET">
   <button id="MIN" type="submit" name="type" value="MIN">MIN</button>
    <button id="MAX" type="submit" name="type" value="MAX">MAX</button>
  </form>
   <br><br>
   <h3><font>MyCards</font><br><hr></h3>
   <?php 
   foreach($mycards as $card){
    echo "<img class='img' src=\"PROTEGON/cards/$card.png\" id=\"c-myCards-$card\" alt=\"\">\n";
   }
   ?>
   <br class="clear-br"><br>
  <h3><font>Book</font><br><hr></h3>
  <?php 
  foreach($book as $b){
    echo "<img class='img' src=\"PROTEGON/cards/$b.png\" id=\"c-book-$b\" alt=\"\">";
  }
  ?>
  <br class="clear-br">
   
  <br>
  </div>
</body>

</html>
<script src="js/Rules.js"></script>