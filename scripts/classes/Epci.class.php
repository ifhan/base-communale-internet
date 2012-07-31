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
        global $pdo;
        $table = "R_EPCI_R52";
        $table_2 = "R_EPCI_R52_statut";

        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_epci = $id_epci 
        AND $table.id_statut_epci = $table_2.id_statut_epci 
        GROUP BY $table_2.id_statut_epci";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->nom_epci  = $row['nom_epci'];
            $this->nom_statut_epci  = $row['nom_statut_epci'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        } 
    }
}

/**
 * Sélectionne les communes d'un EPCI par son identifiant
 * @global type $pdo Paramètres de connexion à la base de données
 * @param string $id_epci
 * @return array 
 */
function getCommunesEpciByIdEpci($id_epci) {
        global $pdo;
        $table = "BDC_COMMUNE_52";
        $table_2 = "R_EPCI_COMMUNES_R52";
        
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table_2.id_epci = $id_epci
        AND $table.id_commune = $table_2.id_commune 
        GROUP BY $table.id_commune 
        ORDER BY $table.id_commune";
        try {
            $communes = $pdo->query($sql)->fetchAll();
            return $communes;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }

?>
