<?php

/**
 * Description of Apb
 * Classe et fonctions concernant les Aires de Protection de Biotope (APB)
 * en application du standard COVADIS ENP v1.0
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2014-03-07
 * @version 2.0
 */
class Apb {

    /**
     * Sélectionne un APB par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getApbByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM n_enp_apb_s_r52, R_APB_R52_data
        WHERE n_enp_apb_s_r52.ID_LOCAL = :id_regional
        AND n_enp_apb_s_r52.ID_LOCAL = R_APB_R52_data.id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row['ID_LOCAL'];
            $this->id_national = $row['ID_MNHN'];
            $this->nom = $row['NOM_SITE'];
            $this->date_creation = date("d/m/Y", strtotime($row['DATE_CREA']));
            $this->date_modif = date("d/m/Y", strtotime($row['date_modif']));
            $this->arrete_creation = $row['arrete_creation'];            
            $this->arrete_modif = $row['arrete_modif'];
            $this->surf_sig_l93 = $row['SURF_SIG'];
            $this->parcelles = nl2br($row['parcelles']);
            $this->statut_foncier = nl2br($row['statut_foncier']);
            $this->interet_bio = nl2br($row['interet_bio']);
            $this->effets_protection = nl2br($row['effets_protection']);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
