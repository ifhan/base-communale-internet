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
    FROM BDC_COMMUNE_52, R_SCOT_COMMUNES_R52
    WHERE R_SCOT_COMMUNES_R52.id_scot = :id_scot
    AND BDC_COMMUNE_52.id_commune = R_SCOT_COMMUNES_R52.id_commune
    GROUP BY BDC_COMMUNE_52.id_commune 
    ORDER BY BDC_COMMUNE_52.id_commune');
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
    $sql = $pdo->prepare('SELECT * FROM R_SCOT_R52
    WHERE id_departement = :id_dpt 
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
