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
    public function getSiteClasseInscritData($id_regional) {
        global $pdo;
        $sql="SELECT * 
        FROM R_SITE_CLASSE_INSCRIT_R52_data 
        WHERE id_regional = $id_regional "; 
        try {
            $siteclasseinscrit = $pdo->query($sql)->fetch();          
            $this->id_regional = $siteclasseinscrit["id_regional"];
            $this->id_national = $siteclasseinscrit["id_national"];
            $this->nom = $siteclasseinscrit["nom"];
            $this->id_dpt = $siteclasseinscrit["id_dpt"];
            $this->type_site = $siteclasseinscrit["type_site"];
            $this->id_site = $siteclasseinscrit["id_site"];
            $this->id_entite = $siteclasseinscrit["id_entite"];
            $this->url_texte = $siteclasseinscrit["url_texte"];
            $this->texte_protection = $siteclasseinscrit["texte_protection"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }
    
    /**
     * Sélectionne les photographies d'un site classé ou inscrit
     * @global type $pdo
     * @param string $id_regional
     * @param int $id_type 
     */
    public function getSiteClasseInscritPhotos($id_regional,$id_type) {
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
            $site_classe_inscrit = $pdo->query($sql)->fetch();          
            $this->id_regional = $site_classe_inscrit["id_regional"];
            $this->id_national = $site_classe_inscrit["id_national"];
            $this->nom = $site_classe_inscrit["nom"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }
}

?>
