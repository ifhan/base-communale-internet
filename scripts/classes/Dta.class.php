<?php

/**
 * Description of Dta
 *
 * @author ronan.vignard
 * @copyright 2012-06-26
 * @version 1.0
 */
class Dta {
    public $id_regional;
    public $nom;
    public $url_site;
    
    public function getDtaByIdRegional($id_regional){
        global $pdo;
        $sql = "SELECT *
        FROM R_DTA_R52
        WHERE id_regional = '$id_regional' ";
        try {
            $dta = $pdo->query($sql)->fetch();          
            $this->id_regional = $dta["id_regional"];
            $this->nom = $dta["nom"];
            $this->url_site = $dta["url_site"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
}

?>
