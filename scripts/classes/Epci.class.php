<?php

/**
 * Description of Epci
 *
 * @author ronan.vignard
 */
class Epci {
    //put your code here
}

/**
 * Sélectionne les communes d'un EPCI par son identifiant
 * @global type $pdo
 * @param string $id_regional
 * @return array 
 */
function getCommunesEpciByIdEpci($id_epci) {
        global $pdo;
        $table = "admin_communes";
        $table_2 = "admin_epci_communes";
        
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table_2.id_epci = $id_epci
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
