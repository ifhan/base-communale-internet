<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

/**
 * @var $id_departement Code géographique du département
 * @var $id_type Identifiant du type de zonage
 * @var $id_eur15 Identifiant de l'habitat de la nomenclature EUR15
 * @var $id_corine Identifiant de l'habitat de la nomenclature CORINE
 */
$id_departement = $_REQUEST["id_departement"];
$id_type = $_REQUEST["id_type"];
$id_eur15 = $_GET["id_eur15"];
$id_corine = $_GET["id_corine"];?>
<a href="scripts/print_liste_zonages.php?<?php 
if($id_eur15!=""): echo "eur15=".$id_eur15 ; 
elseif($id_corine!=""): echo "corine=".$id_corine ; 
elseif($id_type!=""): echo "departement=".$id_departement."&amp;type=".$id_type ;
endif; ?>"  
title="Afficher une version imprimable"  target="_blank">
    Version imprimable
</a>
