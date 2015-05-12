<?php

/**
 * Description of Scot
 * Classe et fonctions concernant les Schémas de COhérence Territoriale (SCOT)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-05-11
 * @version 1.5
 */
class Scot {
    
    /**
     * Sélectionne un SCoT par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getScotByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
            FROM n_scot_zsup_r52
            LEFT JOIN n_scot_etat_document_type 
            ON n_scot_zsup_r52.ETAT = n_scot_etat_document_type.CODE
            LEFT JOIN n_scot_etat_procedure_type 
            ON n_scot_zsup_r52.TYPE_PROCEDURE = n_scot_etat_procedure_type.CODE
            LEFT JOIN n_scot_decision_type 
            ON n_scot_zsup_r52.DECISION_ARRETE = n_scot_decision_type.CODE
            LEFT JOIN n_intercommunalite_000
            ON n_scot_zsup_r52.SIREN = n_intercommunalite_000.SIREN
            LEFT JOIN bdc_departement_52
            ON n_scot_zsup_r52.DEP_RESPONSABLE = bdc_departement_52.id_departement
            WHERE n_scot_zsup_r52.id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 5);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];
            $this->nom = $row["nom"];
            $this->ETAT = $row["LIBELLE_ETAT"];
            $this->TYPE_PROCEDURE = $row["LIBELLE_TYPE_PROCEDURE"];
            $this->DATE_ARRETE_PERIMETRE = date("d/m/Y", strtotime($row['DATE_ARRETE_PERIMETRE']));
            $this->DATE_ENGAGEMENT = date("d/m/Y", strtotime($row['DATE_ENGAGEMENT']));
            $this->REF_ARRETE_PERIMETRE = $row["REF_ARRETE_PERIMETRE"];
            $this->DECISION_ARRETE = $row["LIBELLE_DECISION_ARRETE"];
            $this->DATE_ARRET_PROJET = date("d/m/Y", strtotime($row['DATE_ARRET_PROJET']));
            $this->DATE_APPROBATION = date("d/m/Y", strtotime($row['DATE_APPROBATION']));
            $this->NB_COMMUNE = $row["NB_COMMUNE"];
            $this->SIREN = $row["NOM_GROUPEMENT"];
            $this->DEP_RESPONSABLE = $row["nom_departement"];
            $this->ID_SCHEMA = $row["ID_SCHEMA"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne le(s) commune(s) d'un SCOT par son identifiant
 * @param int $id_scot Identifiant du SCoT
 * @return array 
 */
function getCommunesScotByIdScot($id_scot) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM bdc_commune_52, r_scot_communes_r52
    WHERE r_scot_communes_r52.id_scot = :id_scot
    AND bdc_commune_52.id_commune = r_scot_communes_r52.id_commune
    GROUP BY bdc_commune_52.id_commune 
    ORDER BY bdc_commune_52.id_commune');
    $sql->bindParam(':id_scot', $id_scot, PDO::PARAM_STR, 5);
    try {
        $sql->execute();
        $communes = $sql->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les SCoT d'un département
 * @param int $id_dpt Identifiant d'un département
 * @return array 
 */
function getScotsByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM n_scot_zsup_r52, r_scot_departements_r52
    WHERE r_scot_departements_r52.id_departement = :id_dpt 
    AND n_scot_zsup_r52.id_regional = r_scot_departements_r52.id_scot
    GROUP BY nom
    ORDER BY nom');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $array_scot = $sql->fetchAll();
        return $array_scot;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
