<?php

/**
 * Description of Unesco
 * Classe et fonctions concernant les sites insctits au Patrimoine Mondial
 * de l'UNESCO
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-26
 * @version 1.0
 */
class Unesco {
    public $id_regional;
    public $id_bien;
    public $nom;
    public $url_site;
    
    public function getUnescoByIdRegional($id_regional){
        global $pdo;
        $sql = "SELECT * 
        FROM R_UNESCO_049
        WHERE id_regional = '$id_regional' ";
        try {
            $unesco = $pdo->query($sql)->fetch();          
            $this->id_regional = $unesco["id_regional"];
            $this->id_bien = $unesco["id_bien"];
            $this->nom = $unesco["nom"];
            $this->url_site = $unesco["url_site"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
}

?>