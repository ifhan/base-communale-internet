<?php

/**
 * Description of Departement
 * Classe et fonctions concernant les départements
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-21
 * @version 1.0
 */
class Departement {

    /**
     * Sélectionne un département par son code
     * @param int $id_dpt Identifiant du département
     */
    public function getDepartementByIdDpt($id_dpt) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM BDC_DEPARTEMENT_52 
        WHERE id_departement = :id_dpt');
        $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_dpt = $row["id_departement"];
            $this->nom_dpt = $row["nom_departement"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne le département d'un zonage par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     * @param int $id_type Identifiant du type de zonage
     */
    public function getDepartementByIdRegional($id_regional, $id_type) {
        $pdo = ConnectionFactory::getFactory()->getConnection();        
        $sql = $pdo->prepare('SELECT * 
        FROM r_zonages_communes_r52, BDC_DEPARTEMENT_52
        WHERE r_zonages_communes_r52.id_regional = :id_regional
        AND r_zonages_communes_r52.id_type = :id_type
        AND r_zonages_communes_r52.id_departement = 
        BDC_DEPARTEMENT_52.id_departement 
        GROUP BY BDC_DEPARTEMENT_52.id_departement');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
        $sql->bindParam(':id_type', $id_type, PDO::PARAM_STR, 3);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_departement = $row["id_departement"];
            $this->nom_departement = $row["nom_departement"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne le(s) département(s) d'un zonage par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getDepartementsByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM r_zonages_communes_r52, BDC_COMMUNE_52, BDC_DEPARTEMENT_52
    WHERE r_zonages_communes_r52.id_regional = :id_regional
    AND r_zonages_communes_r52.id_commune = BDC_COMMUNE_52.id_commune
    AND BDC_COMMUNE_52.id_departement = BDC_DEPARTEMENT_52.id_departement
    GROUP BY BDC_DEPARTEMENT_52.id_departement');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $departements = $sql->fetchAll();
        return $departements;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection les départements d'une région par son identifiant
 * @param int $id_region Identifiant de la région
 * @return array 
 */
function getDepartementsByIdRegion($id_region) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM BDC_DEPARTEMENT_52 
    WHERE id_region = :id_region
    ORDER BY nom_departement');
    $sql->bindParam(':id_region', $id_region, PDO::PARAM_INT, 4);
    try {
        $sql->execute();
        $departements = $sql->fetchAll();
        return $departements;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les départements comportant des stations "Qualité des eaux"
 * relevant de la DREAL Pays de la Loire
 * @return array 
 */
function getDepartementsStationsQualiteByIdRegion() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM BDC_DEPARTEMENT_52 
    WHERE id_region = 18 
    OR id_departement = 61
    OR id_departement = 79 
    ORDER BY id_departement');
    try {
        $sql->execute();
        $departements = $sql->fetchAll();
        return $departements;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
