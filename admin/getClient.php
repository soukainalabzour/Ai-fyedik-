<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer toutes les clients
    $stm = $db->prepare("SELECT
                            `ID_CLIENT`,
                            `NOM_CLIENT`,
                            `PRENOM_CLIENT`,
                            `EMAIL_CLIENT`,
                            `LANGUAGE_CLIENT`,
                            `PAYS_CLIENT`,
                            `VILLE_CLIENT`,
                            `ADRESSE_CLIENT`,
                            `NUM_CLIENT`
                         FROM `client`");

    $stm->execute();

    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($results);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
