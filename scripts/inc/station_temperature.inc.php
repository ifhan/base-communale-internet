<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes 
require_once(dirname(__FILE__)."/../classes/StationTemperature.class.php");

/**
 * Ce fichier sert à afficher le nom de la station sélectionnée dans un 
 * squelette SPIP
 * @var $code_hydro Identifiant de la station
 */ 
$code_hydro = $_REQUEST["code_hydro"];

$station_temperature = new StationTemperature();
$station_temperature->getStationTemperatureByIdStation($code_hydro);
?>
&nbsp;<?=$station_temperature->commune?> 
(<?=$station_temperature->id_commune?>)
<?php if(!empty($station_temperature->localite)): ?>
, <?=$station_temperature->localite?>
<?php endif;?>