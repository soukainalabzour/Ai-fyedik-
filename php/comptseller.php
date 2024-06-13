<?php
// Database connection using PDO
$dsn = 'mysql:host=localhost;dbname=finale';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT ID_LANGUE, NOM_LANGUE FROM langue');
    $languages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['languages' => $languages]);

} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}

?>

