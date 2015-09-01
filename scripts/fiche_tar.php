<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/IcpeTar.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$icpe_tar = new IcpeTar();
$icpe_tar->getIcpeTarByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$icpe_tar->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$icpe_tar->id_regional?></strong></td>
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
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h2>
<?php require_once 'inc/commune.inc.php'; ?><br />
<table class="encadre">
    <tr>
        <td><strong>Code l'établissement&nbsp;:</strong></td>
        <td><?=$icpe_tar->code_s3ic?></td>
    </tr>
    <tr>
        <td><strong>N° SIRET&nbsp;:</strong></td>
        <td><?=$icpe_tar->siret?></td>
    </tr>
    <tr>
        <td><strong>Libell&eacute; du service&nbsp;:</strong></td>
        <td><?=$icpe_tar->lib_service?></td>
    </tr>    
    <tr>
        <td>
            <strong>
                <abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:
            </strong>
        </td>
        <td><?=$icpe_tar->naf?></td>
    </tr>
    <tr>
        <td>
            <strong>
                Libell&eacute; <abbr title="Nomenclature d'Activités Française">NAF</abbr>&nbsp;:
            </strong>
        </td>
        <td><?=$icpe_tar->lib_naf?></td>
    </tr>
    <tr>
        <td><strong>&Eacute;tat d'activité&nbsp;:</strong></td>
        <td><?=$icpe_tar->etat?></td>
    </tr>
    <tr>
        <td><strong>R&eacute;gime de l'établissement&nbsp;:</strong></td>
        <td><?=$icpe_tar->regime?></td>
    </tr>
    <tr>
        <td><strong>Statut technique&nbsp;:</strong></td>
        <td><?=$icpe_tar->statut_tech?></td>
    </tr>    
    <tr>
        <td><strong>Enjeux&nbsp;:</strong></td>
        <td><?=$icpe_tar->enjeux?></td>
    </tr>
    <tr>
        <td><strong>Effectif&nbsp;:</strong></td>
        <td><?=$icpe_tar->effectif?></td>
    </tr>
    <tr>
        <td><strong>Rubrique&nbsp;:</strong></td>
        <td><?=$icpe_tar->rubrique?></td>
    </tr>
    <tr>
        <td><strong>Alinea&nbsp;:</strong></td>
        <td><?=$icpe_tar->alinea?></td>
    </tr>    
    <tr>
        <td><strong>Régime d'installation classée&nbsp;:</strong></td>
        <td><?=$icpe_tar->regime_ic?></td>
    </tr>
    <tr>
        <td><strong>Quantité&nbsp;:</strong></td>
        <td><?=$icpe_tar->quantite?></td>
    </tr>
    <tr>
        <td><strong>Unité&nbsp;:</strong></td>
        <td><?=$icpe_tar->unite?></td>
    </tr>    
    <tr>
        <td><strong>Type de circuit&nbsp;:</strong></td>
        <td><?=$icpe_tar->type_circuit?></td>
    </tr>
    <tr>
        <td><strong>Puissance&nbsp;:</strong></td>
        <td><?=$icpe_tar->puissance?></td>
    </tr>
        <tr>
        <td><strong>Nombre de TAR&nbsp;:</strong></td>
        <td><?=$icpe_tar->nb_tar?></td>
    </tr>
</table>