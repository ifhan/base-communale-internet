<?php

/**
 * Description of EspeceDeterminante
 * Classe et fonctions concernant les espèces déterminantes
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2014-04-15
 * @version 1.1
 */
class EspeceDeterminante {

}

/**
 * Sélectionne les espèces déterminantes pour la flore en Pays de la Loire
 * @return array 
 */
function getEspecesDeterminantesFlore() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM r_especes_determinantes_flore_r52, r_especes_determinantes_znieff_r52
    WHERE r_especes_determinantes_flore_r52.ID = r_especes_determinantes_znieff_r52.ID 
    GROUP BY GENRE 
    ORDER BY GENRE');
    $sql->execute();
    try {
        $especes_determinantes_flore = $sql->fetchAll();
        return $especes_determinantes_flore;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les espèces déterminantes pour la faune en Pays de la Loire
 * @return array 
 */
function getEspecesDeterminantesFaune() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM r_especes_determinantes_faune_r52
    ORDER BY GENRE');
    $sql->execute();
    try {
        $especes_determinantes_faune = $sql->fetchAll();
        return $especes_determinantes_faune;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
