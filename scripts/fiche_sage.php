<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Sage.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$sage = new Sage();
$sage->getSageByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$sage->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant&nbsp;:</td>
        <td><strong><?=$sage->id_regional?></strong></td>
    </tr>    
    <tr>
        <td>État&nbsp;:</td>
        <td><strong><?=$sage->etat?></strong></td>
    </tr>
    <tr>
        <td>Comité&nbsp;:</td>
        <td><strong><?=$sage->comite?></strong></td>
    </tr>
    <tr>
        <td>Type de périmètre&nbsp;:</td>
        <td><strong><?=$sage->type_perimetre?></strong></td>
    </tr>
</table><br />
<h3 class="spip">Commune concernées en Pays de la Loire&nbsp;:</h2>
<?php require_once 'inc/commune.inc.php'; ?><br />