<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes
require_once(dirname(__FILE__)."/../classes/Epci.class.php");

/**
 * Ce fichier sert à afficher le nom de l'EPCI dans un squelette SPIP
 * @var  $id_epci Identifiant de l'EPCI
 */
$id_epci = $_REQUEST["id_epci"];

$nom_epci = new Epci();
$nom_epci->getEpciByIdEpci($id_epci);

echo $nom_epci->nom_epci;
?>