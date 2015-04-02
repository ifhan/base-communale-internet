<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/DesordreMinier.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$desordre_minier = new DesordreMinier();
$desordre_minier->getDesordreMinierByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$desordre_minier->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$desordre_minier->id_regional?></strong></td>
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
        <td><strong>Type&nbsp;:</strong></td>
        <td><?=$desordre_minier->type?></td>
    </tr>
    <tr>
        <td><strong>Précision&nbsp;:</strong></td>
        <td><?=$desordre_minier->precision?></td>
    </tr>
    <tr>
        <td><strong>Longueur&nbsp;:</strong></td>
        <td><?=$desordre_minier->longueur?></td>
    </tr>
    <tr>
        <td><strong>Largeur&nbsp;:</strong></td>
        <td><?=$desordre_minier->largeur?></td>
    </tr>
    <tr>
        <td><strong>Surface&nbsp;:</strong></td>
        <td><?=$desordre_minier->surface?></td>
    </tr>
    <tr>
        <td><strong>Profondeur&nbsp;:</strong></td>
        <td><?=$desordre_minier->profondeur?></td>
    </tr> 
    <tr>
        <td><strong>Volume&nbsp;:</strong></td>
        <td><?=$desordre_minier->volume?></td>
    </tr>
    <tr>
        <td><strong>Débit&nbsp;:</strong></td>
        <td><?=$desordre_minier->debit?></td>
    </tr>
    <tr>
        <td><strong>Année&nbsp;:</strong></td>
        <td><?=$desordre_minier->annee?></td>
    </tr>     
    <tr>
        <td><strong>Commentaires&nbsp;:</strong></td>
        <td><?=$desordre_minier->comment?></td>
    </tr>
    <tr>
        <td><strong>Enjeu&nbsp;:</strong></td>
        <td><?=$desordre_minier->enjeu?></td>
    </tr>   
    <tr>
        <td><strong>Perturbation&nbsp;:</strong></td>
        <td><?=$desordre_minier->perturbation?></td>
    </tr>
    <tr>
        <td><strong>Terrain&nbsp;:</strong></td>
        <td><?=$desordre_minier->terrain?></td>
    </tr>
    <tr>
        <td><strong>media&nbsp;:</strong></td>
        <td><?=$desordre_minier->media?></td>
    </tr>
    <tr>
        <td><strong>Odj connu&nbsp;:</strong></td>
        <td><?=$desordre_minier->odj_connu?></td>
    </tr>
    <tr>
        <td><strong>Type d'odj&nbsp;:</strong></td>
        <td><?=$desordre_minier->type_odj?></td>
    </tr>    
    <tr>
        <td><strong>Travaux connus&nbsp;:</strong></td>
        <td><?=$desordre_minier->travaux_connus?></td>
    </tr>    
</table>