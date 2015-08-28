<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/OuvrageMinier.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$ouvrage_minier = new OuvrageMinier();
$ouvrage_minier->getOuvrageMinierByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$ouvrage_minier->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$ouvrage_minier->id_regional?></strong></td>
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
        <td><strong>Identifiant du site&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->id_site?></td>
    </tr>
    <tr>
        <td><strong>Source&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->source?></td>
    </tr>
    <tr>
        <td><strong>Z&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->z?></td>
    </tr>
    <tr>
        <td><strong>Visibilité&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->visibilite?></td>
    </tr>
    <tr>
        <td><strong>Incertitude de la position&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->incertitude_position?></td>
    </tr>
    <tr>
        <td><strong>Nature&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->nature?></td>
    </tr> 
    <tr>
        <td><strong>Rôle ODJ&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->role_odj?></td>
    </tr>
    <tr>
        <td><strong>Date de FC&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->date_fc?></td>
    </tr>
    <tr>
        <td><strong>Section&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->section?></td>
    </tr>     
    <tr>
        <td><strong>Diamètre (largeur)&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->diametre_largeur?></td>
    </tr>
    <tr>
        <td><strong>Longueur du rectangle&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->longueur_rectangle?></td>
    </tr>   
    <tr>
        <td><strong>Hauteur&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->hauteur?></td>
    </tr>
    <tr>
        <td><strong>Profondeur&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->profondeur?></td>
    </tr>
    <tr>
        <td><strong>Longueur de galerie&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->longueur_galerie?></td>
    </tr>
    <tr>
        <td><strong>Nombre de recettes&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->nb_recette?></td>
    </tr>
    <tr>
        <td><strong>Profondeur de la première recette&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->profondeur_recette_1?></td>
    </tr>    
    <tr>
        <td><strong>État de la tête&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->etat_tete?></td>
    </tr>
    <tr>
        <td><strong>État du corps&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->etat_corps?></td>
    </tr>
    <tr>
        <td><strong>Revêtement&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->revetement?></td>
    </tr>
    <tr>
        <td><strong>Coupe technique&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->coupe_tech?></td>
    </tr>
    <tr>
        <td><strong>Coupe géologique&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->coupe_geo?></td>
    </tr>
    <tr>
        <td><strong>Date du traitement&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->date_traitement?></td>
    </tr>
    <tr>
        <td><strong>Nature du traitement&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->nature_traitement?></td>
    </tr>
    <tr>
        <td><strong>Émergence&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->emergence?></td>
    </tr>
    <tr>
        <td><strong>Accessibilité&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->accessibilite?></td>
    </tr>  
    <tr>
        <td><strong>Pénétrabilité&nbsp;:</strong></td>
        <td><?=$ouvrage_minier->penetrabilite?></td>
    </tr>      
</table>