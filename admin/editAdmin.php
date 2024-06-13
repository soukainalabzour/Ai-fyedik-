<?php
$idA = $_GET["idA"];
try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données de l'administrateur
    $stm = $db->prepare("SELECT
                            `NOM_ADMIN`,
                            `PRENOM_ADMIN`,
                            `EMAIL_ADMIN`
                         FROM `admin` WHERE `ID_ADMIN` = :id");
    $stm->bindParam(":id", $idA);
    $stm->execute();

    $admin = $stm->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/compteclient.css">
    <title>Modifier Administrateur</title>
</head>
<body>
    <header>
        <div class="logoiCons">
            <div class="logo">
                <img src="../image/logo.svg">
            </div>
            <div class="stuff">
                <div class="notification">
                    <img src="../image/Vector.png">
                </div>
                <div class="boite_message">
                    <img src="../image/formkit_email.png">
                </div>
                <div class="photo_profil">
                    <img src="../image/Group 105.png">
                </div>
            </div>
        </div>
    </header>
    
    <form class="form" id="formAd" action="" method="POST">
        <div class="champ" id="reponceAd"></div>

        <div class="name">
            <label>Nom :</label>
            <input type="text" id="fnameAd" name="fnameAd" required value="<?php echo htmlspecialchars($admin['NOM_ADMIN']); ?>"><br><br>
        </div>
        <div class="last">
            <label>Prénom :</label>
            <input type="text" id="lnameAd" name="lnameAd" required value="<?php echo htmlspecialchars($admin['PRENOM_ADMIN']); ?>"><br><br>
        </div>
        <div class="email">
            <label>Email :</label>
            <input type="email" id="emailAd" name="emailAd" required value="<?php echo htmlspecialchars($admin['EMAIL_ADMIN']); ?>"><br><br>
        </div>
        <input type="submit" value="Mettre à jour" name="submit" id="submit_Ad">
    </form>
</body>
</html>

<?php
if(isset($_POST["submit"])){
    try {
        $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stm = $db->prepare("UPDATE `admin` SET 
            `EMAIL_ADMIN` = :email, 
            `NOM_ADMIN` = :fname, 
            `PRENOM_ADMIN` = :lname 
            WHERE `ID_ADMIN` = :id");
    
        $stm->bindParam(':email', $_POST['emailAd']);
        $stm->bindParam(':fname', $_POST['fnameAd']);
        $stm->bindParam(':lname', $_POST['lnameAd']);
        $stm->bindParam(':id', $idA);
    
        $stm->execute();
    
        // Redirection après la mise à jour
        header("Location: index.html#admins");
        exit();

    } catch (PDOException $e) {
        echo  $e->getMessage();
    }
}
?>
