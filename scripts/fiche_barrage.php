<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Barrage.class.php';

/**
 * Ce fichier sert à afficher la fiche descriptive d'un barrage
 * @var $id_regional Identifiant régional de l'objet
 */
$id_regional = $_REQUEST["id_regional"];

$barrage = new Barrage();
$barrage->getBarrageByIdRegional($id_regional);

$departements = getDepartementsByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Identifiant&nbsp;:</td>
        <td><strong><?=$barrage->id_regional?></strong></td>
    </tr>    
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$barrage->nom?></strong></td>
    </tr>
    <tr>
        <td>Classe d'ouvrage&nbsp;:</td>
        <td><strong><?=$barrage->classe_ouvrage?></strong></td>
    </tr>
    <tr>
        <td>Étude de danger obligatoire&nbsp;:</td>
        <td><strong><?=$barrage->edd_obligatoire?></strong></td>
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
</table>
<h3 class="spip">Commune(s) concern&eacute;e(s) en Pays de la Loire&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>