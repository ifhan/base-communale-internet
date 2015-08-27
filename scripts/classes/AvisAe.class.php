<?php

/**
 * Description of AvisAe
 * Classe et fonctions concernant les avis de l'autorité environnementale sur 
 * les projets soumis à étude d'impact
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-05-04
 * @version 1.0
 */
class AvisAe {

    /**
     * Sélectionne un avis par son identifiant régional
     * @param string $id_regional Identifiant régional de l'avis
     */
    public function getAvisAeByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
            FROM r_consultations_projets_ae_r52, r_type_porteur_ae_r52
            WHERE r_consultations_projets_ae_r52.id_regional = :id_regional
            AND r_consultations_projets_ae_r52.type_porteur = 
            r_type_porteur_ae_r52.id_porteur');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 12);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->type_porteur = $row["nom_porteur"];
            $this->date_avis = date("d/m/Y", strtotime($row['date_avis']));
            $this->url_garance = $row["url_garance"];
            $this->url_resume = $row["url_resume"];
            $this->url_lien_pub = $row["url_lien_pub"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
