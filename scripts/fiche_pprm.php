<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Pprm.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];
$pprm = new Pprm();
$pprm->getPprmByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);

$types_risque = getTypeRisquePprmByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$pprm->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$pprm->id_regional?></strong></td>
    </tr>
    <tr>
        <td>Date d'approbation&nbsp;:</td>
        <td><strong><?=$pprm->DATEAPPRO?></strong></td>
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
<?php require_once 'inc/commune.inc.php'; ?><br />
<h3 class="spip">Type(s) de risques trait&eacute;e dans le PPRM&nbsp;:</h3>
<?php if($pprm->CODERISQUE=='9999999'): ?>
<table width="99%">
    <?php foreach ($types_risque as $type_risque): ?>
        <tr>
            <td bgcolor="<?=switchColor()?>">
                <?=$type_risque["CODERISQUE"]?> - <?=$type_risque["NOMRISQUE"]?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p><?=$pprm->CODERISQUE?> - <?=$pprm->NOMRISQUE?></p>
<?php endif; ?>
