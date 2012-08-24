<?php

/**
 * Description of EspeceDeterminante
 *
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-26
 * @version 1.0
 */
class EspeceDeterminante {

}

/**
 * Sélectionne les espèces déterminantes pour la flore en Pays de la Loire
 * @global string $pdo Connexion à la base de données
 * @return array 
 */
function getEspecesDeterminantesFlore() {
    global $pdo;
    $sql = $pdo->prepare('SELECT * 
    FROM R_ESPECES_DETERMINANTES_FLORE_R52, $table_2 
    WHERE R_ESPECES_DETERMINANTES_FLORE_R52.ID = 
    R_ESPECES_DETERMINANTES_ZNIEFF_R52.ID 
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
 * @global string $pdo Connexion à la base de données
 * @return array 
 */
function getEspecesDeterminantesFaune() {
    global $pdo;
    $sql = $pdo->prepare('SELECT * FROM R_ESPECES_DETERMINANTES_FAUNE_R52
    ORDER BY GENRE');
    $sql->execute();
    try {
        $especes_determinantes_faune = $sql->fetchAll();
        return $especes_determinantes_faune;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
