<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Apb.class.php';
require_once 'classes/Departement.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];
$apb = new Apb();
$apb->getApbByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional, $id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$apb->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$apb->id_regional?></strong></td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;: </td>
        <td><strong><?=$apb->id_national?></strong></td>
    </tr>
    <?php if(!empty($apb->arrete_modif)): ?>
    <tr>
        <td>Arr&ecirc;t&eacute; de modification&nbsp;:</td>
        <td>
            <strong>
                <?php if(!empty($apb->arrete_modif)): ?>
                    n&deg;<?=$apb->arrete_modif?>
                <?php endif; ?>
                du <?=$apb->date_modif?>
            </strong>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Arr&ecirc;t&eacute; de cr&eacute;ation&nbsp;:</td>
        <td>
            <strong>
                <?php if(!empty($apb->arrete_creation)): ?>
                    n&deg;<?=$apb->arrete_creation?>
                <?php endif; ?>
                du <?=$apb->date_creation?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;: </td>
        <td><strong><?=$apb->surf_sig_l93?> ha</strong></td>
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
<?php if(isset($apb->parcelles)): ?>
<h3 class="spip">Parcelles cadastrales&nbsp;:</h3>
<?php endif; ?>
<p><?=$apb->parcelles?></p>
<?php if(!empty($apb->statut_foncier)): ?>
<h3 class="spip">Statut foncier&nbsp;:</h3>
<p><?=$apb->statut_foncier?></p>
<?php endif; ?>
<?php if(isset($apb->interet_bio)): ?>
<h3 class="spip">Int&eacute;r&ecirc;t biologique&nbsp;:</h3>
<p><?=$apb->interet_bio?></p>
<?php endif; ?>
<?php if(isset($apb->effets_protection)): ?>
<h3 class="spip">Effets de la protection&nbsp;:</h3>
<p><?=$apb->effets_protection?></p>
<?php endif; ?>