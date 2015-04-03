<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

/**
 * Ce fichier sert à identifier le type de fiche photo pour chaque zonage 
 * ou site à partir du squelette SPIP fiche.html
 * @var $id_type Identifiant du type de zonage 
 */
$id_type = $_REQUEST["id_type"];

$zonage = new Zonage();
$zonage->getTypeZonageByIdType($id_type);

include(dirname(__FILE__)."/../photos_".$zonage->path.".php");
?>