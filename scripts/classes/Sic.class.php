<?php

/**
 * Description of Sic
 *
 * @author ronan.vignard
 * @copyright 2012-06-25
 * @version 1.0
 */
class Sic {
    public $id_regional;
}

function getSicByIdEur15($id_eur15) {
    global $pdo;
    		
    $table = "natura_eur15";
    $table_2 = "natura_habit1";
    $table_3 = "R_SIC_R52";
		
    $sql = "SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table.ID_EUR15 = '$id_eur15' 
    AND $table.ID_EUR15 = $table_2.HBCDAX 
    AND $table_2.SITECODE = $table_3.id_regional
    GROUP BY $table_3.id_regional
    ORDER BY $table_3.id_regional" ;
    try {
        $query = $pdo->query($sql);
        $array_sic = $query->fetchAll();
        return $array_sic;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

?>