<?php

/**
 * Description of Zsc
 *
 * @author ronan.vignard
 * @copyright 2012-06-26
 * @version 1.0
 */
class Zsc {
    public $id_regional;
    public $nom;
    
    /**
     * Sélectionne les données annexes d'une ZSC
     * @global type $pdo
     * @param string $id_regional 
     */
    public function getZscDataByIdRegional($id_regional) {
        global $pdo;
        $sql ="SELECT * 
        FROM R_ZSC_R52_data 
        WHERE id_regional = '$id_regional' ";
        try {
            $zsc = $pdo->query($sql)->fetch();          
            $this->id_regional = $zsc["id_regional"];
            $this->nom = $zsc["nom"];
            $this->dreal = $zsc["dreal"];
            $this->url_fiche = $zsc["url_fiche"];
            $this->url_docob = $zsc["url_docob"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
        
    }
}

?>