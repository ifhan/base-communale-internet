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
     * @param string $code_hydro Identifiant de la station
     */
    public function getStationTemperatureByIdStation($code_hydro) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_station_hydrotemperature_r52
        WHERE code_hydro = :code_hydro');
        $sql->bindParam(':code_hydro', $code_hydro, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->code_hydro = $row["code_hydro"];
            $this->riviere = stripslashes($row["riviere"]);
            $this->commune = $row["commune"];
            $this->id_commune = $row["id_commune"];
            $this->localite = $row["localisation"];
            $this->mise_en_service = date("d/m/Y", strtotime($row["mise_en_service"]));
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

/**
 * Sélectionne l'ensemble des stations d'hydrotempérature 
 * en Pays de la Loire
 * @return array 
 */
function getStationsTemperatures() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM r_station_hydrotemperature_r52
    ORDER BY id_dpt, code_hydro');
    try {
        $sql->execute();
        $stations_temperature = $sql->fetchAll();
        return $stations_temperature;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
