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
     * @global string $pdo Paramètres de connexion à la base de données
     * @param int $id_epci Identifiant de l'EPCI
     */
    public function getEpciByIdEpci($id_epci) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_EPCI_R52, R_EPCI_R52_statut
        WHERE R_EPCI_R52.id_epci = :id_epci 
        AND R_EPCI_R52.id_statut_epci = R_EPCI_R52_statut.id_statut_epci 
        GROUP BY R_EPCI_R52_statut.id_statut_epci');
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
     * @global string $pdo Paramètres de connexion à la base de données
     * @param int $id_siren Code SIREN de l'EPCI
     */
    public function getEpciByCodeSiren($id_siren) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM R_EPCI_R52_videos
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
 * @global type $pdo Paramètres de connexion à la base de données
 * @param string $id_epci Identifiant de l'EPCI
 * @return array 
 */
function getCommunesEpciByIdEpci($id_epci) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM BDC_COMMUNE_52, R_EPCI_COMMUNES_R52
    WHERE R_EPCI_COMMUNES_R52.id_epci = :id_epci
    AND BDC_COMMUNE_52.id_commune = R_EPCI_COMMUNES_R52.id_commune 
    GROUP BY BDC_COMMUNE_52.id_commune 
    ORDER BY BDC_COMMUNE_52.id_commune');
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
 * @global string $pdo Paramètres de connexion à la base de données
 * @param int $id_dpt Code géographique du département
 * @return array 
 */
function getEpciByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM R_EPCI_R52
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
 * @global string $pdo Paramètres de connexion à la base de données
 * @param int $id_dpt Code géographique du département
 * @return array 
 */
function getEpciVideosByIdDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM R_EPCI_R52_videos
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
