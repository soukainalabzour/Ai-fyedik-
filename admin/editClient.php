<?php
$idC = $_GET["idC"];
try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du client
    $stm = $db->prepare("SELECT
                            `NOM_CLIENT`,
                            `PRENOM_CLIENT`,
                            `EMAIL_CLIENT`,
                            `LANGUAGE_CLIENT`,
                            `PAYS_CLIENT`,
                            `VILLE_CLIENT`,
                            `ADRESSE_CLIENT`,
                            `NUM_CLIENT`
                         FROM `client` WHERE `ID_CLIENT` = :id");
    $stm->bindParam(":id", $idC);
    $stm->execute();

    $client = $stm->fetch(PDO::FETCH_ASSOC);

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
    <title>AI-Fydik</title>
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
    
    <form class="form" id="formCl" action="" method="POST">
        <div class="champ" id="reponceCl"></div>

        <div class="name">
            <label> :الإسم</label>
            <input type="text" id="fnameCl" name="fnameCl" required value="<?php echo htmlspecialchars($client['NOM_CLIENT']); ?>"><br><br>
        </div>
        <div class="last">
            <label> :النسب</label>
            <input type="text" id="lnameCl" name="lnameCl" required value="<?php echo htmlspecialchars($client['PRENOM_CLIENT']); ?>"><br><br>
        </div>
        <div class="lang">
            <label>: اللغة</label>
            <input type="text" id="lang" name="lang" required value="<?php echo htmlspecialchars($client['LANGUAGE_CLIENT']); ?>"><br><br>
        </div>
        <div class="email">
            <label>:البريد الإلكتروني</label>
            <input type="email" id="email_log" name="email_log" required value="<?php echo htmlspecialchars($client['EMAIL_CLIENT']); ?>"><br><br>
        </div>
        <div class="country">
            <label>:البلد</label>
            <input type="text" id="countryCl" name="countryCl" required value="<?php echo htmlspecialchars($client['PAYS_CLIENT']); ?>"><br><br>
        </div>
        <div class="city">
            <label>:المدينة</label>
            <input type="text" id="cityCl" name="cityCl" required value="<?php echo htmlspecialchars($client['VILLE_CLIENT']); ?>"><br><br>
        </div>
        <div class="adress">
            <label>:العنوان</label>
            <input type="text" id="adressCl" name="adressCl" required value="<?php echo htmlspecialchars($client['ADRESSE_CLIENT']); ?>"><br><br>
        </div>
        <div class="num">
            <label>رقم الهاتف</label>
            <input type="number" id="numCl" name="numCl" required value="<?php echo htmlspecialchars($client['NUM_CLIENT']); ?>"><br><br>
        </div>
        <input type="submit" value="تأكيد" name="submit" id="submit_Cl">
    </form>
   
</body>
</html>

<?php

if(isset($_POST["submit"])){
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
    
        $stm->bindParam(':email', $_POST['email_log']);
        $stm->bindParam(':fname', $_POST['fnameCl']);
        $stm->bindParam(':lname', $_POST['lnameCl']);
        $stm->bindParam(':language', $_POST['lang']);
        $stm->bindParam(':address', $_POST['adressCl']);
        $stm->bindParam(':city', $_POST['cityCl']);
        $stm->bindParam(':country', $_POST['countryCl']);
        $stm->bindParam(':num', $_POST['numCl']);
        $stm->bindParam(':id', $idC);
    
        $stm->execute();
    
        // Redirection après la mise à jour
        header("Location: index.html#clients");
        exit();

    } catch (PDOException $e) {
        echo  $e->getMessage();
    }
}
?>

