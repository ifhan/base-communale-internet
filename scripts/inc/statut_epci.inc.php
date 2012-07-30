<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

$id_epci = $_REQUEST["id_epci"];

$table = "R_EPCI_R52";
$table_2 = "R_EPCI_R52_statut";

$query = "SELECT * 
FROM $table, $table_2 
WHERE $table.id_epci = $id_epci
AND $table.id_statut_epci = $table_2.id_statut_epci 
GROUP BY $table_2.id_statut_epci";
$result = mysql_query($query);
$val = mysql_fetch_assoc($result);

echo $val["nom_statut_epci"];	
?>