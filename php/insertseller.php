<?php
session_start(); 
$id = $_SESSION["ID_SELLER"];

header('Content-Type: application/json');

function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$response = array();

foreach ($_POST as $k => $v) {
    if (empty($v)) {
        $response['status'] = "error";
        $response['message'] = "Please fill out all the fields!";
        echo json_encode($response);
        die();
    }
}

$NOM_SELLER = validate($_POST['NOM_SELLER']);
$PRENOM_SELLER = validate($_POST['PRENOM_SELLER']);
$DESCRIPTION_SELLER = validate($_POST['DESCRIPTION_SELLER']);
$LIEN_SELLER = validate($_POST['LIEN_SELLER']);
$SELLER_SKILL = validate($_POST['SELLER_SKILL']);
$SELLER_CATEGORY = validate($_POST['SELLER_CATEGORY']);
$SELLER_SERVICE = validate($_POST['SELLER_SERVICE']);
$NUM_SELLER = validate($_POST['NUM_SELLER']);

try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stm = $db->prepare("UPDATE seller SET 
        NOM_SELLER = :NOM_SELLER,
        PRENOM_SELLER = :PRENOM_SELLER,
        DESCRIPTION_SELLER = :DESCRIPTION_SELLER,
        LIEN_SELLER = :LIEN_SELLER,
        SELLER_SKILL = :SELLER_SKILL,
        SELLER_CATEGORY = :SELLER_CATEGORY,
        SELLER_SERVICE = :SELLER_SERVICE,
        NUM_SELLER = :NUM_SELLER
        WHERE ID_SELLER = :ID_SELLER");
    $stm->bindParam(":NOM_SELLER", $NOM_SELLER);
    $stm->bindParam(":ID_SELLER", $id);
    $stm->bindParam(":PRENOM_SELLER", $PRENOM_SELLER);
    $stm->bindParam(":DESCRIPTION_SELLER", $DESCRIPTION_SELLER);
    $stm->bindParam(":LIEN_SELLER", $LIEN_SELLER);
    $stm->bindParam(":SELLER_SKILL", $SELLER_SKILL);
    $stm->bindParam(":NUM_SELLER", $NUM_SELLER);
    $stm->bindParam(":SELLER_CATEGORY", $SELLER_CATEGORY);
    $stm->bindParam(":SELLER_SERVICE", $SELLER_SERVICE);

    $stm->execute();
    
    $response['status'] = "success";
} catch (PDOException $e) {
    $response['status'] = "error";
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
