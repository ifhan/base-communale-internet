<?php

/**
 * Description of StationTemperature
 * Classe et fonctions concernant les stations "Température des cours d'eau"
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-08-01
 * @version 1.0
 */
class StationTemperature {
    
}

/**
 * Sélectionne l'ensemble des stations d'hydrotempérature 
 * en Pays de la Loire
 * @global string $pdo
 * @return array 
 */
function getStationsTemperatures() {
    global $pdo;
    $sql = "SELECT * 
    FROM R_STATIONS_HYDROTEMPERATURE_R52 
    ORDER BY id_dpt, id_station ";
    try {
        $query = $pdo->query($sql);
        $stations_temperature = $query->fetchAll();
        return $stations_temperature;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
