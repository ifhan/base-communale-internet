<?php

/**
 * Description of Scot
 * Classe et fonctions concernant les Schémas de COhérence Territoriale (SCOT)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-0-30
 * @version 1.0
 */
class Scot {
    //put your code here
}

/**
 * Sélectionne le(s) commune(s) d'un SCOT par son identifiant
 * @global type $pdo
 * @param string $id_regional
 * @return array 
 */
function getCommunesScotByIdScot($id_scot) {
    global $pdo;
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

?>
