<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes 
require_once(dirname(__FILE__)."/../classes/AnnexeHydraulique.class.php");

/**
 * Ce fichier sert à afficher le nom de l'annexe sélectionnée dans un 
 * squelette SPIP
 * @var $id_commun Identifiant de l'a station'annexe
 */ 
$id_commun = $_REQUEST["id_commun"];

$annexe_hydraulique = new AnnexeHydraulique();
$annexe_hydraulique->getAnnexeHydrauliqueByIdCommun($id_commun);
?>
&nbsp;<?=$annexe_hydraulique->nom_principal?> 
(<?=$annexe_hydraulique->id_commun?>)