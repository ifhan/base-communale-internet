<?php

/**
 * Description of SiteClasseInscrit
 *
 * @author ronan.vignard
 * @copyright 2012-06-27
 * @version 1.0
 */
class SiteClasseInscrit {
    
    /**
     * Sélectionne les données annexes d'un site classé ou inscrit
     * @global type $pdo
     * @param string $id_regional 
     */
    public function getSiteClasseInscritDataByIdRegional($id_regional) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_SITE_CLASSE_INSCRIT_R52_data 
        WHERE id_regional = '$id_regional' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->commentaires = nl2br($row["commentaires"]);
            $this->sources = nl2br($row["sources"]);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }
}

/**
 * Sélectionne les entités d'un site à partir de son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getEntitesFromSiteByIdRegional($id_regional) {
    global $pdo;
    $table = "R_SITE_CLASSE_INSCRIT_R52";
    $table_2 = "R_SITE_CLASSE_INSCRIT_R52_data";
        
    $sql = "SELECT * 
    FROM $table, $table_2
    WHERE $table.id_regional = $id_regional 
    AND $table.id_regional = $table_2.id_regional
    GROUP BY $table.id_sp"; 
    try {
        $entites = $pdo->query($sql)->fetchAll();
        return $entites;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les photographies d'un site à partir de son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @param int $id_type
 * @return array 
 */
function getSiteClasseInscritPhotosByIdRegional($id_regional,$id_type) {
    global $pdo;
    $table = "R_SITE_CLASSE_INSCRIT_R52_photos";
    $table_2 = "R_SITE_CLASSE_INSCRIT_R52";
    $table_3 = "R_TYPE_ZONAGE_R52";

    $sql = "SELECT * 
    FROM $table, $table_2, $table_3
    WHERE $table.id_regional = '$id_regional'
    AND $table.id_regional = $table_2.id_regional
    AND $table_3.id_type = $id_type ";
    try {
        $site_photos = $pdo->query($sql)->fetchAll();
        return $site_photos;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des sites classés et inscrit de la région
 * @global string $pdo
 * @return array 
 */
function getSitesClassesInscrits() {
    global $pdo;
    $sql = "SELECT * 
    FROM R_SITE_CLASSE_INSCRIT_R52 
    GROUP BY id_regional 
    ORDER BY id_regional";
    try {
            $sites_classes_inscrits = $pdo->query($sql)->fetchAll();
            return $sites_classes_inscrits;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }   
}    
    
?>