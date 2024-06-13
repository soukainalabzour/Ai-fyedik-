<?php
session_start(); 
$id = $_SESSION["ID_CLIENT"];

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stm = $db->prepare("SELECT `EMAIL_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `LANGUAGE_CLIENT`, `ADRESSE_CLIENT`, `VILLE_CLIENT`, `PAYS_CLIENT`, `NUM_CLIENT` FROM `client` WHERE `ID_CLIENT` = :id");
    $stm->bindParam(":id", $id);
    $stm->execute();

    $res = $stm->fetch(PDO::FETCH_ASSOC); 
    echo json_encode([
        'status' => 'success',
        'data' => $res
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}




