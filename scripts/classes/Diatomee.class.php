<?php

/**
 * Description of Diatomee
 * Classe et fonctions concernant les taxons de diatomées
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-06-04
 * @version 1.0
 */
class Diatomee {
    /**
     * Sélectionne les taxons de diatomée par genre
     * @param string $code_genre Identifiants du genre
     */
    public function getDiatomeesByCodeGenre($code_genre) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_diatomee_taxon_r52
        WHERE code_genre = :$code_genre');
        $sql->bindParam(':code_genre', $code_genre, PDO::PARAM_STR, 4);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->code_espece = $row["code_espece"];
            $this->espece = stripslashes($row["espece"]);
            $this->code_genre = $row["code_genre"];
            $this->genre = $row["genre"];
            $this->code_famille = $row["code_famille"];
            $this->famille = $row["famille"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

/**
 * Sélectionne l'ensemble des taxons de diatomées en Pays de la Loire
 * @return array 
 */
function getDiatomees() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM r_diatomee_taxon_r52
    ORDER BY code_espece');
    try {
        $sql->execute();
        $diatomees = $sql->fetchAll();
        return $diatomees;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
