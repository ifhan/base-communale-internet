<?php

/**
 * Description of SiteInpg
 * Classe et fonctions concernant les sites préselectionés et proposés
 * pour l'INPG
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-08-22
 * @version 1.0
 */
class SiteInpg {
    
    /**
     * Sélectionne un site INPG préselectionné par son identifiant régional
     * @global type $pdo Connexion à la base de données
     * @param type $id_regional Identifiant régional du site
     */
    public function getSiteInpgPreselectionneByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM R_SITE_PRESELECTIONNE_INPG_R52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        $sql->execute();
        try {
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
     * @global type $pdo Connexion à la base de données
     * @param type $id_regional Identifiant régional du site
     */
    public function getSiteInpgProposeByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM R_SITE_PROPOSE_INPG_R52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        $sql->execute();
        try {
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
