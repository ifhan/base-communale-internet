<?php
// Application-wide data and database connection
require_once(dirname(__FILE__) . "/../config/constants.inc.php");
require_once(dirname(__FILE__) . "/../config/database.inc.php");

// Utility functions  
require_once (dirname(__FILE__) . "/../classes/utilities.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Liste des stations du RNB 
            <?php include(dirname(__FILE__) . "/../inc/cours_eau.inc.php")?> 
            en <?php include(dirname(__FILE__) . "/../inc/departement.inc.php")?>
        </title>
        <?php include(dirname(__FILE__) . "/../inc/print.inc.php") ?>
    </head>
    <body>
        <h1 class="titre-texte">
            Liste des stations du RNB <?php include(dirname(__FILE__) . "/../inc/cours_eau.inc.php") ?>
        </h1>
        <div class="soustitre">
            en <?php include(dirname(__FILE__) . "/../inc/departement.inc.php") ?>
        </div>
        <div class="ps"></div>
        <div class="blue_link"><?php include(dirname(__FILE__) . "/../liste_stations_qualite.php") ?></div><br />
    </body>
</html>