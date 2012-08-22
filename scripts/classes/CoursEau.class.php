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
     * @global string $pdo Connexion à la base de données
     * @param string $id_regional Identifiant de la station
     */
    public function getRiviereByIdStation($id_regional) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_STATIONS_HYDROTEMPERATURE_R52 
        WHERE id_regional = '$id_regional'";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->riviere = stripslashes($row["riviere"]);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les rivières comportant des stations "Qualité des eaux"
 * relevant de la DREAL Pays de la Loire par département
 * @global string $pdo Connexion à la base de données
 * @param int $id_dpt Identifiant du département
 * @return array 
 */
function getRivieresQualiteByIdDpt($id_dpt) {
    global $pdo;
    $table = "R_RIVIERE_QUALITE_R52";
    $table_2 = "R_RIVIERES_DEPARTEMENTS_QUALITE_R52";
    
    if ($id_dpt != 0):
        $sql = "SELECT *
        FROM $table, $table_2 
        WHERE $table_2.id_departement = $id_dpt
        AND $table.id_riviere = $table_2.id_riviere 
        ORDER BY $table.id_riviere ";
    else:
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_riviere = $table_2.id_riviere 
        GROUP BY $table.nom_riviere 
        ORDER BY $table.id_riviere ";
    endif;
    try {
        $rivieres = $pdo->query($sql)->fetchAll();
        return $rivieres;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
