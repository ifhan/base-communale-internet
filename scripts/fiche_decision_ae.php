<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/DecisionAe.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];
$decision_ae = new DecisionAe();
$decision_ae->getDecisionAeByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$decision_ae->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$decision_ae->id_regional?></strong></td>
    </tr>
    <tr>
        <td>Type de porteur&nbsp;:</td>
        <td><strong><?=$decision_ae->type_porteur?></strong></td>
    </tr>
    <?php if($decision_ae->date_decision !== '01/01/1970'): ?>
    <tr>
        <td>Date de l'avis&nbsp;:</td>
        <td><strong><?=$decision_ae->date_decision?></strong></td>
    </tr>
    <?php endif; ?>    
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