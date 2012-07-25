<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Znieff1G.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$znieff1g = new Znieff1G();
$znieff1g->getZnieff1GByIdRegional($id_regional,$id_type);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td>
            <strong><?=$znieff1g->nom?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td>
            <strong>
                <?=$znieff1g->id_regional?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de description&nbsp;:</td>
        <td>
            <strong><?=$znieff1g->annee_description?></strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de mise &agrave; jour&nbsp;:</td>
        <td>
            <strong><?=$znieff1g->annee_maj?></strong>
        </td>
    </tr>
    <tr>
        <td>Type de zone&nbsp;:</td>
        <td>
            <strong> 
<?php
/**
 *  Vérification du type de la zone
 */
if($znieff1g->type_zone=="TZ02" ):
    echo "2";
elseif ($znieff1g->type_zone=="TZ01"):
    echo "1";
endif;
?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Altitude&nbsp;:</td>
        <td>
            <strong>
                <?=$znieff1g->altitude_min?> - <?=$znieff1g->altitude_max?> m
            </strong>
        </td>
    </tr>
    <tr>
        <td>Surface&nbsp;:</td>
        <td>
            <strong><?=$znieff1g->surface?> ha</strong>
        </td>
    </tr>
    <tr>
        <td>D&eacute;partement&nbsp;: </td>
        <td>
            <strong>
            <?=$departement->nom_departement?> (<?=$departement->id_departement?>)            
            </strong>
        </td>
    </tr>
</table><br />
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>
<h3 class="spip">Commentaire g&eacute;n&eacute;ral&nbsp;:</h3>         
<p><?=$znieff1g->commentaire_general?></p><br />
<h3 class="spip">Auteur(s)&nbsp;:</h3>
<p><?=$znieff1g->sources?></p>