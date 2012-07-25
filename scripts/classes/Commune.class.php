<?php

/**
 * Description of Commune
 *
 * @author ronan.vignard
 * @copyright 2012-06-13
 * @version 0.1
 */

class Commune {
    public $id_commune;
    public $id_departement;
    public $nom_commune;
    public $communes;
    
    /**
     * Sélectionne l'ensemble des communes d'un département
     * @global type $pdo
     * @param string $id_dpt
     * @return array 
     */
    public function getCommunesByIdDepartement($id_dpt) {   
        global $pdo;
        $sql = "SELECT *
        FROM admin_communes 
        WHERE id_departement = '$id_dpt' 
        ORDER BY nom_commune";
        try {
            $query = $pdo->query($sql);
            $communes = $query->fetchAll();
            return $communes;
            
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne une commune par son code géographique
     * @global type $pdo
     * @param string $id_commune  
     */
    public function getCommuneById($id_commune) {
        global $pdo;
        $sql = "SELECT * 
        FROM admin_communes 
        WHERE id_commune = '$id_commune' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_commune  = $row['id_commune'];
            $this->nom_commune = $row['nom_commune'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Liste les communes d'un département à partir de son identifiant
 * @global type $pdo connexion à la base de données
 * @param type $id_dpt identifiant du département
 * @return type renvoie un array des communes du département sélectionné
 */
function getCommunesByIdDpt($id_dpt) {
    global $pdo;
    $sql = "SELECT *
        FROM admin_communes
        WHERE id_departement = '$id_dpt' 
        ORDER BY nom_commune";
    try {
        $query = $pdo->query($sql);
        $communes = $query->fetchAll();
        return $communes;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne le(s) commune(s) d'un zonage par son identifiant régional
 * @global type $pdo
 * @param string $id_regional
 * @return array 
 */
function getCommunesByIdRegional($id_regional,$id_type) {
        global $pdo;
        $table = "local_zonages_communes";
        $table_2 = "admin_communes";
        
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_regional = '$id_regional'
        AND $table.id_commune = $table_2.id_commune 
        AND $table.id_type = $id_type 
        GROUP BY $table_2.id_commune
        ORDER BY $table_2.id_commune";
        try {
            $communes = $pdo->query($sql)->fetchAll();
            return $communes;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }

?>