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
    $_SESSION['nbOfExchange'] = $_SESSION['nbOfExchange'] - 1;
    $card = $_GET['card'];
    $book = $_GET['book'];
    $idgame = $_SESSION['idgame'];
    $id = $_SESSION['id'];
    $sql = "UPDATE cards SET `card` = $card WHERE idgame = $idgame AND id = 0 AND `card` = $book";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sql = "UPDATE cards SET `card` = $book WHERE idgame = $idgame AND id = $id AND `card` = $card";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $conn = null;
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>