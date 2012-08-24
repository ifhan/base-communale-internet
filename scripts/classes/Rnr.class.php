<?php

/**
 * Description of Rnr
 * Classe et fonctions concernant les Réserves Naturelles Régionales (RNR)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-26
 * @version 1.0
 */
class Rnr {

    /**
     * Sélectionne une RNR par son identifiant régional
     * @global string $pdo
     * @param int $id_regional 
     */
    public function getRnrByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = "SELECT * 
        FROM R_RNR_R52 
        WHERE id_regional = '$id_regional' ";
        try {
            $rnr = $pdo->query($sql)->fetch();
            $this->id_regional = $rnr["id_regional"];
            $this->nom = $rnr["nom"];
            $this->url_site = $rnr["url_site"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

?>
