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
    $isend = $_GET['isend'];
    $idgame = $_SESSION['idgame'];
    $id = $_SESSION['id'];
    $sql = "UPDATE player SET isend = $isend WHERE idgame = $idgame AND id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $conn = null;
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>