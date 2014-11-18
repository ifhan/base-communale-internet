<?php

/**
 * Description of Apb
 * Classe et fonctions concernant les Aires de Protection de Biotope (APB)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2014-11-14
 * @version 1.1
 */
class Apb {

    /**
     * Sélectionne un APB par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getApbByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM r_apb_r52, r_apb_r52_data
        WHERE r_apb_r52.id_regional = :id_regional
        AND r_apb_r52.id_regional = r_apb_r52_data.id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row['id_regional'];
            $this->id_national = $row['id_national'];
            $this->nom = $row['nom'];
            $this->date_creation = date("d/m/Y", strtotime($row['date_creation']));
            $this->date_modif = date("d/m/Y", strtotime($row['date_modif']));
            $this->arrete_creation = $row['arrete_creation'];            
            $this->arrete_modif = $row['arrete_modif'];
            $this->surf_sig_l93 = $row['surf_sig_l93'];
            $this->parcelles = nl2br($row['parcelles']);
            $this->statut_foncier = nl2br($row['statut_foncier']);
            $this->interet_bio = nl2br($row['interet_bio']);
            $this->effets_protection = nl2br($row['effets_protection']);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
