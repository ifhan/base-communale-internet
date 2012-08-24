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
 * @global type $pdo Connexion à la base de données
 * @param int $id_scot Identifiant du SCoT
 * @return array 
 */
function getCommunesScotByIdScot($id_scot) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "BDC_COMMUNE_52";
    $table_2 = "R_SCOT_COMMUNES_R52";

    $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table_2.id_scot = $id_scot
        AND $table.id_commune = $table_2.id_commune
        GROUP BY $table.id_commune 
        ORDER BY $table.id_commune";
    try {
        $communes = $pdo->query($sql)->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les SCoT d'un département
 * @global string $pdo Connexion à la base de données
 * @param int $id_dpt Identifiant d'un département
 * @return array 
 */
function getScotsByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = "SELECT * 
    FROM R_SCOT_R52
    WHERE id_departement = $id_dpt 
    ORDER BY nom_scot";
    try {
        $array_scot = $pdo->query($sql)->fetchAll();
        return $array_scot;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
