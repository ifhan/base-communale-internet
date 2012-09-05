<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Zde.class.php';
require_once 'classes/Departement.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_zde = $_REQUEST["id_zde"];
$zde = new Zde();
$zde->getZdeByIdZde($id_zde);

/*$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional, $id_type);*/
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$zde->nom_zde?></strong></td>
    </tr>
    <tr>
        <td>Identifiant&nbsp;:</td>
        <td><strong><?=$zde->id_zde?></strong></td>
    </tr>
    <tr>
        <td>&Eacute;tat d'avancement de l'instruction de la demande de ZDE &nbsp;:</td>
        <td><strong><?=$zde->etat_zde?></strong></td>
    </tr>
    <tr>
        <td>Surface d&eacute;clar&eacute;e par le demandeur &nbsp;:</td>
        <td><strong><?=$zde->surfdeclar?> ha</strong></td>
    </tr>
    <tr>
        <td>Date de l'arr&ecirc;t&eacute;&nbsp;: </td>
        <td><strong><?=$zde->datearrete?></strong></td>
    </tr>
    <tr>
        <td>R&eacute;f&eacute;rence de l'arr&ecirc;t&eacute;&nbsp;:</td>
        <td>
            <strong><?=$zde->refarrete?></strong>
        </td>
    </tr>
    <tr>
        <td>Puissances minimale/maximale</td>
        <td>
            <strong><?=$zde->pu_mini?> MW/<?=$zde->pu_maxi?> MW</strong>
        </td>
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
<?php if(isset($zde->parcelles)): ?>
<h3 class="spip">Parcelles cadastrales&nbsp;:</h3>
<?php endif; ?>
<p><?=$zde->parcelles?></p>
<?php if(isset($zde->statut_foncier)): ?>
<h3 class="spip">Statut foncier&nbsp;:</h3>
<p><?=$zde->statut_foncier?></p>
<?php endif; ?>
<?php if(isset($zde->interet_bio)): ?>
<h3 class="spip">Int&eacute;r&ecirc;t biologique&nbsp;:</h3>
<p><?=$zde->interet_bio?></p>
<?php endif; ?>
<?php if(isset($zde->effets_protection)): ?>
<h3 class="spip">Effets de la protection&nbsp;:</h3>
<p><?=$zde->effets_protection?></p>
<?php endif; ?>