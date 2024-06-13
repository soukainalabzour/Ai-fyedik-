<?php

    $idC = $_GET['idC'];

    try {
        $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stm = $db->prepare("DELETE FROM `client` WHERE `ID_CLIENT` = :id");
        $stm->bindParam(":id", $idC);
        $stm->execute();

        
        header("Location: index.html#clients");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage(); 
    }
?>
