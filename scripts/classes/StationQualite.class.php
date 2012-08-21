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
     * @global string $pdo Connexion àa la base de données
     * @param string $id_regional Identifiant de la station
     */
    public function getStationQualiteByIdStation($id_regional) {
        global $pdo;
        $table = "R_STATION_QUALITE_RCS_R52";
        $table_2 = "R_RIVIERE_QUALITE_R52";
        
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_regional = '$id_regional' 
        AND $table.id_riviere = $table_2.id_riviere ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->nom_riviere = stripslashes($row["nom_riviere"]);
            $this->nom_commune = $row["nom_commune"];
            $this->id_commune = $row["id_commune"];
            $this->localite = $row["localite"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
 
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
function getStationsQualiteByIdDptByIdReseau($id_dpt,$id_reseau) {
    global $pdo;
    if($id_dpt!="0"):
        $sql = "SELECT * 
        FROM R_STATION_QUALITE_RCS_R52 
        WHERE id_reseau = $id_reseau 
        AND id_departement = $id_dpt 
        ORDER BY id_departement, id_regional ";
    else:
        $sql = "SELECT * 
        FROM R_STATION_QUALITE_RCS_R52 
        WHERE id_reseau = $id_reseau 
        ORDER BY id_departement, id_regional ";
    endif;
    try {
        $stations_qualite_rcs = $pdo->query($sql)->fetchAll();
        return $stations_qualite_rcs;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les stations "Qualité des eaux" par département et par rivière
 * @global string $pdo
 * @param int $id_dpt Identifiant du département
 * @param int $id_riviere Identifiant de la rivière
 * @return array 
 */
function getStationsQualiteByIdDptByIdRiviere($id_dpt,$id_riviere) {
    global $pdo;
    $table = "R_STATION_QUALITE_RCS_R52";
    $table2 = "R_RIVIERE_QUALITE_R52";
    if ($id_dpt != "0"):
        if ($id_riviere != "0"):
        // Cas #1 : sélection d'un cours d'eau dans un département
        $sql = "SELECT DISTINCT * 
            FROM $table, $table2 
            WHERE $table.id_commune like '$id_dpt%' 
            AND $table.id_riviere = $id_riviere 
            AND $table.id_riviere = $table2.id_riviere 
            ORDER BY $table.id_regional";
        else:
        // Cas #2 : sélection de tous les cours d'eau dans un département
        $sql = "SELECT DISTINCT * 
            FROM $table, $table2 
            WHERE $table.id_commune like '$id_dpt%' 
            AND $table.id_riviere = $table2.id_riviere 
            ORDER BY $table.id_regional";
        endif;
    else:
        if ($id_riviere != "0"):
        // Cas #3 : sélection d'un cours d'eau dans la région
        $sql = "SELECT * 
            FROM $table, $table2
            WHERE $table.id_riviere = '$id_riviere' 
            AND $table.id_riviere = $table2.id_riviere
            ORDER BY $table.id_regional ";
        else:
        // Cas #4 : sélection de tous les cours d'eau de la région
        $sql = "SELECT * 
            FROM $table, $table2
            WHERE $table.id_riviere = $table2.id_riviere
            ORDER BY $table.id_regional ";
        endif;
    endif;
    try {
        $stations_qualite_rcs = $pdo->query($sql)->fetchAll();
        return $stations_qualite_rcs;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les stations "Qualité des eaux" par commune
 * @global string $pdo
 * @param type $id_commune Code géographique de la commune
 * @return array
 */
function getStationsQualiteByIdCommune($id_commune) {
    global $pdo;
    $table = "R_STATION_QUALITE_RCS_R52";
    $table2 = "R_RIVIERE_QUALITE_R52";

    $sql = "SELECT DISTINCT * 
    FROM $table, $table2 
    WHERE $table.id_commune = $id_commune 
    AND $table.id_riviere = $table2.id_riviere 
    ORDER BY $table.id_regional" ;
    try {
        $stations_qualite_rcs = $pdo->query($sql)->fetchAll();
        return $stations_qualite_rcs;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
