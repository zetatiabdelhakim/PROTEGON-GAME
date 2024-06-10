<?php
function getMycards($id, $idgame , $conn){
    $stmt = $conn->prepare("SELECT * FROM cards WHERE id = $id AND idgame = $idgame");
    $stmt->execute();
    $yourCards = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = array();
    if (!empty($yourCards)) {
        foreach ($yourCards as $your) {
            $result[] = $your['card'];
        }
    }
    return $result;
}
function getBook($idgame, $conn){
    $stmt = $conn->prepare("SELECT * FROM cards WHERE id = 0 AND idgame = $idgame");
    $stmt->execute();
    $yourCards = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = array();
    if (!empty($yourCards)) {
        foreach ($yourCards as $your) {
            $result[] = $your['card'];
        }
    }
    return $result;
}
function getTable($idgame, $conn){
    $stmt = $conn->prepare("SELECT * FROM cards WHERE id = -1 AND idgame = $idgame");
    $stmt->execute();
    $yourCards = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = array();
    if (!empty($yourCards)) {
        foreach ($yourCards as $your) {
            $result[] = $your['card'];
        }
    }
    return $result;
}
function insertRound($conn, $idgame, $roundnum = NULL, $roundtype= NULL, $lastwin= NULL, $lastlose= NULL, $idelim= NULL){
    $stmt = $conn->prepare("INSERT INTO round (idgame, roundnum, roundtype, lastwin, lastlose, idelim) VALUES (:idgame, :roundnum, :roundtype, :lastwin, :lastlose, :idelim)");
    $stmt->bindParam(':idgame', $idgame);
    $stmt->bindParam(':roundnum', $roundnum);
    $stmt->bindParam(':roundtype', $roundtype);
    $stmt->bindParam(':lastwin', $lastwin);
    $stmt->bindParam(':lastlose', $lastlose);
    $stmt->bindParam(':idelim', $idelim);
    $stmt->execute();
}
function numberPlayer($idgame, $conn){
    $stmt = $conn->prepare("SELECT COUNT(idgame) as total FROM player WHERE idgame = $idgame");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
function nbOfExchange($idgame, $id, $conn){
    $stmt = $conn->prepare("SELECT isprotegon  FROM player WHERE idgame = $idgame AND id = $id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    switch($result['isprotegon']){
        case '1': return 2;
        case '2': return 1;
        case '3': return 0;
    }
}
function selectRound($conn, $idgame) {
    $stmt = $conn->prepare("SELECT * FROM round WHERE idgame = :idgame");
    $stmt->bindParam(':idgame', $idgame);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function whoIsProtegon($idgame, $conn){
    $query = "SELECT id FROM player WHERE idgame = $idgame AND isprotegon <> 0";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}
function players($idgame, $conn){
    $query = "SELECT id FROM player WHERE idgame = $idgame";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pl= array();
    foreach($result as $rul){
        $pl[] = $rul['id'];
    }
    return $pl;
}
?>