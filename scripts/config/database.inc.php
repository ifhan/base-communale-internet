<?php
// Database connection using PDO with MySQL
try {
    $pdo = new PDO(
                    'mysql:host=localhost;dbname=base_communale_internet', 
            USERNAME, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $pdo->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

// Database connection using PDO with PostGreSQL
try {
    $pdo_pg = new PDO(
                    'pgsql:host=10.44.128.174;dbname=bd_eolien', 
            'dreal', 'dreal');
    $pdo_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

/**
 * Classe de connection à la base de données utilisant un singleton pattern
 */
class ConnectionFactory {
    
    private static $factory;

    public static function getFactory() {
        if (!self::$factory)
            self::$factory = new ConnectionFactory();
        return self::$factory;
    }

    private $pdo;

    public function getConnection() {
        if (!$pdo)
            try {
                $pdo = new PDO(
                                'mysql:host=localhost;dbname=base_communale_internet',
                                USERNAME, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                $pdo->exec("SET CHARACTER SET utf8");
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
        return $pdo;
    }

}
