<?php

/**
 * Description of DecisionAe
 * Classe et fonctions concernant les Réserves Naturelles Régionales (RNR)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-05-04
 * @version 1.0
 */
class DecisionAe {

    /**
     * Sélectionne une décision par son identifiant régional
     * @param string $id_regional Identifiant régional du périmètre
     */
    public function getDecisionAeByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
            FROM r_consultations_cas_par_cas_r52, r_type_porteur_ae_r52 
            WHERE r_consultations_cas_par_cas_r52.id_regional = :id_regional
            AND r_consultations_cas_par_cas_r52.type_porteur = 
            r_type_porteur_ae_r52.id_porteur');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 12);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->type_porteur = $row["nom_porteur"];
            $this->date_decision = date("d/m/Y", strtotime($row['date_decision']));
            $this->url_garance = $row["url_garance"];
            $this->url_formulaire = $row["url_formulaire"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
