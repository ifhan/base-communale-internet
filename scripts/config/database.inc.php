<?php
// Database connection using PDO
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=base_communale_internet', USERNAME, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $pdo->exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>