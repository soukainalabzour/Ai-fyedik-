<?php
// Database connection using PDO
$dsn = 'mysql:host=localhost;dbname=finale';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT ID_CATEGORY , NOM_CATEGORY  FROM category');
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['categories' => $categories]);

} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
?>