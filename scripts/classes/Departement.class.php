<?php

/**
 * Description of Departement
 * Classe et fonctions concernant les départements
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-21
 * @version 1.0
 */
class Departement {

    public $id_departement;
    public $nom_departement;

    /**
     * Sélectionne un département par son code
     * @global type $pdo
     * @param int $id_dpt 
     */
    public function getDepartementById($id_dpt) {
        global $pdo;
        $sql = "SELECT * 
        FROM BDC_DEPARTEMENT_52 
        WHERE id_departement = '$id_dpt' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_dpt = $row["id_departement"];
            $this->nom_dpt = $row["nom_departement"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne le département d'un zonage par son identifiant régional
     * @global type $pdo
     * @param string $id_regional 
     * @param int $id_type
     */
    public function getDepartementByIdRegional($id_regional, $id_type) {
        global $pdo;
        $table = "R_ZONAGES_COMMUNES_R52";
        $table_2 = "BDC_DEPARTEMENT_52";

        $sql = "SELECT * 
        FROM $table, $table_2
        WHERE $table.id_regional = '$id_regional' 
        AND $table.id_type = '$id_type' 
        AND $table.id_departement = $table_2.id_departement 
        GROUP BY $table_2.id_departement ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_departement = $row["id_departement"];
            $this->nom_departement = $row["nom_departement"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne le(s) département(s) d'un zonage par son identifiant régional
 * @global type $pdo
 * @param string $id_regional
 * @return array 
 */
function getDepartementsByIdRegional($id_regional) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "BDC_COMMUNE_52";
    $table_3 = "BDC_DEPARTEMENT_52";

    $sql = "SELECT * 
        FROM $table, $table_2, $table_3 
        WHERE $table.id_regional='$id_regional' 
        AND $table.id_commune = $table_2.id_commune
        AND $table_2.id_departement = $table_3.id_departement
        GROUP BY $table_3.id_departement";
    try {
        $departements = $pdo->query($sql)->fetchAll();
        return $departements;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des départements de la région Pays de la Loire 
 * par l'identifiant de la région
 * @global type $pdo
 * @return array 
 */
function getDepartementByRegion() {
    global $pdo;
    $sql = "SELECT * 
    FROM BDC_DEPARTEMENT_52 
    WHERE id_region = 18 
    ORDER BY nom_departement";
    try {
        $departements = $pdo->query($sql)->fetchAll();
        return $departements;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>