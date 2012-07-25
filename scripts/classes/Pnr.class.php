<?php

/**
 * Description of Pnr
 *
 * @author ronan.vignard
 * @copyright 2012-06-26
 * @version 1.0
 */
class Pnr {
    public $id_regional;
    public $nom;
    public $url_site;
    
    public function getPnrByIdRegional($id_regional){
        global $pdo;
        $sql = "SELECT * 
        FROM R_PNR_R52 
        WHERE id_regional = '$id_regional' ";
        try {
            $pnr = $pdo->query($sql)->fetch();          
            $this->id_regional = $pnr["id_regional"];
            $this->nom = $pnr["nom"];
            $this->url_site = $pnr["url_site"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
}

?>
