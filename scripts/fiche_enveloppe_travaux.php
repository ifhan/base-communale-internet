<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/EnveloppeTravaux.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$enveloppe_travaux = new EnveloppeTravaux();
$enveloppe_travaux->getEnveloppeTravauxByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$enveloppe_travaux->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$enveloppe_travaux->id_regional?></strong></td>
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
        <td><strong>Substance&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->substance?></td>
    </tr>
    <tr>
        <td><strong>Statut&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->statut?></td>
    </tr>
    <tr>
        <td><strong>d_statut&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->d_statut?></td>
    </tr>
    <tr>
        <td><strong>Origine de l'enveloppe&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->origine_enveloppe?></td>
    </tr>
    <tr>
        <td><strong>Surface de l'enveloppe (en ha)&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->surf_enveloppe?></td>
    </tr>
    <tr>
        <td><strong>Production&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->production?></td>
    </tr>    
    <tr>
        <td><strong>caractere_env&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->caractere_env?></td>
    </tr>
    <tr>
        <td><strong>surf_enj&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->surf_enj?></td>
    </tr>
    <tr>
        <td><strong>Résistance du minerai&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->res_min?></td>
    </tr>     
    <tr>
        <td><strong>Typologie du gisement&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->typo_gisement?></td>
    </tr>
    <tr>
        <td><strong>meth_exp&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->meth_exp?></td>
    </tr>   
    <tr>
        <td><strong>Profondeur maximale&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->profondeur_max?></td>
    </tr>
    <tr>
        <td><strong>Profondeur minimale&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->profondeur_min?></td>
    </tr>
    <tr>
        <td><strong>Ouverture&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->ouverture?></td>
    </tr>
    <tr>
        <td><strong>D&eacute;formation&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->deformation?></td>
    </tr>
    <tr>
        <td><strong>Profondeur de l'ouvrage&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->profondeur_ouvrage?></td>
    </tr>    
    <tr>
        <td><strong>Pendage&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->pendage?></td>
    </tr>
    <tr>
        <td><strong>Encaissage&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->encaissage?></td>
    </tr>
    <tr>
        <td><strong>Recouvrement&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->recouvrement?></td>
    </tr>
    <tr>
        <td><strong>Ouvrages&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->ouvrages?></td>
    </tr>
    <tr>
        <td><strong>Nombre d'ouvrages&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->nb_ouvrages?></td>
    </tr>
    <tr>
        <td><strong>D&eacute;sordre&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->desordre?></td>
    </tr>
    <tr>
        <td><strong>D&eacute;pôt&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->depot?></td>
    </tr>
    <tr>
        <td><strong>&Eacute;chelle&nbsp;:</strong></td>
        <td><?=$enveloppe_travaux->echelle?></td>
    </tr>    
</table>