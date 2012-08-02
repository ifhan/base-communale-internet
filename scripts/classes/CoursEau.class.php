<?php

/**
 * Description of CoursEau
 * Classe et fonctions concernant les cours d'eau
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-08-02
 * @version 1.0
 */
class CoursEau {
    /**
     * Sélectionne une rivière par son identifiant
     * @global string $pdo
     * @param int $id_riviere 
     */
    public function getRiviereByIdRiviere($id_riviere) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_RIVIERE_QUALITE_R52 
        WHERE id_riviere = '$id_riviere' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->nom_riviere = stripslashes($row["nom_riviere"]);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    /**
     * Sélectionne une rivière par un identifiant de station
     * @global string $pdo
     * @param string $id_station 
     */
    public function getRiviereByIdStation($id_station) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_STATIONS_HYDROTEMPERATURE_R52 
        WHERE id_station = '$id_station'";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->riviere = stripslashes($row["riviere"]);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

?>
