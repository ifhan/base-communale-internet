<?php

/**
 * Description of Epci
 * Classe et fonctions concernant les Établissements Publics de
 * Coopération Intercommunale
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-30
 * @version 1.0
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
        $table = "BDC_COMMUNE_52";
        $table_2 = "R_EPCI_COMMUNES_R52";
        
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
