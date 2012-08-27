<?php

/**
 * Description of StationQualite
 * Classe et fonctions concernant les stations "Qualité des eaux"
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-08-01
 * @version 1.0
 */
class StationQualite {
    /**
     * Sélectionne une station par son identifiant
     * @param string $id_regional Identifiant de la station
     */
    public function getStationQualiteByIdStation($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();        
        $sql = $pdo->prepare('SELECT * 
        FROM R_STATION_QUALITE_RCS_R52, R_RIVIERE_QUALITE_R52
        WHERE R_STATION_QUALITE_RCS_R52.id_regional = :id_regional 
        AND R_STATION_QUALITE_RCS_R52.id_riviere = 
        R_RIVIERE_QUALITE_R52.id_riviere');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_INT, 6);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->nom_riviere = stripslashes($row["nom_riviere"]);
            $this->nom_commune = $row["nom_commune"];
            $this->id_commune = $row["id_commune"];
            $this->localite = $row["localite"];
            $this->id_reseau = $row["id_reseau"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
 
}

/**
 * Sélectionne les stations "Qualité des eaux" par le code géographique du
 * département (ou sur l'ensemble de la région) et par l'identifiant du réseau 
 * (RCS ou RNB)
 * @param int $id_dpt Identifiant du département
 * @param int $id_reseau Identifiant du réseau 
 * @return array 
 */
function getStationsQualiteByIdDptByIdReseau($id_dpt,$id_reseau) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    if($id_dpt!="0"):
        $sql = $pdo->prepare('SELECT * FROM R_STATION_QUALITE_RCS_R52 
        WHERE id_departement = :id_dpt 
        AND id_reseau = :id_reseau 
        ORDER BY id_departement, id_regional');
        $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_INT, 2);
        $sql->bindParam(':id_reseau', $id_reseau, PDO::PARAM_STR, 3);
        
    else:
        $sql = $pdo->prepare('SELECT * FROM R_STATION_QUALITE_RCS_R52 
        WHERE id_reseau = :id_reseau 
        ORDER BY id_departement, id_regional');
        $sql->bindParam(':id_reseau', $id_reseau, PDO::PARAM_STR, 3);
    endif;
    try {
        $sql->execute();
        $stations_qualite_rcs =  $sql->fetchAll();
        return $stations_qualite_rcs;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les stations "Qualité des eaux" par département et par rivière
 * @param int $id_dpt Identifiant du département
 * @param int $id_riviere Identifiant de la rivière
 * @return array 
 */
function getStationsQualiteByIdDptByIdRiviere($id_dpt,$id_riviere) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    if ($id_dpt != "0"):
        if ($id_riviere != "0"):
            // Cas #1 : sélection d'un cours d'eau dans un département
            $sql = $pdo->prepare("SELECT DISTINCT * 
            FROM R_STATION_QUALITE_RCS_R52, R_RIVIERE_QUALITE_R52
            WHERE R_STATION_QUALITE_RCS_R52.id_commune LIKE CONCAT(:id_dpt,'%')
            AND R_STATION_QUALITE_RCS_R52.id_riviere = :id_riviere 
            AND R_STATION_QUALITE_RCS_R52.id_riviere = 
            R_RIVIERE_QUALITE_R52.id_riviere 
            ORDER BY R_STATION_QUALITE_RCS_R52.id_regional");
            $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_INT, 2);
            $sql->bindParam(':id_riviere', $id_riviere, PDO::PARAM_INT, 2);
        else:
            // Cas #2 : sélection de tous les cours d'eau dans un département
            $sql = $pdo->prepare("SELECT DISTINCT * 
            FROM R_STATION_QUALITE_RCS_R52, R_RIVIERE_QUALITE_R52
            WHERE R_STATION_QUALITE_RCS_R52.id_commune LIKE CONCAT(:id_dpt,'%')
            AND R_STATION_QUALITE_RCS_R52.id_riviere = 
            R_RIVIERE_QUALITE_R52.id_riviere 
            ORDER BY R_STATION_QUALITE_RCS_R52.id_regional");
            $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_INT, 2);
        endif;
    else:
        if ($id_riviere != "0"):
            // Cas #3 : sélection d'un cours d'eau dans la région
            $sql = $pdo->prepare('SELECT * 
            FROM R_STATION_QUALITE_RCS_R52, R_RIVIERE_QUALITE_R52
            WHERE R_STATION_QUALITE_RCS_R52.id_riviere = :id_riviere
            AND R_STATION_QUALITE_RCS_R52.id_riviere = 
            R_RIVIERE_QUALITE_R52.id_riviere
            ORDER BY R_STATION_QUALITE_RCS_R52.id_regional');
            $sql->bindParam(':id_riviere', $id_riviere, PDO::PARAM_INT, 2);
        else:
        // Cas #4 : sélection de tous les cours d'eau de la région
            $sql = $pdo->prepare('SELECT * 
            FROM R_STATION_QUALITE_RCS_R52, R_RIVIERE_QUALITE_R52
            WHERE R_STATION_QUALITE_RCS_R52.id_riviere = 
            R_RIVIERE_QUALITE_R52.id_riviere
            ORDER BY R_STATION_QUALITE_RCS_R52.id_regional');
        endif;
    endif;
    try {
        $sql->execute();
        $stations_qualite_rcs = $sql->fetchAll();
        return $stations_qualite_rcs;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les stations "Qualité des eaux" par commune
 * @param type $id_commune Code géographique de la commune
 * @return array
 */
function getStationsQualiteByIdCommune($id_commune) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT DISTINCT * 
    FROM R_STATION_QUALITE_RCS_R52, R_RIVIERE_QUALITE_R52
    WHERE R_STATION_QUALITE_RCS_R52.id_commune = :id_commune 
    AND R_STATION_QUALITE_RCS_R52.id_riviere = R_RIVIERE_QUALITE_R52.id_riviere 
    ORDER BY R_STATION_QUALITE_RCS_R52.id_regional');
    $sql->bindParam(':id_commune', $id_commune, PDO::PARAM_INT, 5);
    try {
        $sql->execute();
        $stations_qualite_rcs = $sql->fetchAll();
        return $stations_qualite_rcs;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
