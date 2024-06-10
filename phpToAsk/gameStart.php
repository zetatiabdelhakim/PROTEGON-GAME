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
        echo "1";
    }
    $conn = null;
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>