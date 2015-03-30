<?php

/**
 * Description of AncienTitreMinier
 * Classe et fonctions concernant les titres miniers dont l'activité a cessé
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-25
 * @version 1.0
 */
class AncienTitreMinier {

    /**
     * Sélectionne un titre minier par son identifiant régional
     * @param string $id_regional Identifiant régional du titre
     */
    public function getAncienTitreMinierByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_ancien_titre_minier_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->nom_titre = $row["nom_titre"];
            $this->nature = $row["nature"];
            $this->octroi = $row["octroi"];
            $this->peremption = $row["peremption"];            
            $this->statut = $row["statut"];
            $this->precision = $row["PRECISION"];
            $this->titulaire = $row["titulaire"];
            $this->substance_1 = $row["substance_1"];
            $this->substance_2 = $row["substance_2"];
            $this->substance_3 = $row["substance_3"];
            $this->installation_traitement = $row["installation_traitement"];
            $this->installation_securite = $row["installation_securite"];
            $this->tonnage_extrait = $row["tonnage_extrait"];
            $this->tonnage_tout_venant = $row["tonnage_tout_venant"];
            $this->tonnage_metal = $row["tonnage_metal"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}