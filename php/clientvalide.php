<?php
session_start(); 
$id = $_SESSION["ID_CLIENT"];
try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stm = $db->prepare("SELECT `EMAIL_CLIENT` FROM `client` WHERE `ID_CLIENT` = :id ");
    $stm->bindParam(":id", $id);
    $stm->execute();

    $res = $stm->fetch(PDO::FETCH_ASSOC); 
    $rep = $res["EMAIL_CLIENT"];
    echo json_encode($rep);
} catch (PDOException $e) {
    echo $e->getMessage();
}



?>