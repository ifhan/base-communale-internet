<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Rnv.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];
$rnv = new Rnv();
$rnv->getRnvById($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$rnv->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$rnv->id_regional?></strong></td>
    </tr>
    <?php if($rnv->id_national!="") :?>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td><strong><?=$rnv->id_national?></strong></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;: </td>
        <td>
            <strong><?=$rnv->surf_sig_l93?> ha</strong>
        </td>
    </tr>
    <?php if($rnv->date_arrete!="") : ?>
    <tr>
        <td>Arr&ecirc;t&eacute;&nbsp;:</td>
        <td>
            <strong> n&deg;<?=$rnv->id_arrete?> du <?=$rnv->date_arrete?></strong>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td></td>
        <td><em><?=$rnv->commentaire_arrete?></em></td>
    </tr>
    <tr>
        <td>D&eacute;partement&nbsp;: </td>
        <td>
            <strong>
            <?=$departement->nom_departement?> (<?=$departement->id_departement?>)
            </strong>
        </td>
    </tr>
</table>
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>
<?php if(isset($rnv->parcelles)): ?>
<h3 class="spip">Parcelles cadastrales&nbsp;:</h3>
<?php endif; ?>
<p><?=$rnv->parcelles?></p>
<?php if(isset($rnv->statut_foncier)): ?>
<h3 class="spip">Statut foncier&nbsp;:</h3>
<p><?=$rnv->statut_foncier?></p>
<?php endif; ?>
<?php if(isset($rnv->interet_bio)): ?>
<h3 class="spip">Int&eacute;r&ecirc;t biologique&nbsp;:</h3>
<p><?=$rnv->interet_bio?></p>
<?php endif; ?>
<?php if(isset($rnv->effets_protection)): ?>
<h3 class="spip">Effets de la protection&nbsp;:</h3>
<p><?=$rnv->effets_protection?></p>
<?php endif; ?>