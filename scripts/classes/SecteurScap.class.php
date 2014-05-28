<?php

/**
 * Description of SecteurScap
 * Classe et fonctions concernant les Secteurs retenus dans le cadre de la SCAP
 * (Stratégie de Création d'Aires Protégées)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2014-04-03
 * @version 1.0
 */
class SecteurScap {
    
    /**
     * Sélectionne un secteur SCAP retenu par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getSecteurScapByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM r_secteurs_scap_retenus_r52, r_secteurs_scap_occ_sol_r52, 
        r_secteurs_scap_protections_env_r52, r_secteurs_scap_pp_rpg_r52,
        r_secteurs_scap_roselieres_r52
        WHERE r_secteurs_scap_retenus_r52.id_regional = :id_regional
        AND r_secteurs_scap_retenus_r52.id_regional = r_secteurs_scap_occ_sol_r52.id_secteur_scap
        AND r_secteurs_scap_retenus_r52.id_regional = r_secteurs_scap_protections_env_r52.id_secteur_scap
        AND r_secteurs_scap_retenus_r52.id_regional = r_secteurs_scap_pp_rpg_r52.id_secteur_scap
        AND r_secteurs_scap_retenus_r52.id_regional = r_secteurs_scap_roselieres_r52.id_secteur_scap
        GROUP BY r_secteurs_scap_retenus_r52.id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 7);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row['id_regional'];
            $this->nom = $row['nom'];
            $this->surf_sig = $row['surf_sig'];
            $this->date_validation_csrpn = date("d/m/Y", strtotime($row['date_validation_csrpn']));    
            $this->localisation_geo = nl2br($row['localisation_geo']);
            $this->biodiversite = nl2br($row['biodiversite']);
            $this->menaces = nl2br($row['menaces']);
            $this->protection = nl2br($row['protection']);
            $this->commentaires = nl2br($row['commentaires']);
            $this->surf_marais_tourbieres = $row['surf_marais_tourbieres'];
            $this->surf_marais_salants = $row['surf_marais_salants'];
            $this->surf_prairies = $row['surf_prairies'];
            $this->surf_broussailles = $row['surf_broussailles'];
            $this->surf_sable_gravier = $row['surf_sable_gravier'];
            $this->surf_vigne_verger = $row['surf_vigne_verger'];
            $this->surf_rocher_eboulis = $row['surf_rocher_eboulis'];
            $this->surf_forets = $row['surf_forets'];
            $this->surf_eau_libre = $row['surf_eau_libre'];
            $this->surf_carrieres = $row['surf_carrieres'];
            $this->surf_bati = $row['surf_bati'];
            $this->surf_zones_activites = $row['surf_zones_activites'];
            $this->surf_pp_rpg = $row['surf_pp_rpg'];
            $this->surf_apb = $row['surf_apb'];
            $this->surf_rnr = $row['surf_rnr'];
            $this->surf_rnn = $row['surf_rnn'];
            $this->surf_rb = $row['surf_rb'];
            $this->surf_sc = $row['surf_sc'];
            $this->surf_znieff1 = $row['surf_znieff1'];
            $this->surf_znieff2 = $row['surf_znieff2'];
            $this->surf_srce = $row['surf_srce'];
            $this->surf_natura2000 = $row['surf_natura2000'];
            $this->surf_natura2000_sc = $row['surf_natura2000_sc'];
            $this->surf_ens_44_85 = $row['surf_ens_44_85'];
            $this->surf_celrl = $row['surf_celrl'];
            $this->surf_roseliere = $row['surf_roseliere'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

/**
 * Sélectionne les espaces SCAP présentes sur le secteur SCAP retenu 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getEspecesScapByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM r_secteurs_scap_sp_connues_r52, r_sp_scap_r52 
    WHERE r_secteurs_scap_sp_connues_r52.id_secteur_scap = :id_regional
    AND r_secteurs_scap_sp_connues_r52.id_taxref = r_sp_scap_r52.id_taxref
    AND r_secteurs_scap_sp_connues_r52.suppression = "N"
    GROUP BY r_secteurs_scap_sp_connues_r52.id_taxref
    ORDER BY r_secteurs_scap_sp_connues_r52.id_taxref');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 7);
    try {
        $sql->execute();
        $sp_connues = $sql->fetchAll();
        return $sp_connues;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
