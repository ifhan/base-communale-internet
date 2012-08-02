<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

$id_epci = $_REQUEST["id_epci"];
?>
    <head>
        <title>Version imprimable</title>
<?php include("inc-meta_print.php") ?>
        <h1 class="titre-texte"><?php require_once 'inc/epci.inc.php'; ?></h1>
        <div class="soustitre"><?php include("inc/statut_epci.inc.php") ?></div>
        <div class="ps">Liste des zonages recens&eacute;s</div>
        </td>
        </tr>
        </table><br />
        <div class="blue_link"><?php include("epci.php") ?></div><br />
        </body>
</html>