<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

/**
 * @var $id_type Identifiant du type de zonage 
 */
$id_type = $_REQUEST["id_type"];

switch ($id_type):
    case 1:
        include(dirname(__FILE__)."/../photos_apb.php");
        break;
    case 2:
        include(dirname(__FILE__)."/../photos_rnn.php");
        break;
    case 3:
        include(dirname(__FILE__)."/../photos_rnv.php");
        break;
    case 4:
        include(dirname(__FILE__)."/../photos_zico.php");
        break;
    case 5: case 6: case 19: case 21: case 30:
        include(dirname(__FILE__)."/../photos_site_natura.php");
        break;
    case 7:
        include(dirname(__FILE__)."/../photos_pnr.php");
        break;
    /**
     * Affichage des ZNIEFF de première génération uniquement sur Intranet
     */
    case 8: case 9:
        include(dirname(__FILE__)."/../photos_znieff1g.php");
        break;
    case 10: case 11:
        include(dirname(__FILE__)."/../photos_znieff2g.php");
        break;
    case 12:
        include(dirname(__FILE__)."/../photos_zhin.php");
        break;	
    case 13: case 14:
        include(dirname(__FILE__)."/../photos_site_classe_inscrit.php");
        break;
    case 15:
        include(dirname(__FILE__)."/../photos_ramsar.php");
        break;
    case 16:
        include(dirname(__FILE__)."/../photos_sage.php");
        break;
endswitch;
?>