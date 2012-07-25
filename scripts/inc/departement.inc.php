<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes
require_once(dirname(__FILE__)."/../classes/Departement.class.php");

/**
 * @var $id_dpt Code du département
 * @var $id_regional Identifiant régional du zonage
 * @var $id_type Identifiant du type de zonage
 */
$id_dpt = $_REQUEST["id_dpt"];
$id_regional = $_REQUEST["id_regional"];
$id_type = $_REQUEST["id_type"];
	
if(isset($id_regional)):
    $departement = new Departement();
    $departement->getDepartementByIdRegional($id_regional,$id_type);
    /**
     *  Affiche le nom et le code géographique du département
     */
    echo "<strong>".$departement["nom_departement"]." (".$departement["id_departement"].")</strong>";
elseif($id_dpt!="0"):
    $departement = new Departement();
    $departement->getDepartementById($id_dpt);
    /**
     *  Affiche le nom et le code géographique du département
     */
    echo $departement->nom_dpt." (".$departement->id_dpt.")";
else:   
    echo "Pays de la Loire";
endif;		
?>