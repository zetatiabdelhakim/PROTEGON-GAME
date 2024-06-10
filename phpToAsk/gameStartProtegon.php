<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
if(!isset($_SESSION['idgame'])){
  header("Location: ../index.php");
  exit();
}
try{
    require_once("../connectionData.php");
    $idgame = $_SESSION['idgame'];
    $stmt = $conn->prepare("SELECT COUNT(idgame) as total FROM player WHERE idgame = :idgame");
    $stmt->bindParam(':idgame', $idgame);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result['total'] >= 4){
      $cards = array();
    for($i = 1; $i <= 100; $i++){
      if(($i>4 && $i < 15) || ($i>85 && $i < 97)){
        continue;
      }
      $cards[] = $i;
    }
    $players_cards = array( 1 => array(), 2 => array(), 3 => array(), 4 => array());
    $numbres_card = 78;
    for($i = 1; $i <= 4; $i++){
      for($j = 1; $j <= 14; $j++){
        $mycard = rand(0,$numbres_card);
        $players_cards[$i][] = $cards[$mycard];
        unset($cards[$mycard]);
        $numbres_card--;
        $cards = array_values($cards);
      }
    }
    $card = 0; $i=0;
    $stmt = $conn->prepare("INSERT INTO cards (id, idgame, card) VALUES (:id, $idgame, :card)");
    $stmt->bindParam(':id', $i);
    $stmt->bindParam(':card', $card);
    for($i = 1; $i <= 4; $i++){
      for($j = 0; $j < 14; $j++){
        $card =  $players_cards[$i][$j];
        $stmt->execute();
      }
    }
    $i = 0;
    foreach($cards as $card){
      $stmt->execute();
    }
        echo "1";
        
    }
    
    $conn = null;
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  

?>