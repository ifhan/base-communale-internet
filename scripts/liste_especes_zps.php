<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/SiteNatura.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$site_natura = new SiteNatura();
$site_natura->getSiteNaturaByIdRegionalIdType($id_regional, $id_type);

$departements = getDepartementsByIdRegional($id_regional);

$oiseaux = getOiseauxByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td>
            <strong><?=$site_natura->nom?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td>
            <strong><?=$site_natura->id_regional?></strong>
        </td>
    </tr>
    <?php if(!empty($site_natura->date_transmission)):?>
    <tr>
        <td>Date de transmission&nbsp;:</td>
        <td>
            <strong><?=$site_natura->date_transmission?></strong>
        </td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($site_natura->date_designation)):?>
    <tr>
        <td>Date de d&eacute;signation&nbsp;:</td>
        <td>
            <strong><?=$site_natura->date_designation?></strong>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td>
            <strong><?=$site_natura->surf_sig_l93?> ha</strong>
        </td>
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
</table>
<?php if(count($oiseaux) > 0): ?>
<h3 class="spip">Oiseaux&nbsp;:</h3>
<table>
    <tr>
        <th>Code  | Nom | Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($oiseaux as $oiseau): ?>
    <tr bgcolor="<?= switchcolor() ?>">
        <td>
            <?= $oiseau["SPECNUM"] ?> | 
            <em><?= $oiseau["SPECNAME"] ?></em> | 
            <?php if($oiseau["ANNEX_II"]=='Y'): ?>
            Oui
            <?php endif ?>
            <?php if($oiseau["ANNEX_II"]==''): ?>
            Non
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br />
<?php endif; ?>