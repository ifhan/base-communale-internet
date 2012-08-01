<?php

/**
 * Description of StationQualite
 * Classe et fonctions concernant les stations "Qualité des eaux"
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-08-01
 * @version 1.0
 */
class StationQualite {
    //put your code here
}

/**
 * Sélectionne les stations "Qualité des eaux" par le code géographique du
 * département (ou sur l'ensemble de la région) et par l'identifiant du réseau 
 * (RCS ou RNB)
 * @global string $pdo
 * @param int $id_dpt
 * @param int $id_reseau
 * @return array 
 */
function getStationQualiteByIdDptByIdReseau($id_dpt,$id_reseau) {
    global $pdo;
    if($id_dpt!="0"):
        $sql = "SELECT * 
        FROM R_STATION_QUALITE_RCS_R52 
        WHERE id_reseau = $id_reseau 
        AND id_departement = $id_dpt 
        ORDER BY id_departement, id_station ";
    else:
        $sql = "SELECT * 
        FROM R_STATION_QUALITE_RCS_R52 
        WHERE id_reseau = $id_reseau 
        ORDER BY id_departement, id_station ";
    endif;
    try {
        $stations_qualite_rcs = $pdo->query($sql)->fetchAll();
        return $stations_qualite_rcs;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
