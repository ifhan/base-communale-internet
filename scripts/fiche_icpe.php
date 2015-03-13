<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Icpe.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$icpe = new Icpe();
$icpe->getIcpeByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$icpe->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$icpe->id_regional?></strong></td>
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
        <td><?=$icpe->siret?></td>
    </tr>
    <tr>
        <td><strong>Libell&eacute; du service&nbsp;:</strong></td>
        <td><?=$icpe->lib_service?></td>
    </tr>    
    <tr>
        <td>
            <strong>
                <abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:
            </strong>
        </td>
        <td><?=$icpe->naf?></td>
    </tr>
    <tr>
        <td>
            <strong>
                Libell&eacute; <abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:
            </strong>
        </td>
        <td><?=$icpe->lib_naf?></td>
    </tr>
    <tr>
        <td><strong>&Eacute;tat d'activité&nbsp;:</strong></td>
        <td><?=$icpe->etat?></td>
    </tr>
    <tr>
        <td><strong>R&eacute;gime de l'établissement&nbsp;:</strong></td>
        <td><?=$icpe->regime?></td>
    </tr>
    <tr>
        <td><strong>R&eacute;gime Seveso&nbsp;:</strong></td>
        <td>
            <?php switch($icpe->seveso): 
                case 'SB':
                    echo 'Seuil bas (SB)';
                    break;
                case 'AS':
                    echo 'Seuil haut (AS)';
                    break;
                case 'NS':
                    echo 'Non Seveso';
                    break;
            endswitch;
            ?>
        </td>
    </tr>
    <tr>
        <td><strong>IET-MTD&nbsp;:</strong></td>
        <td><?=$icpe->iet_mtd?></td>
    </tr>    
    <tr>
        <td><strong>Enjeux&nbsp;:</strong></td>
        <td><?=$icpe->enjeux?></td>
    </tr>
    <tr>
        <td><strong>Effectif&nbsp;:</strong></td>
        <td><?=$icpe->effectif?></td>
    </tr>
</table>