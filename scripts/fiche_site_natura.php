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

$operateur = new SiteNatura();
$operateur->getOperateurByIdRegional($id_regional);

$structure_animatrice = new SiteNatura();
$structure_animatrice->getStructureAnimatriceByIdRegional($id_regional);

$site_natura_data = new SiteNatura();
$site_natura_data->getDataByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$site_natura->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$site_natura->id_regional?></strong></td>
    </tr>
    <?php if($id_type == "6"): ?>
    <?php if(!empty($site_natura->date_transmission)):?>
    <tr>
        <td>Date de transmission&nbsp;:</td>
        <td>
            <strong><?=$site_natura->date_transmission?></strong>
        </td>
    </tr>
    <?php endif; ?>
    <?php endif; ?>
    <?php if(($id_type == "5") OR ($id_type == "30")): ?>
    <?php if(!empty($site_natura->date_designation)): ?>
    <tr>
        <td>Date de d&eacute;signation&nbsp;:</td>
        <td><strong><?=$site_natura->date_designation?></strong></td>
    </tr>
    <?php endif; ?>
    <?php endif; ?>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td><strong><?=$site_natura->surf_sig_l93?> ha</strong></td>
    </tr>
    <tr>
        <td>Op&eacute;rateur&nbsp;:</td>
        <td>
            <?php if ($operateur->id_organisme=="31"): ?>
            <?=$operateur->sigle?>
            <?php else: ?>
            <a href="spip.php?page=organisme&amp;id_organisme=<?=$operateur->id_organisme?>">
                <?=$operateur->sigle?>
            </a>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>Animateur&nbsp;: </td>
        <td>
            <?php if ($structure_animatrice->id_organisme=="31"):?>
            <?=$structure_animatrice->sigle?>
            <?php else:?>
            <a href="spip.php?page=organisme&amp;id_organisme=<?=$structure_animatrice->id_organisme?>">
                <?=$structure_animatrice->sigle?>
            </a>
            <?php endif; ?>
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
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<div class="cadre_bleu">
    <?php require_once 'inc/commune.inc.php'; ?>
</div>
<br />
<?php if(!empty($site_natura_data->QUALITY)): ?>
<h3 class="spip">Description&nbsp;:</h3>
<p><?=$site_natura_data->QUALITY?></p>
<?php endif; ?>		
<?php if(!empty($site_natura_data->VULNAR)): ?>
<h3 class="spip">Vuln&eacute;rabilit&eacute;&nbsp;:</h3>
<p><?=$site_natura_data->VULNAR?></p>		
<?php endif; ?>
<?php if(!empty($site_natura_data->CHARACT)): ?>
<h3 class="spip">Caract&eacute;ristiques&nbsp;:</h3>
<p><?=$site_natura_data->CHARACT?></p>
<?php endif; ?>