<?php

/**
 * Description of CoursEau
 * Classe et fonctions concernant les cours d'eau
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-08-02
 * @version 1.0
 */
class CoursEau {

    /**
     * Sélectionne une rivière par son identifiant
     * @global string $pdo Connexion à la base de données
     * @param int $id_riviere Identifiant de la rivière
     */
    public function getRiviereByIdRiviere($id_riviere) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_RIVIERE_QUALITE_R52 
        WHERE id_riviere = :id_riviere');
        $sql->bindParam(':id_riviere', $id_riviere, PDO::PARAM_INT, 2);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->nom_riviere = stripslashes($row["nom_riviere"]);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne une rivière par un identifiant de station
     * @global string $pdo Connexion à la base de données
     * @param string $id_regional Identifiant de la station
     */
    public function getRiviereByIdStation($id_station) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_STATION_HYDROTEMPERATURE_R52 
        WHERE id_station = :id_station');
        $sql->bindParam(':id_station', $id_station, PDO::PARAM_STR, 9);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->riviere = stripslashes($row["riviere"]);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les rivières comportant des stations "Qualité des eaux"
 * relevant de la DREAL Pays de la Loire par département
 * @global string $pdo Connexion à la base de données
 * @param int $id_dpt Identifiant du département
 * @return array 
 */
function getRivieresQualiteByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();    
    if ($id_dpt != 0):
        $sql = $pdo->prepare('SELECT *
        FROM R_RIVIERE_QUALITE_R52, R_RIVIERES_DEPARTEMENTS_QUALITE_R52
        WHERE R_RIVIERES_DEPARTEMENTS_QUALITE_R52.id_departement = :id_dpt
        AND R_RIVIERE_QUALITE_R52.id_riviere = 
        R_RIVIERES_DEPARTEMENTS_QUALITE_R52.id_riviere 
        ORDER BY R_RIVIERE_QUALITE_R52.id_riviere');
        $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    else:
        $sql = $pdo->prepare('SELECT * 
        FROM R_RIVIERE_QUALITE_R52, R_RIVIERES_DEPARTEMENTS_QUALITE_R52
        WHERE R_RIVIERE_QUALITE_R52.id_riviere = 
        R_RIVIERES_DEPARTEMENTS_QUALITE_R52.id_riviere 
        GROUP BY R_RIVIERE_QUALITE_R52.nom_riviere 
        ORDER BY R_RIVIERE_QUALITE_R52.id_riviere');
    endif;
    $sql->execute();
    try {
        $rivieres = $sql->fetchAll();
        return $rivieres;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
