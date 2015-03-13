<?php

/**
 * Description of IcpeTar
 * Classe et fonctions concernant les tours aéro-réfrigérantes (TAR)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-10
 * @version 1.0
 */
class IcpeTar {

    /**
     * Sélectionne une tour aéro-réfriférante par son identifiant régional
     * @param string $id_regional Identifiant régional du site
     */
    public function getIcpeTarByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_icpe_tar_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->libelle = $row["libelle"];
            $this->etat = $row["etat"];
            $this->regime = $row["regime"];
            $this->enjeux = $row["enjeux"];
            $this->effectif = $row["effectif"];
            $this->naf = $row["naf"];
            $this->lib_naf = $row["lib_naf"];            
            $this->siret = $row["siret"];
            $this->id_commune = $row["id_commune"];
            $this->lib_service = $row["lib_service"];
            $this->commune = $row["commune"];
            $this->rubrique = $row["rubrique"];
            $this->alinea = $row["alinea"];
            $this->statut_tech = $row["statut_tech"];
            $this->regime_ic = $row["regime_ic"];
            $this->quantite = $row["quantite"];
            $this->unite = $row["unite"];
            $this->type_circuit = $row["type_circuit"];
            $this->puissance = $row["puissance"];
            $this->nb_tar = $row["nb_tar"];

        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}