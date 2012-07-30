<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

$riviere = $_REQUEST["riviere"];
$id_station = $_REQUEST["id_station"];
?>
<?php if($riviere!=""): ?>
    <?php
    $query = "SELECT * 
    FROM R_QUALITE_RIVIERE_R52 
    WHERE id_riviere = $riviere";
    $result = mysql_query($query);
    $val = mysql_fetch_assoc($result);
    
    /**
     *  Affiche le nom du cours d'eau sélectionné
     */
    ?>
&nbsp;sur <?=(stripslashes($val["nom_riviere"]))?>
<?php endif; ?>
<?php if($id_station!=""): ?>
    <?php
    $query_2 = "SELECT * 
    FROM R_STATIONS_HYDROTEMPERATURE_R52 
    WHERE id_station = '$id_station'";
    $result_2 = mysql_query($query_2);
    $val_2 = mysql_fetch_array($result_2);
    
    /**
     *  Affiche le nom du cours d'eau sélectionné
     */
    ?>
    <?=(stripslashes($val_2["riviere"]))?>
<?php endif; ?>