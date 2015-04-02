<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Utility functions  
require_once(dirname(__FILE__)."/../classes/utilities.inc.php");

// Classes
require_once (dirname(__FILE__)."/../classes/Zonage.class.php");

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant réginal du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$zonage = new Zonage();
$zonage->getZonageByIdRegional($id_type, $id_regional);
?>
<?=$zonage->id_regional?> <?= mb_strtoupper($zonage->nom) ?>