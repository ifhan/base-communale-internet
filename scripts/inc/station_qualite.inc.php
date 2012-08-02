<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes 
require_once(dirname(__FILE__)."/../classes/StationQualite.class.php");

/**
 * Ce fichier sert à afficher le nom de la station sélectionnée dans un 
 * squelette SPIP
 * @var $id_station Identifiant de la station
 */ 
$id_station = $_REQUEST["id_station"];

$station_qualite = new StationQualite();
$station_qualite->getStationQualiteByIdStation($id_station);
?>
<?=$station_qualite->nom_riviere?> 
<?=$station_qualite->nom_commune?> 
(<?=$station_qualite->id_commune?>), 
<?=$station_qualite->localite?>