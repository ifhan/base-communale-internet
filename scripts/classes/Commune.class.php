<?php

/**
 * Description of Commune
 * Classe et fonction concernant les commuens
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-13
 * @version 1.0
 */
class Commune {

    /**
     * Sélectionne une commune par son code géographique
     * @global string $pdo Connexion à la base de données
     * @param string $id_commune Code géographique de la commune
     */
    public function getCommuneById($id_commune) {
        global $pdo;
        $sql = $pdo->prepare('SELECT * 
        FROM BDC_COMMUNE_52 
        WHERE id_commune = :id_commune');
        $sql->bindParam(':id_commune', $id_commune, PDO::PARAM_STR, 10);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_commune = $row['id_commune'];
            $this->nom_commune = $row['nom_commune'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les communes d'un département à partir de son identifiant
 * @global string $pdo Connexion à la base de données
 * @param int $id_dpt Identifiant du département
 * @return string
 */
function getCommunesByIdDpt($id_dpt) {
    global $pdo;
    $sql = $pdo->prepare('SELECT *
    FROM BDC_COMMUNE_52 
    WHERE id_departement = :id_dpt
    ORDER BY nom_commune');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    $sql->execute();
    try {
        $communes = $sql->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne le(s) commune(s) d'un zonage par son identifiant régional
 * @global string $pdo Connexion à la base de données
 * @param string $id_regional Identifiant régional du zonage
 * @param type $id_type Identifiant du type de zonage
 * @return array 
 */
function getCommunesByIdRegional($id_regional, $id_type) {
    global $pdo;
    $sql = $pdo->prepare('SELECT * 
    FROM R_ZONAGES_COMMUNES_R52, BDC_COMMUNE_52
    WHERE R_ZONAGES_COMMUNES_R52.id_regional = :id_regional
    AND R_ZONAGES_COMMUNES_R52.id_commune = BDC_COMMUNE_52.id_commune 
    AND R_ZONAGES_COMMUNES_R52.id_type = :id_type
    GROUP BY BDC_COMMUNE_52.id_commune
    ORDER BY BDC_COMMUNE_52.id_commune');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    $sql->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    $sql->execute();
    try {
        $communes = $sql->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les communes comportant des stations "Qualité des eaux"
 * relevant de la DREAL Pays de la Loire par département
 * @global string $pdo Connexion à la base de données
 * @param int $id_dpt Identifiant du département
 * @return array 
 */
function getCommunesStationsQualiteByIdDpt($id_dpt) {
    global $pdo;
    $sql = $pdo->prepare('SELECT BDC_COMMUNE_52.id_commune, 
        BDC_COMMUNE_52.nom_commune, R_STATION_QUALITE_RCS_R52.id_commune 
    FROM BDC_COMMUNE_52, R_STATION_QUALITE_RCS_R52
    WHERE BDC_COMMUNE_52.id_departement = :id_dpt
    AND BDC_COMMUNE_52.id_commune = R_STATION_QUALITE_RCS_R52.id_commune 
    GROUP BY BDC_COMMUNE_52.nom_commune
    ORDER BY BDC_COMMUNE_52.nom_commune');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_INT, 2);
    $sql->execute();
    try {
        $communes = $sql->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
