<?php
// Database connection using PDO
$dsn = 'mysql:host=localhost;dbname=finale';
$username = 'root';
$password = '';

$id_category = $_GET['id_category'];


try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Hardcoding the category ID to 4
  
    $stmt = $pdo->prepare("SELECT ID_SERVICE, NOM_SERVICE FROM  service  WHERE ID_CATEGORY = '$id_category'");
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['services' => $services]);

} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
?>

