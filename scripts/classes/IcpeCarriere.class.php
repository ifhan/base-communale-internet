<?php

/**
 * Description of IcpeCarriere
 * Classe et fonctions concernant les carrières
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-06-11
 * @version 1.1
 */
class IcpeCarriere {

    /**
     * Sélectionne une carrière par son identifiant régional
     * @param string $id_regional Identifiant régional du site
     */
    public function getIcpeCarriereByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_icpe_carriere_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];        
            $this->nom = $row["nom"];
            $this->id_commune = $row["id_commune"];
            $this->libelle_service = $row["libelle_service"];
            $this->naf = $row["naf"];
            $this->lib_naf = $row["lib_naf"];
            $this->etat = $row["etat"];
            $this->regime = $row["regime"];
            $this->carriere = $row["carriere"];
            $this->seveso = $row["seveso"];
            $this->iet_mtd = $row["iet_mtd"];
            $this->prioritaire = $row["prioritaire"];
            $this->enjeux = $row["enjeux"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}