<?php
session_start();
header('Content-Type: application/json');

// Vérification que l'ID_CLIENT est présent dans la session
if (!isset($_SESSION["ID_CLIENT"])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Client ID is missing in the session.'
    ]);
    exit;
}

$id = $_SESSION["ID_CLIENT"];
$data = json_decode(file_get_contents('php://input'), true);

// Vérification que les données JSON sont bien définies
if (!$data || !is_array($data)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid or missing input data.'
    ]);
    exit;
}

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stm = $db->prepare("UPDATE `client` SET 
        `EMAIL_CLIENT` = :email, 
        `NOM_CLIENT` = :fname, 
        `PRENOM_CLIENT` = :lname, 
        `LANGUAGE_CLIENT` = :language, 
        `ADRESSE_CLIENT` = :address, 
        `VILLE_CLIENT` = :city, 
        `PAYS_CLIENT` = :country, 
        `NUM_CLIENT` = :num 
        WHERE `ID_CLIENT` = :id");

    $stm->bindParam(':email', $data['email']);
    $stm->bindParam(':fname', $data['fname']);
    $stm->bindParam(':lname', $data['lname']);
    $stm->bindParam(':language', $data['language']);
    $stm->bindParam(':address', $data['address']);
    $stm->bindParam(':city', $data['city']);
    $stm->bindParam(':country', $data['country']);
    $stm->bindParam(':num', $data['num']);
    $stm->bindParam(':id', $id);

    $stm->execute();

    echo json_encode([
        'status' => 'success',
        'message' => 'Client data updated successfully'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
