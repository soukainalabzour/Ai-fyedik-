<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer toutes les informations des commandes
    $stm = $db->prepare("SELECT
                            O.ID_ORDER,
                            C.NOM_CLIENT,
                            S.NOM_SERVICE,
                            CT.NOM_CATEGORY,
                            O.DATE_ORDER,
                            O.ETAT_ORDER
                         FROM `order` AS O
                         INNER JOIN `client` AS C ON O.ID_CLIENT = C.ID_CLIENT
                         INNER JOIN `service` AS S ON O.ID_SERVICE = S.ID_SERVICE
                         INNER JOIN `category` AS CT ON S.ID_CATEGORY = CT.ID_CATEGORY");

    $stm->execute();

    $results = $stm->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
