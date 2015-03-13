<?php

/**
 * Description of Icpe
 * Classe et fonctions concernant les ICPE
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-10
 * @version 1.0
 */
class Icpe {

    /**
     * Sélectionne une ICPE par son identifiant régional
     * @param string $id_regional Identifiant régional du site
     */
    public function getIcpeByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_icpe_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->siret = $row["siret"];
            $this->id_commune = $row["id_commune"];
            $this->lib_service = $row["lib_service"];
            $this->naf = $row["naf"];
            $this->lib_naf = $row["lib_naf"];
            $this->etat = $row["etat"];
            $this->regime = $row["regime"];
            $this->carriere = $row["carriere"];
            $this->seveso = $row["seveso"];
            $this->iet_mtd = $row["iet_mtd"];
            $this->prioritaire = $row["prioritaire"];
            $this->enjeux = $row["enjeux"];
            $this->effectif = $row["effectif"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}