<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

/**
 * @var $id_type Identifiant du type de zonage 
 */
$id_type = $_GET["id_type"];

switch ($id_type):
    case 5:
        include(dirname(__FILE__)."/../liste_especes_zps.php");
        break;
    case 6: case 21: case 30:
        include(dirname(__FILE__)."/../liste_especes_zsc.php");
        break;
    case 10: case 11:
        include(dirname(__FILE__)."/../liste_especes_znieff2g.php");
        break;	
    endswitch;
?>