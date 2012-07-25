<?php

/**
 * Description of Scot
 *
 * @author ronan.vignard
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
        $table = "admin_communes";
        $table_2 = "admin_scot_communes";
        
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table_2.id_scot = $id_scot
        AND $table.id_commune = $table_2.id_commune
        GROUP BY $table.id_commune 
        ORDER BY $table.id_commune";
        try {
            $communes = $pdo->query($sql)->fetchAll();
            return $communes;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
?>
