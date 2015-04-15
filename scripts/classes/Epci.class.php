<?php

/**
 * Description of Epci
 * Classe et fonctions concernant les Établissements Publics de
 * Coopération Intercommunale
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-30
 * @version 1.0
 */
class Epci {
    /**
     * Sélectionne un EPCI par son identifiant
     * @param int $id_epci Identifiant de l'EPCI
     */
    public function getEpciByIdEpci($id_epci) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM r_epci_r52, r_epci_statut_r52
        WHERE r_epci_r52.id_epci = :id_epci 
        AND r_epci_r52.id_statut_epci = r_epci_statut_r52.id_statut_epci 
        GROUP BY r_epci_statut_r52.id_statut_epci');
        $sql->bindParam(':id_epci', $id_epci, PDO::PARAM_STR, 3);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->nom_epci  = $row['nom_epci'];
            $this->nom_statut_epci  = $row['nom_statut_epci'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        } 
    }
    
    /**
     * Sélectionne un EPCI par son code SIREN
     * @param int $id_siren Code SIREN de l'EPCI
     */
    public function getEpciByCodeSiren($id_siren) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_epci_videos_r52
        WHERE siren = :id_siren 
        GROUP BY siren');
        $sql->bindParam(':id_siren', $id_siren, PDO::PARAM_STR, 20);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->nom_epci  = $row['nom_epci'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        } 
    }
}

/**
 * Sélectionne les communes d'un EPCI par son identifiant
 * @param string $id_epci Identifiant de l'EPCI
 * @return array 
 */
function getCommunesEpciByIdEpci($id_epci) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM bdc_commune_52, r_epci_communes_r52
    WHERE r_epci_communes_r52.id_epci = :id_epci
    AND bdc_commune_52.id_commune = r_epci_communes_r52.id_commune 
    GROUP BY bdc_commune_52.id_commune 
    ORDER BY bdc_commune_52.id_commune');
    $sql->bindParam(':id_epci', $id_epci, PDO::PARAM_STR, 3);
    $sql->execute();
    try {
        $communes = $sql->fetchAll();
        return $communes;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }    
}

/**
 * Sélectionne les ECPI d'un département par le code géographique 
 * du département
 * @param int $id_dpt Code géographique du département
 * @return array 
 */
function getEpciByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM r_epci_r52
    WHERE id_departement = :id_dpt 
    ORDER BY nom_epci');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    $sql->execute();
    try {
        $array_epci = $sql->fetchAll();
        return $array_epci;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}    
    
/**
 * Sélectionne les ECPI d'un département par le code géographique 
 * du département
 * @param int $id_dpt Code géographique du département
 * @return array 
 */
function getEpciVideosByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM r_epci_videos_r52
    WHERE id_departement = :id_dpt 
    ORDER BY nom_epci');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $array_epci = $sql->fetchAll();
        return $array_epci;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
