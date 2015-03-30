<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Pprt.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$pprt = new Pprt();
$pprt->getPprtByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$pprt->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$pprt->id_regional?></strong></td>
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
<h3 class="spip">Communes concern&eacute;es&nbsp;:</h2>
<?php require_once 'inc/commune.inc.php'; ?><br />
<table class="encadre">
    <tr>
        <td><strong>&Eacute;tat&nbsp;:</strong></td>
        <td>
            <?php switch($pprt->etat):
                case 01:
                    echo "Prescrit";
                    break;
                case 02:
                    echo "Approuvé";
                    break;
                case 03:
                    echo "Abrogé";
                    break;
                case 04:
                    echo "Appliqué par anticipation";
                    break;
                endswitch; ?>
        </td>
    </tr>
    <tr>
        <td><strong>Date d'approbation&nbsp;:</strong></td>
        <td>
            <?php if($pprt->date_approbation!='01/01/1970'): ?>
                <?=$pprt->date_approbation?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td><strong>Date de fin de validit&eacute;&nbsp;:</strong></td>
        <td>
            <?php if($pprt->date_finval!='01/01/1970'): ?>
                <?=$pprt->date_finval?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td><strong>PPRT multi-risques ?&nbsp;:</strong></td>
        <td><?=$pprt->multi_risque?></td>
    </tr>
    <tr>
        <td><strong>Nature du ou des risque(s)&nbsp;:</strong></td>
        <td><?=$pprt->risque?></td>
    </tr>   
</table><br />
<?php if(!empty($pprt->url)):?>
<table>
    <tr>
        <td style="vertical-align:bottom;">
            <img src="IMG/png/gnome-globe.png" style="border:none" alt="Icone web" />
        </td>
        <td>
            <strong>Pour en savoir plus</strong>, 
            <a href="<?=$pprt->url?>" target="blank">consulter le site Internet de la DREAL</a>.
        </td>
    </tr>
</table>
<?php endif; ?>