<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer toutes les informations des vendeurs
    $stm = $db->prepare("SELECT
                            `ID_SELLER`, 
                            `NOM_SELLER`,
                            `PRENOM_SELLER`,
                            `DESCRIPTION_SELLER`,
                            `LIEN_SELLER`,
                            `EMAIL_SELLER`,
                            `NUM_SELLER`
                         FROM `seller`");

    $stm->execute();

    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($results);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
