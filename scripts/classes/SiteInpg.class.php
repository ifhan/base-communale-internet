<?php

/**
 * Description of SiteInpg
 * Classe et fonctions concernant les sites présélectionnés et proposés
 * pour l'INPG
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-03
 * @version 1.1
 */
class SiteInpg {
    
    /**
     * Sélectionne un site INPG préselectionné par son identifiant régional
     * @param type $id_regional Identifiant régional du site
     */
    public function getSiteInpgPreselectionneByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_site_preselectionne_inpg_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row['id_regional'];
            $this->nom = $row['nom'];
            $this->interet_principal = $row['interet_principal'];
            $this->interets_secondaires = $row['interets_secondaires'];
            $this->lieu_dit = $row['lieu_dit'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
   /**
     * Sélectionne un site INPG proposé par son identifiant régional
     * @param type $id_regional Identifiant régional du site
     */
    public function getSiteInpgProposeByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_site_propose_inpg_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row['id_regional'];
            $this->nom = $row['nom'];
            $this->typo_1 = $row['typo_1'];
            $this->typo_2 = $row['typo_2'];
            $this->typo_3 = $row['typo_3'];
            $this->confidentialite = $row['confidentialite'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
