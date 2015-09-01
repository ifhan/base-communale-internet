<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/IcpeDreal.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$icpe = new IcpeDreal();
$icpe->getIcpeDrealByIdRegional($id_regional);

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
        <td><abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:</td>
        <td><strong><?=$icpe->naf?></strong></td>
    </tr>
    <tr>
        <td>Libell&eacute; <abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:</td>
        <td><strong><?=$icpe->lib_naf?></strong></td>
    </tr>
    <tr>
        <td>&Eacute;tat d'activité&nbsp;:</td>
        <td><strong><?=$icpe->etat?></strong></td>
    </tr>
    <tr>
        <td>R&eacute;gime de l'établissement&nbsp;:</td>
        <td><strong><?=$icpe->regime?></strong></td>
    </tr>
    <tr>
        <td>R&eacute;gime Seveso&nbsp;:</td>
        <td>
            <strong>
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
            </strong>
        </td>
    </tr> 
    <tr>
        <td>Enjeux&nbsp;:</td>
        <td><strong><?=$icpe->enjeux?></strong></td>
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
<h3 class="spip">Commune d'exploitation&nbsp;:</h2>
<?php require_once 'inc/commune.inc.php'; ?>