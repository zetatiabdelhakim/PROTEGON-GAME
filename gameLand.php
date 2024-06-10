<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
if(!isset($_SESSION['idgame'])){
  header("Location: index.php");
  exit();
}
try{
  require_once("connectionData.php");
  require_once("phpToAsk/functions.php");
  $mycarts = getMycards($_SESSION['id'], $_SESSION['idgame'] , $conn);
  $table = getTable($_SESSION['idgame'], $conn);
  $book = array();
  $players = players($_SESSION['idgame'], $conn);
  $whoIsProtegon = whoIsProtegon($_SESSION['idgame'], $conn);
  $img = array( 1 => "img/player.png", "img/player.png","img/player.png","img/player.png");
  $img[$whoIsProtegon] = "img/PROTEGON.png";
  $round = selectRound($conn, $_SESSION['idgame']);
  $nbOfExchange = 0;
  if(isset($_SESSION['isprotegon'])){
    $book = getBook($_SESSION['idgame'], $conn);
    if(isset($_SESSION['nbOfExchange'])){
      $nbOfExchange = $_SESSION['nbOfExchange'];
    }
    else{
      $nbOfExchange = nbOfExchange($_SESSION['idgame'], $_SESSION['id'], $conn);
      $_SESSION['nbOfExchange'] = $nbOfExchange;
    }
  }
  $styleBook = "";
  $styleExchange ="";
  if(!isset($_SESSION['isprotegon'])){
    $styleExchange = "style = \"display: none;\"";
    $styleBook = "style = \"visibility: hidden;\"";
  }
  if(!isset($_SESSION['nbOfExchange']) || $_SESSION['nbOfExchange'] == 0){
    $styleExchange = "style = \"display: none;\"";
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
    <title>PROTEGON</title>
    <link rel="icon" href="PROTEGON/Logo no bg.png" type="image/png">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/gameLand.css">
</head>
<body>
    <div class="container-fluid text-center">
        <div class="row">
          <div class="col-11 col-md-2 " id="myCards">
             <font>My Cards</font> <hr>
            <?php 
            for($i = 0 ; $i < count($mycarts);$i++){
            echo "<img src=\"PROTEGON/cards/".$mycarts[$i].".png\" id=\"c-myCards-".$i."\" >";
            }
            ?>
            <br class="clear-br">
          </div>

          <div class="col-11 col-md-6" id="table" >
            <font>Table </font><hr>
            <div class="exchange_div">
              <font id="f1">Card from MyCards </font>
              <font id="f2">Card from the book </font>
              <div id="cart-ex-1"><img id="c1-c" src="PROTEGON/cards/NO CARD.png" alt=""></div>
              <div id="cart-ex-2"><img id="c2-c" src="PROTEGON/cards/NO CARD.png" alt=""></div>
              <br><br>
              <img src="img/exchange.png" alt="" id="do-the-exchange">
            </div>
            <?php 
            for($i = 0 ; $i < count($players);$i++){
              echo"<div class=\"player\" id=\"player-".$players[$i]."\"><p class=\"name\">Player ".$players[$i]."</p>\n";
              echo"<img src=\"".$img[$players[$i]]."\" class=\"img-player\" alt=\"\">\n";
              echo"<img class=\"card-player\" src=\"\" id=\"c-player-".$players[$i]."\" alt=\"\">\n";
              echo"</div>\n";
            
            }
              ?>
              <script> document.getElementById("player-<?=$_SESSION['id']?>").style.border = "solid 4px green"; </script>
            <div class="place" id="place-1" style="width: 58%;">
            <?php
             for($i = 43 ; $i < count($table);$i++){
            echo "<img src=\"PROTEGON/cards/".$table[$i].".png\" id=\"c-table-".$table[$i]."\" alt=\"\">";
            }
            ?>
            </div>
            <div class="place" id="place-2" style="width: 100%;">
            <?php
             for($i = 0 ; ($i < count($table)) && ($i < 36);$i++){
            echo "<img src=\"PROTEGON/cards/".$table[$i].".png\" id=\"c-table-".$table[$i]."\" alt=\"\">";
            }
            ?>
            </div>
            <div class="place" id="place-3" style="width: 58%;">
            <?php
             for($i = 36 ; ($i < count($table)) && ($i < 33);$i++){
            echo "<img src=\"PROTEGON/cards/".$table[$i].".png\" id=\"c-table-".$table[$i]."\" alt=\"\">";
            }
            ?>
            </div>
              <div id="info-round"><font>Round <?= $round['roundnum']?> : <?= $round['roundtype']?> </font></div>
          </div>
          <div <?= $styleBook ?> class="col-11 col-md-3" id="book">
            <font>Book </font><hr>
            <?php
             
            if(!empty($book)){
              for($i = 0 ; $i < count($book);$i++){
              echo "<img src=\"PROTEGON/cards/".$book[$i].".png\" id=\"c-book-".$i."\" alt=\"\">";
              }
            }
            
            ?>
            <br class="clear-br"><br>
              <br>
              <img <?= $styleExchange ?> src="img/exchange.png" alt="" id="exchange">
              </div>
        </div>
      </div> 
      <div id="information"></div>
      <div id="the-info"> </div>
      
</body>
</html>
<script src="bootstrap-5.3.0-alpha1-dist/js/bootstrap.js"></script>
<script src="js/gameLandCSS.js"></script>

<script>
  let isendMine = false;
  let typeClick = "isend";
  function getNumFromSrc(src){
        return src.substring(src.lastIndexOf('/') + 1, src.lastIndexOf('.'));
      }
  // i choose i card
  for(let i=0;i< <?= count($mycarts) ?>;i++){
    document.getElementById(`c-myCards-${i}`).onclick=function(){
      if(typeClick == "isend"){
        isendMine = true;
        document.getElementById(`myCards`).style.visibility = "hidden";
        document.getElementById(`book`).style.visibility = "hidden";
        document.getElementById("exchange").style.visibility = "hidden";
        let num = getNumFromSrc(this.src);
        document.getElementById(`c-player-<?= $_SESSION['id'] ?>`).src = this.src;
        var xhr = new XMLHttpRequest();
        let link = `phpToAsk/isendCard.php?isend=${num}`;
        xhr.open('GET',link,true);
        xhr.send()
      }
    }
  }
// some one choose a card
var xhr2 = new XMLHttpRequest();
xhr2.onload = function(){
  thePlayerSend = JSON.parse(this.responseText);
  values = Object.values(thePlayerSend);
  if(isendMine && (values.length == <?= count($players) ?> - 1 ) ){
    clearInterval(l);
    keys = Object.keys(thePlayerSend);
    for(let key of keys){
      document.getElementById(`c-player-${key}`).src = `PROTEGON/cards/${thePlayerSend[key]}.png`;
    }
    let end = 31;
    let l2 = setInterval(function(){
      if(end <= 0){
        clearInterval(l2);
        window.location.href = "./Index.php";
      }
      end--;
      document.getElementById(`info-round`).innerHTML = `<font style="color:green;" >The next rount will start in ${end} </font>`;

    },1000)

  }
  else{
    for(let val of values){
      document.getElementById(`c-player-${val}`).src = "PROTEGON/cards/back.png";
    }
  }
}
let l = setInterval(function(){
  xhr2.open('GET',"phpToAsk/someOneSendACard.php",true);
  xhr2.send();
},3000)




<?php if(isset($_SESSION['nbOfExchange']) && $_SESSION['nbOfExchange'] > 0): ?>
  let nbOfEx = <?php echo $_SESSION['nbOfExchange']; ?>;
  var start = document.getElementById("exchange");
  var div = document.getElementsByClassName("exchange_div")[0];
  var end = document.getElementById("do-the-exchange");
  var Mycard = document.getElementById("c1-c");
  var cardbook = document.getElementById("c2-c");
  var position_mycard = "b";
  var position_book = "b";
  start.onclick = function(){
    typeClick = "inExchange";
    cardbook.src = "PROTEGON/cards/NO CARD.png";
    Mycard.src = "PROTEGON/cards/NO CARD.png";
    this.style.visibility = "hidden";
    div.style.visibility = "visible";
    for(let i = 0; i < 23 ;i++){
      document.getElementById(`c-book-${i}`).onclick=()=>{cardbook.src = document.getElementById(`c-book-${i}`).src;position_book = i;}
    }
    for(let i=0;i< <?= count($mycarts) ?>;i++){
    document.getElementById(`c-myCards-${i}`).onclick=function(){
      if(typeClick == "isend"){
        isendMine = true;
        document.getElementById(`myCards`).style.visibility = "hidden";
        document.getElementById(`book`).style.visibility = "hidden";
        document.getElementById("exchange").style.visibility = "hidden";
        let num = getNumFromSrc(this.src);
        document.getElementById(`c-player-<?= $_SESSION['id'] ?>`).src = this.src;
        var xhr = new XMLHttpRequest();
        let link = `phpToAsk/isendCard.php?isend=${num}`;
        xhr.open('GET',link,true);
        xhr.send()
      }
      else{
        Mycard.src = document.getElementById(`c-myCards-${i}`).src;position_mycard = i;
      }
      
    }
  }
  }
  end.onclick=function(){
    typeClick = "isend";
    if(position_mycard != "b" && position_book != "b"){
      nbOfEx--;
      document.getElementById(`c-myCards-${position_mycard}`).src = cardbook.src;
      document.getElementById(`c-book-${position_book}`).src = Mycard.src;
      var xhr3 = new XMLHttpRequest();
      let link = `phpToAsk/doExchange.php?book=${getNumFromSrc(cardbook.src)}&card=${getNumFromSrc(Mycard.src)}`;
      xhr3.open('GET',link,true);
      xhr3.send();
      xhr3.onload = function(){console.log(this);}
    }
    if(nbOfEx > 0){
      start.style.visibility = "visible";
    }
    div.style.visibility = "hidden" ;
    position_mycard = "b";
    position_book = "b";
  }







  <?php endif; ?>

</script>