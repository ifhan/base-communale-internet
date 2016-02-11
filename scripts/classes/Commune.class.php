<?php

/**
 * Description of Commune
 * Classe et fonction concernant les communes
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-13
 * @version 1.0
 */
class Commune {

    /**
     * Sélectionne une commune par son code géographique
     * @param string $id_commune Code géographique de la commune
     */
    public function getCommuneByIdCommune($id_commune) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_commune_fla_r52 
        WHERE id_commune = :id_commune');
        $sql->bindParam(':id_commune', $id_commune, PDO::PARAM_STR, 5);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_commune = $row['id_commune'];
            $this->nom_commune = $row['nom_commune'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les communes d'un département à partir de son identifiant
 * @param int $id_dpt Identifiant du département
 * @return array
 */
function getCommunesByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM n_commune_fla_r52 
    WHERE id_departement = :id_dpt
    ORDER BY nom_commune');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $communes = $sql->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne le(s) commune(s) d'un zonage par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @param type $id_type Identifiant du type de zonage
 * @return array 
 */
function getCommunesByIdRegional($id_regional, $id_type) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM r_zonages_communes_r52, n_commune_fla_r52
    WHERE r_zonages_communes_r52.id_regional = :id_regional
    AND r_zonages_communes_r52.id_commune = n_commune_fla_r52.id_commune 
    AND r_zonages_communes_r52.id_type = :id_type
    GROUP BY n_commune_fla_r52.id_commune
    ORDER BY n_commune_fla_r52.id_commune');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    $sql->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql->execute();
        $communes = $sql->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les communes comportant des stations "Qualité des eaux"
 * relevant de la DREAL Pays de la Loire par département
 * @param int $id_dpt Identifiant du département
 * @return array 
 */
function getCommunesStationsQualiteByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT n_commune_fla_r52.id_commune, 
    n_commune_fla_r52.nom_commune, r_station_qualite_rcs_r52.id_commune 
    FROM n_commune_fla_r52, r_station_qualite_rcs_r52
    WHERE n_commune_fla_r52.id_departement = :id_dpt
    AND n_commune_fla_r52.id_commune = r_station_qualite_rcs_r52.id_commune 
    GROUP BY n_commune_fla_r52.nom_commune
    ORDER BY n_commune_fla_r52.nom_commune');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_INT, 2);
    try {
        $sql->execute();
        $communes = $sql->fetchAll();
        return $communes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
