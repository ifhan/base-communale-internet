<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/SiteInpg.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$site_inpg = new SiteInpg();
$site_inpg->getSiteInpgProposeByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$site_inpg->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$site_inpg->id_regional?></strong></td>
    </tr>
    <tr>
        <td>Typologie&nbsp;:</td>
        <td>
            <strong>
        <?=$site_inpg->typo_1?> / <?=$site_inpg->typo_2?> / <?=$site_inpg->typo_3?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Confidentialit&eacute;&nbsp;:</td>
        <td><strong><?=$site_inpg->confidentialite?></strong></td>
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
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h2>
<?php require_once 'inc/commune.inc.php'; ?>