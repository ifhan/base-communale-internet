<?php

/**
 * Description of Sic
 * Classe et fonctions concernant les Sites d'Intérêt Communautaire (SIC)
 * (Natura 2000, directive "Habitats")
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-25
 * @version 1.0
 */
class Sic {

}

/**
 * Sélectionne un SIC par un identifiant EUR15
 * @param int $id_eur15 Identifiant de l'habitat EUR15
 * @return array 
 */
function getSicByIdEur15($id_eur15) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM natura_eur15, natura_habit1, R_SIC_R52
    WHERE natura_eur15.ID_EUR15 = :id_eur15
    AND natura_eur15.ID_EUR15 = natura_habit1.HBCDAX 
    AND $table_2.SITECODE = R_SIC_R52.id_regional
    GROUP BY R_SIC_R52.id_regional
    ORDER BY R_SIC_R52.id_regional');
    $sql->bindParam(':id_eur15', $id_eur15, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $array_sic = $sql->fetchAll();
        return $array_sic;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
