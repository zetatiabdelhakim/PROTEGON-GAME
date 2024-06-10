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
      if(!isset($_GET['type'])){
          $query = "SELECT roundtype FROM round WHERE idgame = $idgame";
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($row['roundtype'] !== NULL) {
              echo "1";
            }
      }
      else{
          if(!isset($_SESSION['isprotegon'])){
            header("Location: index.php");
            exit();
          }
          $roundtype = $_GET['type'];
          $sql = "UPDATE round SET roundtype = '$roundtype' WHERE idgame = $idgame";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          header('location:../gameLand.php');
      }


      $conn = null;
    }catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    