<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Zde.class.php';
require_once 'classes/ParcEolien.class.php';
require_once 'classes/Departement.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_zde = $_REQUEST["id_zde"];
$zde = new Zde();
$zde->getZdeByIdZde($id_zde);

$parcs_eoliens = getParcEolienByIdZde($id_zde);
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
<h3 class="spip">Parc(s) &eacute;olien(s)&nbsp;:</h3>
<table>
<?php foreach($parcs_eoliens as $parc_eolien): ?>
    <tr bgcolor="<?=switchColor()?>">
        <td><?=$parc_eolien["nom_parc"]?></td>
        <td><?=$parc_eolien["exploitant"]?></td>
    </tr>
<?php endforeach; ?>    
    
</table>
