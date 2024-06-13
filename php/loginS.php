<?php

session_start(); 
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!empty($_POST['emailS']) && !empty($_POST['passwordS'])) {
    $emailS = validate($_POST['emailS']);
    $passwordS = validate($_POST['passwordS']);

    if (!filter_var($emailS, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        try {
            $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stm = $db->prepare("SELECT * FROM `seller` WHERE `EMAIL_SELLER` = :EMAIL_SELLER AND `PASSWORD_SELLER` = :PASSWORD_SELLER");
            $stm->bindParam(":EMAIL_SELLER", $emailS);
            $stm->bindParam(":PASSWORD_SELLER", $passwordS);
            $stm->execute();

            if ($stm->rowCount() <= 0) {
                echo "Password or email incorrect";
            } else {
                $res = $stm->fetch(PDO::FETCH_ASSOC); 
                $_SESSION["ID_SELLER"] = $res["ID_SELLER"];
                echo "true";

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else {
    echo "Please fill out all the fields!";
}
?>
