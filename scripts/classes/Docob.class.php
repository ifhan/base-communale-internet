<?php

/**
 * Description of Docob
 * Classe et fonctions concernant les Documents d'Objectifs Natura 2000
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-30
 * @version 1.0
 */
class Docob {
    
    /**
     * Sélectionne l'ensemble des sites Natura 2000 pour afficher 
     * un tableau des DOCOB
     * @global string $pdo Connexion à la base de données
     * @return array 
     */
    public function getDocobByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('(SELECT * 
        FROM R_ZPS_R52_data
        WHERE R_ZPS_R52_data.id_regional = :id_regional) 
        UNION  (SELECT * 
        FROM R_ZSC_R52_data
        WHERE R_ZSC_R52_data.id_regional = :id_regional)
        UNION(SELECT * 
        FROM R_SIC_R52_data
        WHERE R_SIC_R52_data.id_regional = :id_regional)');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->id_article = $row["id_article"];
            $this->id_side = $row["id_side"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne l'ensemble des sites Natura 2000 pour afficher 
 * un tableau des DOCOB
 * @global string $pdo Connexion à la base de données
 * @return array 
 */
function getDocob() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('(SELECT * 
        FROM R_ZPS_R52_data) 
        UNION  (SELECT * FROM R_ZSC_R52_data) 
        UNION(SELECT * FROM R_SIC_R52_data) 
        ORDER BY id_regional');
    $sql->execute();
    try {
        $docob = $sql->fetchAll();
        return $docob;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
