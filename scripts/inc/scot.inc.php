<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

$id_scot = $_REQUEST["id_scot"];

$query = "SELECT * 
FROM R_SCOT_R52 
WHERE id_scot = $id_scot";
$result = mysql_query($query);
$val = mysql_fetch_assoc($result);

echo $val["nom_scot"];	
?>