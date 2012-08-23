<?php

/**
 * Description of Apb
 * Classe et fonctions concernant les Arrêtés de Protection de Biotope (APB)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-13
 * @version 1.0
 */
class Apb {

    /**
     * Sélectionne un APB par son identifiant régional
     * @global string $pdo Connexion à la base de données
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getApbByIdRegional($id_regional) {
        global $pdo;
        $sql = $pdo->prepare('SELECT * 
        FROM R_APB_R52, R_APB_R52_data
        WHERE R_APB_R52.id_regional = :id_regional
        AND R_APB_R52.id_regional = R_APB_R52_data.id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_regional = $row['id_regional'];
            $this->id_national = $row['id_national'];
            $this->nom = $row['nom'];
            $this->code_arrete = $row['code_arrete'];
            $this->date = date("d/m/Y", strtotime($row['date']));
            $this->commentaire_arrete = $row['commentaire_arrete'];
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
