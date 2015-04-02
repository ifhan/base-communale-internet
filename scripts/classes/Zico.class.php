<?php

/**
 * Description of Zico
 * Classe et fonctions concernant les Zones Importantes pour la 
 * Conservation des Oiseaux (ZICO)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-02
 * @version 1.1
 */
class Zico {

    /**
     * Sélectionne une ZICO par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getZicoByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_zico_r52, r_zico_r52_data  
        WHERE r_zico_r52.id_regional = :id_regional
        AND r_zico_r52.id_regional = r_zico_r52_data.id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
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