<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Utility functions  
require_once(dirname(__FILE__)."/../classes/utilities.inc.php");

// Classes
require_once(dirname(__FILE__)."/../classes/Epci.class.php");

/**
 * Ce fichier sert à afficher le statut de l'EPCI dans un squelette SPIP
 * @var  $id_epci Identifiant de l'EPCI
 */
$id_epci = $_REQUEST["id_epci"];

$statut_epci = new Epci();
$statut_epci->getEpciByIdEpci($id_epci);

echo $statut_epci->nom_statut_epci;
?>