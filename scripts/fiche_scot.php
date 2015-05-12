<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Scot.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];
$scot = new Scot();
$scot->getScotByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td width='20%'>Nom&nbsp;:</td>
        <td><strong><?=$scot->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$scot->id_regional?></strong></td>
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
<h3 class="spip">Commune(s) concern&eacute;e(s) en Pays de la Loire&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?><br />
<table class="encadre">
    <tr>
        <td><strong>&Eacute;tat juridique du SCoT&nbsp;:</strong></td>
        <td><?=$scot->ETAT?></td>
    </tr>
    <tr>
        <td><strong>Nature de la de proc&eacute;dure administrative engag&eacute;e&nbsp;:</strong></td>
        <td><?=$scot->TYPE_PROCEDURE?></td>
    </tr>
    <?php if($scot->DATE_ARRETE_PERIMETRE!=="01/01/1970"): ?>
    <tr>
        <td><strong>Date de l'arrêté officiel du périmètre&nbsp;:</strong></td>
        <td><?=$scot->DATE_ARRETE_PERIMETRE?></td>
    </tr>
    <?php endif; ?>
    <?php if($scot->DATE_ENGAGEMENT!=="01/01/1970"): ?>
    <tr>
        <td><strong>Date d'engagement de la procédure d'élaboration ou de révision du SCoT&nbsp;:</strong></td>
        <td><?=$scot->DATE_ENGAGEMENT?></td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($scot->REF_ARRETE_PERIMETRE)): ?>
    <tr>
        <td><strong>Référence de l'arrêté déterminant le périmètre du SCoT&nbsp;:</strong></td>
        <td><?=$scot->REF_ARRETE_PERIMETRE?></td>
    </tr>
     <?php endif; ?>
    <?php if(!empty($scot->DECISION_ARRETE)): ?>
    <tr>
        <td><strong>Nature de la décision prise dans l'arrêté qui vient créer ou mettre à jour le périmètre&nbsp;:</strong></td>
        <td><?=$scot->DECISION_ARRETE?></td>
    </tr>
     <?php endif; ?>
    <?php if($scot->DATE_ARRET_PROJET!=="01/01/1970"): ?>
    <tr>
        <td><strong>Date de délibération validant le projet du SCoT&nbsp;:</strong></td>
        <td><?=$scot->DATE_ARRET_PROJET?></td>
    </tr>
    <?php endif; ?>
    <?php if($scot->DATE_APPROBATION!=="01/01/1970"): ?>
    <tr>
        <td><strong>Date de la délibération approuvant le SCoT&nbsp;:</strong></td>
        <td><?=$scot->DATE_APPROBATION?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td><strong>Nombre de communes adhérentes&nbsp;:</strong></td>
        <td><?=$scot->NB_COMMUNE?></td>
    </tr>
    <tr>
        <td><strong>Intercommunalité responsable et porteuse du SCoT&nbsp;:</strong></td>
        <td><?=$scot->SIREN?></td>
    </tr>
    <tr>
        <td><strong>Département responsable du SCoT&nbsp;:</strong></td>
        <td><?=$scot->DEP_RESPONSABLE?></td>
    </tr>  
</table>