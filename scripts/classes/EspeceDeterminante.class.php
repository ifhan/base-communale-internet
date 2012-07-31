<?php

/**
 * Description of EspeceDeterminante
 *
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-26
 * @version 1.0
 */
class EspeceDeterminante {
    //put your code here
}

/**
 * Sélectionne les espèces déterminantes pour la flore en Pays de la Loire
 * @global string $pdo
 * @return array 
 */
function getEspecesDeterminantesFlore() {
    global $pdo;
    $table = "R_ESPECES_DETERMINANTES_FLORE_R52";
    $table_2 = "R_ESPECES_DETERMINANTES_ZNIEFF_R52";
    
    $sql = "SELECT * 
    FROM $table, $table_2 
    WHERE $table.ID = $table_2.ID 
    GROUP BY GENRE 
    ORDER BY GENRE ";
    try {
        $especes_determinantes_flore = $pdo->query($sql)->fetchAll();
        return $especes_determinantes_flore;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les espèces déterminantes pour la faune en Pays de la Loire
 * @global string $pdo
 * @return array 
 */
function getEspecesDeterminantesFaune() {
    global $pdo;
    $sql = "SELECT * 
    FROM R_ESPECES_DETERMINANTES_FAUNE_R52
    ORDER BY GENRE" ;
    try {
        $especes_determinantes_faune = $pdo->query($sql)->fetchAll();
        return $especes_determinantes_faune;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
?>
