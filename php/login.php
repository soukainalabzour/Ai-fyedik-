<?php

session_start(); 
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!empty($_POST['email_log']) && !empty($_POST['password_log'])) {
    $email = validate($_POST['email_log']);
    $password = validate($_POST['password_log']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        try {
            $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stm = $db->prepare("SELECT * FROM `client` WHERE `EMAIL_CLIENT` = :EMAIL_CLIENT AND `PASSWORD_CLIENT` = :PASSWORD_CLIENT");
            $stm->bindParam(":EMAIL_CLIENT", $email);
            $stm->bindParam(":PASSWORD_CLIENT", $password);
            $stm->execute();

            if ($stm->rowCount() > 0) {
                $res = $stm->fetch(PDO::FETCH_ASSOC); 
                $_SESSION["ID_CLIENT"] = $res["ID_CLIENT"];
                echo "client";
            } else {
                $stm = $db->prepare("SELECT * FROM `admin` WHERE `EMAIL_ADMIN` = :EMAIL_ADMIN AND `PASSWORD_ADMIN` = :PASSWORD_ADMIN");
                $stm->bindParam(":EMAIL_ADMIN", $email);
                $stm->bindParam(":PASSWORD_ADMIN", $password);
                $stm->execute();

                if ($stm->rowCount() > 0) {
                    $res = $stm->fetch(PDO::FETCH_ASSOC); 
                    echo "admin";
                }else{
                    echo "Password or email incorrect";
                }

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else {
    echo "Please fill out all the fields!";
}
?>
