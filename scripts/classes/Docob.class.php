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
    public function getDocob() {
        global $pdo;
        $sql = "(SELECT * FROM R_ZPS_R52_data) 
        UNION  (SELECT * FROM R_ZSC_R52_data)
        UNION(SELECT * FROM R_SIC_R52_data)
        ORDER BY id_regional";
        try {
            $docobs = array();
            while ($docobs = $pdo->query($sql)->fetchAll()) {
                $docobs[] = $row;
            }
            return $docobs;
            $this->id_regional = $docobs["id_regional"];
            $this->nom = $docobs["nom"];
            $this->id_article = $docobs["id_article"];
            $this->id_type = $docobs["id_type"];
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
    global $pdo;
    $sql = $pdo->prepare('(SELECT * 
        FROM R_ZPS_R52_data) 
        UNION  (SELECT * FROM R_ZSC_R52_data) 
        UNION(SELECT * FROM R_SIC_R52_data) 
        ORDER BY id_regional');
    $sql->execute();
    try {
        $docob = $sql->fetchAll();
        return $docob;
        $this->id_regional = $docob["id_regional"];
        $this->nom = $docob["nom"];
        $this->id_article = $docob["id_article"];
        $this->id_type = $docob["id_type"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
