<?php

/**
 * Description of Pnr
 * Classe et fonctions concernant les Parcs Naturels Régionaux (PNR)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-26
 * @version 1.0
 */
class Pnr {

    /**
     * Sélectionne un PNR par son identifiant régional
     * @global string $pdo
     * @param string $id_regional 
     */
    public function getPnrByIdRegional($id_regional) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_PNR_R52 
        WHERE id_regional = '$id_regional' ";
        try {
            $pnr = $pdo->query($sql)->fetch();
            $this->id_regional = $pnr["id_regional"];
            $this->nom = $pnr["nom"];
            $this->url_site = $pnr["url_site"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

?>
