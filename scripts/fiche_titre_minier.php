<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/TitreMinier.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$titre_minier = new TitreMinier();
$titre_minier->getTitreMinierByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$titre_minier->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$titre_minier->id_regional?></strong></td>
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
        <td><strong>Titre minier&nbsp;:</strong></td>
        <td><?=$titre_minier->titre_minier?></td>
    </tr>
    <tr>
        <td><strong>Type de travaux miniers&nbsp;:</strong></td>
        <td><?=$titre_minier->type_travaux_miniers?></td>
    </tr>
    <tr>
        <td><strong>Substances&nbsp;:</strong></td>
        <td><?=$titre_minier->substances?></td>
    </tr>
    <tr>
        <td><strong>Statut administratif&nbsp;:</strong></td>
        <td><?=$titre_minier->statut_adm?></td>
    </tr>    
    <tr>
        <td><strong>Date de demande&nbsp;:</strong></td>
        <td>
            <?php if($titre_minier->demande!='01/01/1970'): ?>
                <?=$titre_minier->demande?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td><strong>Date de d&eacute;livrance&nbsp;:</strong></td>
        <td>
            <?php if($titre_minier->delivrance!='01/01/1970'): ?>
                <?=$titre_minier->delivrance?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td><strong>Titulaire&nbsp;:</strong></td>
        <td><?=$titre_minier->titulaire?></td>
    </tr>
    <tr>
        <td><strong>Dur&eacute;e (en ann&eacute;es)&nbsp;:</strong></td>
        <td><?=$titre_minier->duree_ans?></td>
    </tr>
    <tr>
        <td><strong>Surface (en km²)&nbsp;:</strong></td>
        <td><?=$titre_minier->surf_km2?></td>
    </tr>   
    <tr>
        <td><strong>Texte&nbsp;:</strong></td>
        <td><?=$titre_minier->texte?></td>
    </tr>   
    <tr>
        <td><strong>Consulter le texte sur L&eacute;gifrance&nbsp;:</strong></td>
        <td><a href="<?=$titre_minier->legifrance?>" target="blank"><?=$titre_minier->legifrance?></a></td>
    </tr>
</table>