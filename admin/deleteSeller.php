<?php

    $idS = $_GET['idS'];

    try {
        $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stm = $db->prepare("DELETE FROM `seller` WHERE `ID_SELLER` = :id");
        $stm->bindParam(":id", $idS);
        $stm->execute();

        
        header("Location: index.html#sellers");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage(); 
    }
?>
