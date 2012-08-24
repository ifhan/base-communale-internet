<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Rnn.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$rnn = new Rnn();
$rnn->getRnnByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$rnn->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$rnn->id_regional?></strong></td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td><strong><?=$rnn->id_national?></strong></td>
    </tr>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td><strong><?=$rnn->surf_sig_l93?> ha</strong></td>
    </tr>
    <tr>
        <td>D&eacute;cret&nbsp;:</td>
        <td>
            <strong>n&deg; <?=$rnn->id_decret?> du 
                <?=$rnn->date?>
            </strong>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><?=$rnn->commentaire_decret?></td>
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
<?php if(isset($rnn->parcelles)): ?>
<h3 class="spip">Parcelles cadastrales&nbsp;:</h3>
<?php endif; ?>
<p><?=$rnn->parcelles?></p>
<?php if(!empty($rnn->statut_foncier)): ?>
<h3 class="spip">Statut foncier&nbsp;:</h3>
<p><?=$rnn->statut_foncier?></p>
<?php endif; ?>
<?php if(!empty($rnn->interet_bio)): ?>
<h3 class="spip">Int&eacute;r&ecirc;t biologique&nbsp;:</h3>
<p><?=$rnn->interet_bio?></p>
<?php endif; ?>
<?php if(!empty($rnn->effets_protection)): ?>
<h3 class="spip">Effets de la protection&nbsp;:</h3>
<p><?=$rnn->effets_protection?></p>
<?php endif; ?>