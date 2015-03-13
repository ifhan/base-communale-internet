<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/IcpeSeveso.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$icpe_seveso = new IcpeSeveso();
$icpe_seveso->getIcpeSevesoByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$icpe_seveso->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$icpe_seveso->id_regional?></strong></td>
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
<h3 class="spip">Commune d'exploitation&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?><br />
<table class="encadre">
    <tr>
        <td><strong>N° SIRET&nbsp;:</strong></td>
        <td><?=$icpe_seveso->siret?></td>
    </tr>
    <tr>
        <td><strong>Libell&eacute; du service&nbsp;:</strong></td>
        <td><?=$icpe_seveso->lib_service?></td>
    </tr>    
    <tr>
        <td>
            <strong>
                <abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:
            </strong>
        </td>
        <td><?=$icpe_seveso->naf?></td>
    </tr>
    <tr>
        <td>
            <strong>
                Libell&eacute; <abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:
            </strong>
        </td>
        <td><?=$icpe_seveso->lib_naf?></td>
    </tr>
    <tr>
        <td><strong>&Eacute;tat d'activité&nbsp;:</strong></td>
        <td><?=$icpe_seveso->etat?></td>
    </tr>
    <tr>
        <td><strong>R&eacute;gime de l'établissement&nbsp;:</strong></td>
        <td><?=$icpe_seveso->regime?></td>
    </tr>
    <tr>
        <td><strong>R&eacute;gime Seveso&nbsp;:</strong></td>
        <td>
            <?php if($icpe_seveso->seveso=='SB'): ?>
            Seuil bas (SB)
            <?php elseif($icpe_seveso->seveso=='AS'): ?>
            Seuil haut (AS)
            <?php endif;?>
        </td>
    </tr>
    <tr>
        <td><strong>IET-MTD&nbsp;:</strong></td>
        <td><?=$icpe_seveso->iet_mtd?></td>
    </tr>    
    <tr>
        <td><strong>Enjeux&nbsp;:</strong></td>
        <td><?=$icpe_seveso->enjeux?></td>
    </tr>
    <tr>
        <td><strong>Effectif&nbsp;:</strong></td>
        <td><?=$icpe_seveso->effectif?></td>
    </tr>
</table>
