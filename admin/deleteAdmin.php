<?php
$idA = $_GET['idA'];

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Supprimer l'administrateur
    $stm = $db->prepare("DELETE FROM `admin` WHERE `ID_ADMIN` = :id");
    $stm->bindParam(":id", $idA);
    $stm->execute();

    // Redirection après la suppression
    header("Location: index.html#admins");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage(); 
}
?>
