<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Utility functions  
require_once(dirname(__FILE__)."classes/utilities.inc.php");

$station = $_REQUEST["station"];
$id_station = $_REQUEST["id_station"];
?>
<?php if($station!=""): ?>
    <?php
    $table = "R_STATION_QUALITE_RCS_R52";
    $table_2 = "R_QUALITE_RIVIERE_R52";
    
    $query = "SELECT * 
    FROM $table, $table_2 
    WHERE $table.id_station = '$station' 
    AND $table.id_riviere = $table_2.id_riviere ";
    $result = mysql_query($query);
    $val = mysql_fetch_array($result);
    ?>
    <?=(stripslashes($val["nom_riviere"]))?>
&nbsp;<?=$val["commune"]?> <?=$val["id_commune"]?>, <?=$val["localite"]?>	
<?php endif; ?>
<?php if($id_station!=""): ?>
    <?php 
    $query_2 = "SELECT * 
    FROM R_STATIONS_HYDROTEMPERATURE_R52
    WHERE id_station = '$id_station'";
    $result_2 = mysql_query($query_2);
    $val_2 = mysql_fetch_assoc($result_2);
    ?>
&nbsp;<?=$val_2["commune"]?> <?=$val_2["id_commune"]?>, <?=$val_2["localite"]?>	
<?php endif; ?>