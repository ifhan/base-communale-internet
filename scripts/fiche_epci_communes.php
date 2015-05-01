<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Zonage.class.php';

/**
 * Ce fichier sert a afficher les différents zonages recensés par EPCI
 * @var $id_epci Identifiant de l'EPCI
 */
$id_epci = $_REQUEST["id_epci"];

/**
 *  Affichage des communes de l'EPCI
 */
?>
<h3 class="spip">Communes concern&eacute;es&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?><br />