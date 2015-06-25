<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/UnitePaysagere.class.php';

/**
 * @var $id_regional Identifiant régional de l'unité paysagère
 */
$id_regional = $_REQUEST["id_regional"];

$unite_paysagere = new UnitePaysagere();
$unite_paysagere->getUnitePaysagereByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$unite_paysagere->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$unite_paysagere->id_regional?></strong></td>
    </tr>
    <tr>
        <td>Famille d'unité paysagère&nbsp;:</td>
        <td><strong><?=$unite_paysagere->famille_up?></strong></td>
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
</table><br />
<h3 class="spip">Communes concernées&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>
<h3 class="spip">Sous-unités paysagères&nbsp;:</h3>
<?php require_once 'inc/sous_unite_paysagere.inc.php'; ?>