<?php
$idO = $_GET['idO'];

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Supprimer la commande
    $stm = $db->prepare("DELETE FROM `order` WHERE `ID_ORDER` = :id");
    $stm->bindParam(":id", $idO);
    $stm->execute();

    // Redirection après la suppression
    header("Location: index.html#orders");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage(); 
}
?>
