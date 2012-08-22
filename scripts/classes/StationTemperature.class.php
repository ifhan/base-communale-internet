<?php

/**
 * Description of StationTemperature
 * Classe et fonctions concernant les stations "Température des cours d'eau"
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-08-01
 * @version 1.0
 */
class StationTemperature {
    /**
     * Sélectionne une station "Hydrotempérature" par son identifiant
     * @global string $pdo
     * @param string $id_station 
     */
    public function getStationTemperatureByIdStation($id_station) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_STATIONS_HYDROTEMPERATURE_R52 
        WHERE id_station = '$id_station' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_station = $row["id_station"];
            $this->riviere = stripslashes($row["riviere"]);
            $this->commune = $row["commune"];
            $this->id_commune = $row["id_commune"];
            $this->localite = $row["localite"];
            $this->en_service = date("d/m/Y", strtotime($row["en_service"]));
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
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
