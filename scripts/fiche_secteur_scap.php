<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/SecteurScap.class.php';
require_once 'classes/Departement.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];
$secteur_scap = new SecteurScap();
$secteur_scap->getSecteurScapByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional, $id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$secteur_scap->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$secteur_scap->id_regional?></strong></td>
    </tr>
    <?php if(!empty($secteur_scap->date_validation_csrpn)): ?>
    <tr>
        <td>Date de validation par le 
            <abbr title="Conseil Scientifique Régional du Patrimoine Naturel">CSRPN</abbr>&nbsp;:
        </td>
        <td>
            <strong><?=$secteur_scap->date_validation_csrpn?></strong>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;: </td>
        <td><strong><?=$secteur_scap->surf_sig?> ha</strong></td>
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
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>
<?php if(!empty($secteur_scap->localisation_geo)): ?>
<h3 class="spip">Localisation g&eacute;ographique&nbsp;:</h3>
<p><?=$secteur_scap->localisation_geo?></p>
<?php endif; ?>
<?php if(!empty($secteur_scap->biodiversite)): ?>
<h3 class="spip">Biodiversit&eacute;&nbsp;:</h3>
<p><?=$secteur_scap->biodiversite?></p>
<?php endif; ?>
<?php if(!empty($secteur_scap->menaces)): ?>
<h3 class="spip">Menaces&nbsp;:</h3>
<p><?=$secteur_scap->menaces?></p>
<?php endif; ?>
<?php if(!empty($secteur_scap->protection)): ?>
<h3 class="spip">Protection&nbsp;:</h3>
<p><?=$secteur_scap->protection?></p>
<?php endif; ?>
<h3 class="spip">Esp&egrave;ce(s) concern&eacute;e(s)&nbsp;:</h3>
<?php require_once 'inc/espece_scap.inc.php'; ?>
<h3 class="spip">Occupation du sol&nbsp;:</h3>
<table  class="spip">
    <tr class="row_first">
        <th>Type</th>
        <th>Surface (ha)</th>
    </tr>
    <tr>
        <td>Marais et tourbi&egrave;res</td>
        <td><?=$secteur_scap->surf_marais_tourbieres?></td>
    </tr>
    <tr>
        <td>Marais salants</td>
        <td><?=$secteur_scap->surf_marais_salants?></td>
    </tr>
    <tr>
        <td>Prairies</td>
        <td><?=$secteur_scap->surf_prairies?></td>
    </tr> 
    <tr>
        <td>Broussailles</td>
        <td><?=$secteur_scap->surf_broussailles?></td>
    </tr> 
    <tr>
        <td>Sable, gravier</td>
        <td><?=$secteur_scap->surf_sable_gravier?></td>
    </tr> 
    <tr>
        <td>Vignes, vergers</td>
        <td><?=$secteur_scap->surf_vigne_verger?></td>
    </tr> 
    <tr>
        <td>Rochers, &eacute;boulis</td>
        <td><?=$secteur_scap->surf_rocher_eboulis?></td>
    </tr> 
    <tr>
        <td>Forêts</td>
        <td><?=$secteur_scap->surf_forets?></td>
    </tr> 
    <tr>
        <td>Eau libre</td>
        <td><?=$secteur_scap->surf_eau_libre?></td>
    </tr> 
    <tr>
        <td>Carri&egrave;res</td>
        <td><?=$secteur_scap->surf_carrieres?></td>
    </tr> 
    <tr>
        <td>B&acirc;ti</td>
        <td><?=$secteur_scap->surf_bati?></td>
    </tr> 
    <tr>
        <td>Zones d'activit&eacute;</td>
        <td><?=$secteur_scap->surf_zones_activites?></td>
    </tr>     
</table>
<h3 class="spip">Protections environnementales&nbsp;:</h3>
<table  class="spip">
    <tr class="row_first">
        <th>Type</th>
        <th>Surface (ha)</th>
    </tr>
    <tr>
        <td>Aires de Protections de Biotope (APB)</td>
        <td><?=$secteur_scap->surf_apb?></td>
    </tr>
    <tr>
        <td>R&eacute;serves Naturelles Nationales (RNN)</td>
        <td><?=$secteur_scap->surf_rnn?></td>
    </tr>     
    <tr>
        <td>R&eacute;serves Naturelles R&eacute;gionales (RNR)</td>
        <td><?=$secteur_scap->surf_rnr?></td>
    </tr>
    <tr>
        <td>R&eacute;serves Biologiques (RB)</td>
        <td><?=$secteur_scap->surf_rb?></td>
    </tr> 
    <tr>
        <td>Sites classés</td>
        <td><?=$secteur_scap->surf_sc?></td>
    </tr> 
    <tr>
        <td><abbr title="Zones Naturelle d'Intérêt Ecologique, Faunistique et Floristique">ZNIEFF</abbr> de type 1</td>
        <td><?=$secteur_scap->surf_znieff1?></td>
    </tr> 
    <tr>
        <td><abbr title="Zones Naturelle d'Intérêt Ecologique, Faunistique et Floristique">ZNIEFF</abbr> de type 2</td>
        <td><?=$secteur_scap->surf_znieff2?></td>
    </tr> 
    <tr>
        <td>R&eacute;servoirs Biologiques du 
            <abbr title ="Schéma Régional de Cohérence Ecologique">SRCE</abbr>
        </td>
        <td><?=$secteur_scap->surf_srce?></td>
    </tr> 
    <tr>
        <td>Natura 2000</td>
        <td><?=$secteur_scap->surf_natura2000?></td>
    </tr> 
    <tr>
        <td>Natura 2000 + Sites classés</td>
        <td><?=$secteur_scap->surf_natura2000_sc?></td>
    </tr>
    <?php if(($departement->id_departement = '44') OR ($departement->id_departement = '85')): ?>
    <tr>
        <td>Espaces Naturels Sensibles (ENS)</td>
        <td><?=$secteur_scap->surf_ens_44_85?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Sites du 
            <abbr title="Conservatoire de l'Espace Littoral et des Rivages Lacustres">CELRL</abbr>
        </td>
        <td><?=$secteur_scap->surf_celrl?></td>
    </tr>     
</table>
<h3 class="spip">Autres indicateurs&nbsp;:</h3>
<table  class="spip">
    <tr class="row_first">
        <th>Type</th>
        <th>Surface (ha)</th>
    </tr>
    <tr>
        <td>Prairies permanentes</td>
        <td><?=$secteur_scap->surf_pp_rpg?></td>
    </tr>
    <tr>
        <td>Roseli&egrave;res</td>
        <td><?=$secteur_scap->surf_roseliere?></td>
    </tr>
</table>