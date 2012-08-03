<?php

/**
 * Description of Zico
 * Classe et fonctions concernant les Zones Importantes pour la 
 * Conservation des Oiseaux (ZICO)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-24
 * @version 1.0
 */
class Zico {

    /**
     * Sélectionne une ZICO par son identifiant régional
     * @global string $pdo
     * @param string $id_regional 
     */
    public function getZicoByIdRegional($id_regional) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_ZICO_R52, R_ZICO_R52_data  
        WHERE R_ZICO_R52.id_regional = '$id_regional'
        AND R_ZICO_R52.id_regional = R_ZICO_R52_data.id_regional ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_regional = $row['id_regional'];
            $this->nom = $row['nom'];
            $this->annee_description = date("Y", strtotime($row['annee_description']));
            $this->date_maj = date("d/m/Y", strtotime($row['date_maj']));
            $this->altitude_min = $row['altitude_min'];
            $this->altitude_max = $row['altitude_max'];
            $this->surf_sig_l93 = $row['surf_sig_l93'];
            $this->informations_complementaires = nl2br($row['informations_complementaires']);
            $this->interet_milieu = nl2br($row['interet_milieu']);
            $this->protections_reglementaires = nl2br($row['protections_reglementaires']);
            $this->mesures_foncieres = nl2br($row['mesures_foncieres']);
            $this->mesures_gestion = nl2br($row['mesures_gestion']);
            $this->menaces = nl2br($row['menaces']);
            $this->sources = nl2br($row['sources']);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

?>