<?php
/**
 * Description of Departement
 *
 * @author ronan.vignard
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
        FROM admin_departements 
        WHERE id_departement = '$id_dpt' ";
        try {
            $row = $pdo->query($sql)->fetch();          
            $this->id_dpt = $row["id_departement"];
            $this->nom_dpt = $row["nom_departement"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
    
    /**
     * Sélectionne le département d'un zonage par son identifiant régional
     * @global type $pdo
     * @param string $id_regional 
     * @param int $id_type
     */
    public function getDepartementByIdRegional($id_regional,$id_type) {
        global $pdo;
        $table = "local_zonages_communes";
        $table_2 = "admin_departements";
        
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
        } catch(PDOException $e) {
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
        $table = "local_zonages_communes";
        $table_2 = "admin_communes";
        $table_3 = "admin_departements";
        
        $sql = "SELECT * 
        FROM $table, $table_2, $table_3 
        WHERE $table.id_regional='$id_regional' 
        AND $table.id_commune = $table_2.id_commune
        AND $table_2.id_departement = $table_3.id_departement
        GROUP BY $table_3.id_departement";
        try {
            $departements = $pdo->query($sql)->fetchAll();
            return $departements;
        } catch(PDOException $e) {
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
    FROM admin_departements 
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