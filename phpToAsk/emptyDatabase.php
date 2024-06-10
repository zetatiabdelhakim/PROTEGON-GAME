<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
if(!(isset($_GET['delete']) && $_GET['delete']=="Xofr2019" )){
  header("Location: ../index.php");
  exit();
}
try{
    require_once("../connectionData.php");
    $sql = "DELETE FROM player WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sql = "DELETE FROM round WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sql = "DELETE FROM cards WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $conn = null;
    session_destroy();
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }