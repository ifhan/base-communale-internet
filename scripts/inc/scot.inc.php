<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

$id_scot = $_REQUEST["id_scot"];

$query = "SELECT * 
FROM n_scot_zsup_r52 
WHERE id_regional = $id_scot";
$result = mysql_query($query);
$val = mysql_fetch_assoc($result);

echo $val["nom"];	
?>