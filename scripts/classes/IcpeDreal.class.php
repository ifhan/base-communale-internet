<?php

/**
 * Description of IcpeDreal
 * Classe et fonctions concernant les ICPE A,E,S de la DREAL
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-09-01
 * @version 1.0
 */
class IcpeDreal {

    /**
     * Sélectionne une ICPE par son identifiant régional
     * @param string $id_regional Identifiant régional du site
     */
    public function getIcpeDrealByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_icpe_dreal_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];         
            $this->nom = $row["nom"];
            $this->id_commune = $row["id_commune"];
            $this->naf = $row["naf"];
            $this->lib_naf = $row["lib_naf"];
            $this->etat = $row["etat"];
            $this->regime = $row["regime"];
            $this->carriere = $row["carriere"];
            $this->seveso = $row["seveso"];
            $this->prioritaire = $row["prioritaire"];
            $this->enjeux = $row["enjeux"];
            $this->url_cedric = $row["url_cedric"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}