<?php

/**
 * Description of Zonage
 *
 * @author ronan.vignard
 * @copyright 2012-06-15
 * @version 1.0
 */

class Zonage {
    public $id_regional;
    public $id_type;    
    public $nom;
    public $type;
    
    public function id_regional()
    {
        return $this->id_regional;
    }
    
    public function name()
    {
        return $this->nom;
    }
    
    public function type()
    {
        return $this->type;
    }
    
    /**
     * Sélectionne un type de zonage par son identifiant
     * @global type $pdo
     * @param int $id_type 
     */
    public function getTypeZonageByIdType($id_type) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql)->fetch();      
            $this->type  = $row['type'];
            $this->sigle  = $row['sigle'];
            $this->table = $row['table'];
            $this->path = $row['path'];
            $this->map = $row['map'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
        /**
     * Sélectionne un type de zonage puis un zonage
     * @global type $pdo
     * @param int $id_type
     * @param string $id_regional 
     */
    public function getZonageByIdRegional($id_type, $id_regional) {
        global $pdo;
        $sql_1 = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql_1)->fetch();
            $this->table = $row["table"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        try {
            $sql_2 = "SELECT * 
            FROM $this->table
            WHERE id_regional = '$id_regional' ";
            $row = $pdo->query($sql_2)->fetch();           
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne un type de zonage puis la table _data correspondante
     * @global type $pdo
     * @param int $id_type
     * @param string $id_regional 
     */
    public function getZonageDataById($id_type, $id_regional) {
        global $pdo;
        $sql_1 = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql_1)->fetch();
            $this->table = $row["table"];
            $table_data = $this->table."_data";
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        try {
            $sql_2 = "SELECT * 
            FROM $table_data 
            WHERE id_regional = '$id_regional' ";
            $row = $pdo->query($sql_2)->fetch();           
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->region = $row["region"];
            $this->url_fiche = $row["url_fiche"];
            $this->dreal = $row["dreal"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélection de l'ensemble des types de zonages
     * @global type $pdo 
     */
    public function getZonages() {
        global $pdo;
        $sql = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 ";
        try {
            $row = $pdo->query($sql)->fetch();
            
            $this->type  = $row['type'];
            $this->table = $row['table'];
            $this->path = $row['path'];
            $this->map = $row['map'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

/**
 * 
 * @global type $pdo
 * @param int $id_type Identifiant du type de zonage
 * @param int $id_dpt Identifiant du département
 * @return array 
 */
function getZonagesByIdTypeByIdDpt($id_type,$id_dpt) {
    global $pdo; 
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = "SELECT * 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = '$id_type'";
    try {       
        $row = $pdo->query($sql_1)->fetch();
        $table = $row["table"];
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour le département choisi 
     */
    $sql_2 = "SELECT * 
    FROM $table
    WHERE id_dpt = '$id_dpt' 
    GROUP BY id_regional 
    ORDER BY id_regional" ;
    try {
        $query = $pdo->query($sql_2);
        $zonages = $query->fetchAll();
        return $zonages;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 *
 * @global type $pdo
 * @param int $id_type Identifiant du type de zonage
 * @return string 
 */
function getZonagesByIdTypeByRegion($id_type) {
    global $pdo; 
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = "SELECT * 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = '$id_type'";
    try {       
        $row = $pdo->query($sql_1)->fetch();
        $table = $row["table"];
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour la région
     */
    $sql_2 = "SELECT * 
    FROM $table
    GROUP BY id_regional 
    ORDER BY id_regional" ;
    try {
        $query = $pdo->query($sql_2);
        $zonages = $query->fetchAll();
        return $zonages;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

?>