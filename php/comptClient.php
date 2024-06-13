<?php
session_start(); 
$id = $_SESSION["ID_CLIENT"];

header('Content-Type: application/json');

function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$response = array();

if(!empty($_POST['NOM_CLIENT']) && !empty($_POST['PRENOM_CLIENT']) && !empty($_POST['LANGUAGE_CLIENT'])  && !empty($_POST['PAYS_CLIENT']) && !empty($_POST['VILLE_CLIENT']) && !empty($_POST['ADRESSE_CLIENT']) && !empty($_POST['NUM_CLIENT'])){
    $fname = validate($_POST['NOM_CLIENT']);
    $lname = validate($_POST['PRENOM_CLIENT']);
    $language = validate($_POST['LANGUAGE_CLIENT']);
    $country = validate($_POST['PAYS_CLIENT']);
    $ville = validate($_POST['VILLE_CLIENT']);
    $adresse = validate($_POST['ADRESSE_CLIENT']);
    $num_phone = validate($_POST['NUM_CLIENT']);
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stm = $db->prepare("UPDATE  client  SET 
        NOM_CLIENT=:NOM_CLIENT,
        PRENOM_CLIENT=:PRENOM_CLIENT,
        LANGUAGE_CLIENT=:LANGUAGE_CLIENT,
        PAYS_CLIENT=:PAYS_CLIENT, 
        VILLE_CLIENT=:VILLE_CLIENT, 
        ADRESSE_CLIENT=:ADRESSE_CLIENT, 
        NUM_CLIENT=:NUM_CLIENT WHERE ID_CLIENT=:ID_CLIENT");
        $stm->bindParam(":NOM_CLIENT", $fname); 
        $stm->bindParam(":ID_CLIENT", $id); 
        $stm->bindParam(":PRENOM_CLIENT", $lname);
        $stm->bindParam(":LANGUAGE_CLIENT", $language);
        $stm->bindParam(":PAYS_CLIENT", $country);
        $stm->bindParam(":VILLE_CLIENT", $ville);
        $stm->bindParam(":ADRESSE_CLIENT", $adresse);
        $stm->bindParam(":NUM_CLIENT", $num_phone);

        $stm->execute();
        
        $response['status'] = "success";
    }catch(PDOException $e) {
        $response['status'] = "error";
        $response['message'] = $e->getMessage();
    }
}else{
    $response['status'] = "error";
    $response['message'] = "Please fill out all the fields!";
}

echo json_encode($response);
?>