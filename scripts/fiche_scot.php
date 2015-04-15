<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Zonage.class.php';

/**
 *  Ce fichier sert à afficher les communes concernées par le SCoT
 * @var $id_scot Identifiant du SCOT
 */
$id_scot = $_REQUEST["id_scot"];

/**
 *  Affichage des communes du SCoT
 */
?>
<h3 class="spip">Communes concern&eacute;es&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?><br />