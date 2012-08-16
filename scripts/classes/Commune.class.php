<?php

/**
 * Description of Commune
 * Classe et fonction concernant les commuens
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-13
 * @version 0.1
 */
class Commune {

    /**
     * Sélectionne l'ensemble des communes d'un département
     * @global type $pdo Connexion à la base de données
     * @param string $id_dpt Identifiant du département
     * @return array 
     */
    public function getCommunesByIdDepartement($id_dpt) {
        global $pdo;
        $sql = "SELECT *
        FROM BDC_COMMUNE_52 
        WHERE id_departement = '$id_dpt' 
        ORDER BY nom_commune";
        try {
            $query = $pdo->query($sql);
            $communes = $query->fetchAll();
            return $communes;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne une commune par son code géographique
     * @global string $pdo Connexion à la base de données
     * @param string $id_commune Code géographique de la commune
     */
    public function getCommuneById($id_commune) {
        global $pdo;
        $sql = "SELECT * 
        FROM BDC_COMMUNE_52 
        WHERE id_commune = '$id_commune' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_commune = $row['id_commune'];
            $this->nom_commune = $row['nom_commune'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les communes d'un département à partir de son identifiant
 * @global string $pdo Connexion à la base de données
 * @param int $id_dpt Identifiant du département
 * @return string
 */
function getCommunesByIdDpt($id_dpt) {
    global $pdo;
    $sql = "SELECT *
    FROM BDC_COMMUNE_52
    WHERE id_departement = $id_dpt
    ORDER BY nom_commune";
    try {
        $communes = $pdo->query($sql)->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne le(s) commune(s) d'un zonage par son identifiant régional
 * @global string $pdo Connexion à la base de données
 * @param string $id_regional Identifiant régional du zonage
 * @param type $id_type Identifiant du type de zonage
 * @return array 
 */
function getCommunesByIdRegional($id_regional, $id_type) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "BDC_COMMUNE_52";

    $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_regional = '$id_regional'
        AND $table.id_commune = $table_2.id_commune 
        AND $table.id_type = $id_type 
        GROUP BY $table_2.id_commune
        ORDER BY $table_2.id_commune";
    try {
        $communes = $pdo->query($sql)->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>