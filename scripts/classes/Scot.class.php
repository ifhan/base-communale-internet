<?php

/**
 * Description of Scot
 * Classe et fonctions concernant les Schémas de COhérence Territoriale (SCOT)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-0-30
 * @version 1.0
 */
class Scot {

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
    $sql->bindParam(':id_scot', $id_scot, PDO::PARAM_STR, 2);
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
    AND n_scot_zsup_r52.id_scot = r_scot_departements_r52.id_scot
    ORDER BY nom_scot');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $array_scot = $sql->fetchAll();
        return $array_scot;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
