<?php

/**
 * Description of Rnr
 * Classe et fonctions concernant les Réserves Naturelles Régionales (RNR)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-03
 * @version 1.1
 */
class Rnr {

    /**
     * Sélectionne une RNR par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getRnrByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_rnr_r52 
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 5);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->url_site = $row["url_site"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
