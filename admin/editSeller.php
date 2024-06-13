<?php
$idS = $_GET["idS"];
try {
    $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du vendeur
    $stm = $db->prepare("SELECT
                            `ID_SELLER`, 
                            `NOM_SELLER`,
                            `PRENOM_SELLER`,
                            `DESCRIPTION_SELLER`,
                            `LIEN_SELLER`,
                            `EMAIL_SELLER`,
                            `NUM_SELLER`
                         FROM `seller` WHERE `ID_SELLER` = :id");
    $stm->bindParam(":id", $idS);
    $stm->execute();

    $seller = $stm->fetch(PDO::FETCH_ASSOC);

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
        <!-- Header content here -->
    </header>
    
    <form class="form" id="formSl" action="" method="POST">
        <div class="champ" id="reponceSl"></div>

        <div class="name">
            <label> :الإسم</label>
            <input type="text" id="fnameSl" name="fnameSl" required value="<?php echo htmlspecialchars($seller['NOM_SELLER']); ?>"><br><br>
        </div>
        <div class="last">
            <label> :النسب</label>
            <input type="text" id="lnameSl" name="lnameSl" required value="<?php echo htmlspecialchars($seller['PRENOM_SELLER']); ?>"><br><br>
        </div>
        <div class="description">
            <label>: الوصف</label>
            <input type="text" id="description" name="description" required value="<?php echo htmlspecialchars($seller['DESCRIPTION_SELLER']); ?>"><br><br>
        </div>
        <div class="lien">
            <label>:الرابط</label>
            <input type="text" id="lien" name="lien" required value="<?php echo htmlspecialchars($seller['LIEN_SELLER']); ?>"><br><br>
        </div>
        <div class="email">
            <label>:البريد الإلكتروني</label>
            <input type="email" id="email_log" name="email_log" required value="<?php echo htmlspecialchars($seller['EMAIL_SELLER']); ?>"><br><br>
        </div>
        <div class="num">
            <label>رقم الهاتف</label>
            <input type="number" id="numSl" name="numSl" required value="<?php echo htmlspecialchars($seller['NUM_SELLER']); ?>"><br><br>
        </div>
        <input type="submit" value="تأكيد" name="submit" id="submit_Sl">
    </form>
   
</body>
</html>

<?php

if(isset($_POST["submit"])){
    try {
        $db = new PDO("mysql:host=localhost;dbname=finale", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stm = $db->prepare("UPDATE `seller` SET 
            `EMAIL_SELLER` = :email, 
            `NOM_SELLER` = :fname, 
            `PRENOM_SELLER` = :lname, 
            `DESCRIPTION_SELLER` = :description, 
            `LIEN_SELLER` = :lien, 
            `NUM_SELLER` = :num 
            WHERE `ID_SELLER` = :id");
    
        $stm->bindParam(':email', $_POST['email_log']);
        $stm->bindParam(':fname', $_POST['fnameSl']);
        $stm->bindParam(':lname', $_POST['lnameSl']);
        $stm->bindParam(':description', $_POST['description']);
        $stm->bindParam(':lien', $_POST['lien']);
        $stm->bindParam(':num', $_POST['numSl']);
        $stm->bindParam(':id', $idS);
    
        $stm->execute();
    
        // Redirection après la mise à jour
        header("Location: index.html#sellers");
        exit();

    } catch (PDOException $e) {
        echo  $e->getMessage();
    }
}
?>
