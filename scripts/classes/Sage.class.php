<?php

/**
 * Description of Sage
 *
 * @author ronan.vignard
 * @copyright 2012-07-24
 * @version 1.0
 */
class Sage {
    /**
     * Sélectionne un SAGE par son identifiant régional
     * @global string $pdo
     * @param string $id_regional 
     */    
    public function getSageByIdRegional($id_regional){
        global $pdo;
        $sql = "SELECT * 
        FROM R_SAGE_R52, R_SAGE_R52_data  
        WHERE R_SAGE_R52.id_regional = '$id_regional'
        AND R_SAGE_R52.id_regional = R_SAGE_R52_data.id_regional ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->avancement = $row['avancement'];
            $this->nom = $row['nom'];
            $this->referent_sema = $row['referent_sema'];
            $this->maitre_ouvrage = nl2br($row['maitre_ouvrage']);
            $this->president = nl2br($row['president']);
            $this->animateur = nl2br($row['animateur']);
            $this->adresse = nl2br($row['adresse']);
            $this->tel = nl2br($row['tel']);
            $this->fax = nl2br($row['fax']);
            $this->courriel = nl2br($row['courriel']);
            $this->enjeux = nl2br($row['sdage']);
            $this->bassin_versant = nl2br($row['bassin_versant']);
            $this->rivieres = nl2br($row['rivieres']);
            $this->nombre_departements = nl2br($row['nombre_departements']);
            $this->nombre_communes = nl2br($row['nombre_communes']);
            $this->population = nl2br($row['population']);
            $this->demandeur = nl2br($row['demandeur']);
            $this->comite_bassin = nl2br($row['comite_bassin']);
            $this->prefecture_pilote = nl2br($row['prefecture_pilote']);
            $this->arrete_perimetre = nl2br($row['arrete_perimetre']);
            $this->arrete_cle = nl2br($row['arrete_cle']);
            $this->installation_cle = nl2br($row['installation_cle']);
            $this->diagnostic = nl2br($row['diagnostic']);
            $this->enjeux_retenus = nl2br($row['enjeux_retenus']);
            $this->strategie = nl2br($row['strategie']);
            $this->validation = nl2br($row['validation']);
            $this->consultation = nl2br($row['consultation']);
            $this->date_comite_bassin = nl2br($row['date_comite_bassin']);
            $this->arrete_sage = nl2br($row['arrete_sage']);
            $this->url_site_web = nl2br($row['url_site_web']);
            $this->documents = nl2br($row['documents']);
            $this->priorites = nl2br($row['priorites']);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne la situation d'un SAGE par son identifiant
     * @global string $pdo
     * @param int $id_situation 
     */
    public function getSageSituationByIdSituation($id_situation) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_SAGE_SITUATION_R52 
        WHERE id_situation = $id_situation"; 
        try {
            $row = $pdo->query($sql)->fetch();
            $this->nom_situation = $row['nom_situation'];
            $this->code_couleur = $row['code_couleur'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

?>