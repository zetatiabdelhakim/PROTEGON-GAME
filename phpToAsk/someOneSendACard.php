<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
if(!isset($_SESSION['idgame'])){
  header("Location: ../index.php");
  exit();
}
try{
    $idgame = $_SESSION['idgame'];
    $id = $_SESSION['id'];
    require_once("../connectionData.php");
    require_once("functions.php");
    $nubPlayer = numberPlayer($idgame, $conn);
    $query = "SELECT id, isend FROM player 
    WHERE idgame = $idgame AND id <> $id AND isend IS NOT NULL";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pl = '{';
    if(count($result) != $nubPlayer - 1){
        for($i = 0; $i < count($result); $i++){
            $now = $result[$i];
            if($i != count($result)-1){
                $pl .= "\"p$i\": ".$now['id'].",";
            }
            else{
                $pl .= "\"p$i\": ".$now['id']."";
            }
        }
    }else{
        for($i = 0; $i < count($result); $i++){
            $now = $result[$i];
            if($i != count($result)-1){
                $pl .= "\"".$now['id']."\": ".$now['isend'].",";
            }
            else{
                $pl .= "\"".$now['id']."\": ".$now['isend']."";
            }
        }
    }
    $pl .= "}";
    echo $pl;
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>