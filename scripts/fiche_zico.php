<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Zico.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$zico = new Zico();
$zico->getZicoByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$zico->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$zico->id_regional?></strong></td>
    </tr>
        <?php if($zico->annee_description!="0000"): ?>
    <tr>
        <td>Ann&eacute;e de description&nbsp;:</td>
        <td>
            <strong><?=$zico->annee_description?></strong>
        </td>
    </tr>
        <?php endif; ?>	
    <tr>
        <td>Date de mise &agrave; jour&nbsp;:</td>
        <td>
            <strong><?=$zico->date_maj?></strong>
        </td>
    </tr>
	<?php if(($zico->altitude_min!="")OR($zico->altitude_max!="")): ?>
    <tr>
        <td>Altitude&nbsp;:</td>
        <td>
            <strong><?=$zico->altitude_min?> - <?=$zico->altitude_max?> m</strong>
        </td>
    </tr>
        <?php endif; ?>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td>
            <strong><?=$zico->surf_sig_l93?> ha</strong>
        </td>
    </tr>
    <tr>
        <td>D&eacute;partement&nbsp;: </td>
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
<?php require_once 'inc/commune.inc.php'; ?>
<?php if($zico->informations_complementaires!=""): ?>
<h3 class="spip">Informations compl&eacute;mentaires&nbsp;:</h3>
<p><?=$zico->informations_complementaires?></p>
<?php endif; ?>
<?php if($zico->interet_milieu!=""): ?>
<h3 class="spip">Int&eacute;r&ecirc;t du milieu&nbsp;:</h3>
<p><?=$zico->interet_milieu?></p>
<?php endif; ?>
<?php if($zico->protections_reglementaires!=""): ?>
<h3 class="spip">Protections r&eacute;glementaires&nbsp;:</h3>
<p><?=$zico->protections_reglementaires?></p>
<?php endif; ?>
<?php if($zico->mesures_foncieres!=""): ?>
<h3 class="spip">Mesures fonci&egrave;res&nbsp;:</h3>
<p><?=$zico->mesures_foncieres?></p>
<?php endif; ?>
<?php if($zico->mesures_gestion!=""): ?>
<h3 class="spip">Mesures de gestion&nbsp;:</h3>
<p><?=$zico->mesures_gestion?></p>
<?php endif; ?>
<?php if($zico->menaces!=""): ?>
<h3 class="spip">Menaces&nbsp;:</h3>
<p><?=$zico->menaces?></p>
<?php endif; ?>
<?php if($zico->sources!=""): ?>
<h3 class="spip">Auteur(s)&nbsp;:</h3>
<p><?=$zico->sources?></p>
<?php endif; ?>