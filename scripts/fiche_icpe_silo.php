<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/IcpeSilo.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$icpe_silo = new IcpeSilo();
$icpe_silo->getIcpeSiloByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$icpe_silo->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$icpe_silo->id_regional?></strong></td>
    </tr>
    <tr>
        <td valign="top">D&eacute;partement(s)&nbsp;:</td>
        <td>
            <?php foreach($departements as $departement): ?>
            <strong>
            <?=$departement["nom_departement"]?> (<?=$departement["id_departement"]?>)
            </strong>
            <br />
            <?php endforeach;?>
        </td>
    </tr>
</table><br />
<h3 class="spip">Commune d'exploitation&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?><br />
<table class="encadre">
    <tr>
        <td><strong>N° SIRET&nbsp;:</strong></td>
        <td><?=$icpe_silo->siret?></td>
    </tr>
    <tr>
        <td><strong>&Eacute;tat d'activité&nbsp;:</strong></td>
        <td><?=$icpe_silo->etat?></td>
    </tr>
    <tr>
        <td><strong>Effectif&nbsp;:</strong></td>
        <td><?=$icpe_silo->effectif?></td>
    </tr>
</table>