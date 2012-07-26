<?php

/**
 * Description of Rnr
 *
 * @author ronan.vignard
 * @copyright 2012-06-26
 * @version 1.0
 */
class Rnr {
    public $id_regional;
    public $nom;
    public $url_site;
    
    public function getRnrByIdRegional($id_regional){
        global $pdo;
        $sql = "SELECT * 
        FROM R_RNR_R52 
        WHERE id_regional = '$id_regional' ";
        try {
            $rnr = $pdo->query($sql)->fetch();          
            $this->id_regional = $rnr["id_regional"];
            $this->nom = $rnr["nom"];
            $this->url_site = $rnr["url_site"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
}

?>