<?php

/**
 * Description of ParcEolien
 * Classe et fonction concernant les parcs éoliens
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-09-05
 * @version 1.0
 */
class ParcEolien {

}

/**
 * Sélectionne les parcs éoliens par l'identifiant de leur ZDE
 * @param string $id_zde Identifnat de la ZDE
 * @return array 
 */
function getParcEolienByIdZde($id_zde) {
    global $pdo_pg;
    $sql = $pdo_pg->prepare('SELECT * FROM eolien."N_PARC_EOLIEN_S_R52"
    WHERE "N_PARC_EOLIEN_S_R52"."ID_ZDE" = :id_zde');
    $sql->bindParam(':id_zde', $id_zde, PDO::PARAM_INT, 7);
    try {
        $sql->execute();
        $parcs_eoliens = $sql->fetchAll();
        return $parcs_eoliens;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
