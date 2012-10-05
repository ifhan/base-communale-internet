<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';	

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/ZnieffIp.class.php';

/**
 * Ce fichier sert à afficher la fiche descriptive d'une ZNIEFF
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$znieff = new ZnieffIp();
$znieff->getZnieffIpByIdRegional($id_regional,$id_type);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td>
            <strong><?=$znieff->nom?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td>
            <strong><?=$znieff->id_regional?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td>
            <strong><?=$znieff->id_national?></strong>
        </td>
    </tr>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td>
            <strong><?=$znieff->surf_sig_l93?> ha</strong>
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
</table>
<br />
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>