<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';
?>
    <head>
        <title>Liste des stations du RNB 
            <?php include("inc/cours_eau.inc.php")?> 
            en <?php include("inc/departement.inc.php")?>
        </title>
        <?php include("inc-meta_print.php") ?>
        <h1 class="titre-texte">
            Liste des stations du RNB <?php include("inc/cours_eau.inc.php")?>
        </h1>
        <div class="soustitre">
            en <?php include("inc/departement.inc.php")?>
        </div>
        <div class="ps"></div>
    </td>
    </tr>
    </table><br />
    <div class="blue_link"><?php include("liste_stations.php")?></div><br />
</body>
</html>