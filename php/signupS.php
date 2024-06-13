<?php
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nbrErr = 0;

if(!empty($_POST['emailS']) && !empty($_POST['passwordS']) && !empty($_POST['passwordSc'])){
    $emailS = validate($_POST['emailS']);
    $passwordS = validate($_POST['passwordS']);
    $passwordSc = validate($_POST['passwordSc']);

    // Validate password
    if(strlen($passwordS) < 8){
        $nbrErr++;
        echo "Password must be longer than 8 characters";
    } else if($passwordS != $passwordSc){
        $nbrErr++;
        echo "Passwords do not match";
    } else if (!filter_var($emailS, FILTER_VALIDATE_EMAIL)) {
        // Validate email
        $nbrErr++;
        echo "Invalid email format";
    } else {
        try {
            $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stm = $db->prepare("SELECT * FROM `seller` WHERE EMAIL_SELLER = :EMAIL_SELLER");
            $stm->bindParam(":EMAIL_SELLER", $emailS, PDO::PARAM_STR);

            $stm->execute();
            
            if($stm->rowCount() > 0){
                $nbrErr++;
                echo "Email already exists!";
            } else {
                // Insert data of user
                if($nbrErr <= 0){
                    $stm = $db->prepare("INSERT INTO `seller` (EMAIL_SELLER, PASSWORD_SELLER) VALUES (:EMAIL_SELLER, :PASSWORD_SELLER)");
                    $stm->bindParam(":EMAIL_SELLER", $emailS); 
                    $stm->bindParam(":PASSWORD_SELLER", $passwordS);

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
