<?php

/**
 * Description of SiteInpg
 * Classe et fonctions concernant les sites présélectionnés et validés
 * pour l'INPG
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2016-03-16
 * @version 1.2
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
     * Sélectionne un site INPG validé par son identifiant régional
     * @param type $id_regional Identifiant régional du site
     */
    public function getSiteInpgValideByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_site_valide_inpg_r52
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
            $this->valid_cnpg = date("d/m/Y", strtotime($row['valid_cnpg']));
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
