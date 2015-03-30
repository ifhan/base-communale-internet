<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/AncienTitreMinier.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$titre_minier = new AncienTitreMinier();
$titre_minier->getAncienTitreMinierByIdRegional($id_regional);

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
        <td><?=$titre_minier->nom_titre?></td>
    </tr>
    <tr>
        <td><strong>Nature&nbsp;:</strong></td>
        <td><?=$titre_minier->nature?></td>
    </tr>
    <tr>
        <td><strong>Octroi&nbsp;:</strong></td>
        <td><?=$titre_minier->octroi?></td>
    </tr>
    <tr>
        <td><strong>Péremption&nbsp;:</strong></td>
        <td><?=$titre_minier->peremption?></td>
    </tr>
    <tr>
        <td><strong>Statut&nbsp;:</strong></td>
        <td><?=$titre_minier->statut?></td>
    </tr>
    <tr>
        <td><strong>Précisionde la localisation&nbsp;:</strong></td>
        <td><?=$titre_minier->precision?></td>
    </tr>    
    <tr>
        <td><strong>Titulaire&nbsp;:</strong></td>
        <td><?=$titre_minier->titulaire?></td>
    </tr>    
    <tr>
        <td><strong>Substance 1&nbsp;:</strong></td>
        <td><?=$titre_minier->substance_1?></td>
    </tr>
    <tr>
        <td><strong>Substance 2&nbsp;:</strong></td>
        <td><?=$titre_minier->substance_2?></td>
    </tr>
    <tr>
        <td><strong>Substance 3&nbsp;:</strong></td>
        <td><?=$titre_minier->substance_3?></td>
    </tr>
    <tr>
        <td><strong>Installation de traitement&nbsp;:</strong></td>
        <td>
            <?php if($titre_minier->installation_traitement=="T"):?>
            Oui
            <?php elseif($titre_minier->installation_traitement=="F"):?>
            Non
            <?php endif;?>
        </td>
    </tr>    
    <tr>
        <td><strong>Installation de sécurité&nbsp;:</strong></td>
        <td>
            <?php if($titre_minier->installation_securite=="T"):?>
            Oui
            <?php elseif($titre_minier->installation_securite=="F"):?>
            Non
            <?php endif;?>        
        </td>
    </tr>        
    <tr>
        <td><strong>Tonnage extrait&nbsp;:</strong></td>
        <td><?=$titre_minier->tonnage_extrait?></td>
    </tr>
    <tr>
        <td><strong>Tonnage de tout venant&nbsp;:</strong></td>
        <td><?=$titre_minier->tonnage_tout_venant?></td>
    </tr>   
    <tr>
        <td><strong>Tonnage de métal&nbsp;:</strong></td>
        <td><?=$titre_minier->tonnage_metal?></td>
    </tr>
</table>