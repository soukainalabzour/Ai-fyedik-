<?php
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nbrErr = 0;

if(!empty($_POST['EMAIL_CLIENT']) && !empty($_POST['passwordC']) && !empty($_POST['passwordCc'])){
    $emailC = validate($_POST['EMAIL_CLIENT']);
    $passwordC = validate($_POST['passwordC']);
    $passwordCc = validate($_POST['passwordCc']);
    $check = "empty";

    // Validate password
    if(strlen($passwordC) < 8){
        $nbrErr++;
        echo "Password must be longer than 8 characters";
    } else if($passwordC != $passwordCc){
        $nbrErr++;
        echo "Passwords do not match";
    } else if (!filter_var($emailC, FILTER_VALIDATE_EMAIL)) {
        // Validate email
        $nbrErr++;
        echo "Invalid email format";
    } else {
        try {
            $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stm = $db->prepare("SELECT * FROM `client` WHERE EMAIL_CLIENT = :EMAIL_CLIENT");
            $stm->bindParam(":EMAIL_CLIENT", $emailC);
            $stm->execute();
            
            if($stm->rowCount() > 0){
                $nbrErr++;
                echo "Email already exists!";
            } else {
                // Insert data of user
                if($nbrErr <= 0){
                    $stm = $db->prepare("INSERT INTO `client` (EMAIL_CLIENT,
                     PASSWORD_CLIENT, NOM_CLIENT,PRENOM_CLIENT,
                     LANGUAGE_CLIENT,PAYS_CLIENT,VILLE_CLIENT,
                     ADRESSE_CLIENT,NUM_CLIENT) VALUES 
                     (:EMAIL_CLIENT, :PASSWORD_CLIENT,
                     :NOM_CLIENT,:PRENOM_CLIENT,:LANGUAGE_CLIENT,
                     :PAYS_CLIENT,:VILLE_CLIENT,:ADRESSE_CLIENT,
                     :NUM_CLIENT)");
                    $stm->bindParam(":EMAIL_CLIENT", $emailC); 
                    $stm->bindParam(":PASSWORD_CLIENT", $passwordC);
                    $stm->bindParam(":NOM_CLIENT", $check);
                    $stm->bindParam(":PRENOM_CLIENT", $check);
                    $stm->bindParam(":LANGUAGE_CLIENT", $check);
                    $stm->bindParam(":PAYS_CLIENT",$check);
                    $stm->bindParam(":VILLE_CLIENT", $check);
                    $stm->bindParam(":ADRESSE_CLIENT", $check);
                    $stm->bindParam(":NUM_CLIENT",$check);

                    $stm->execute();
                    echo "true";
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
} else {
    echo "Please fill out all the fields!";
}
?>
