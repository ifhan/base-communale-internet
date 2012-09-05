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
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM n_parc_eolien_s_053
    WHERE id_zde = :id_zde
    ORDER BY id_zde');
    $sql->bindParam(':id_zde', $id_zde, PDO::PARAM_STR, 7);
    try {
        $sql->execute();
        $array_zde = $sql->fetchAll();
        return $array_zde;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
