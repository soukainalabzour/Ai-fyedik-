<?php
header('Content-Type: application/json');
session_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['ID_CLIENT'])) {
        $id = $_SESSION['ID_CLIENT'];

        $stm = $db->prepare("SELECT `EMAIL_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `LANGUAGE_CLIENT`, `ADRESSE_CLIENT`, `VILLE_CLIENT`, `PAYS_CLIENT`,`NUM_CLIENT` FROM `client` WHERE `ID_CLIENT` = :id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();

        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'data' => $result]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Client ID not set']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
