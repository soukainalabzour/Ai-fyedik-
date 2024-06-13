<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer toutes les informations des administrateurs
    $stm = $db->prepare("SELECT
                            `ID_ADMIN`,
                            `NOM_ADMIN`,
                            `PRENOM_ADMIN`,
                            `EMAIL_ADMIN`
                         FROM `admin`");

    $stm->execute();

    $results = $stm->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
