<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes
require_once (dirname(__FILE__) . "/../classes/StationQualite.class.php");

/**
 * Ce fichier sert à récupérer le type de réseau auquel appartient la station
 * Qualité
 * @var $id_regional Identifiant de la station
 */
$id_regional = $_REQUEST["id_regional"];

$station_qualite = new StationQualite();
$station_qualite->getStationQualiteByIdStation($id_regional);
?>
<?php if ($station_qualite->id_reseau == "1"): ?>
stations du RCS
<?php elseif ($station_qualite->id_reseau == "2"): ?>
anciennes stations du RNB non retenues dans le RCS
<?php endif; ?>