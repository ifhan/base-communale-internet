<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Zhim.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$zhim = new Zhim();
$zhim->getZhimByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$zhim->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$zhim->id_regional?></strong></td>
    </tr>
    <tr>
        <td valign="top">D&eacute;partement(s)&nbsp;: </td>
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
<?php if($zhim->presentation!=""):?>
<h3 class="spip">Pr&eacute;sentation des milieux, des activit&eacute;s&nbsp;:</h3>
<p><?=$zhim->presentation?></p>
<?php endif; ?>
<?php if(($zhim->enjeux!="")OR($zhim->actions!="")):?>
<h3 class="spip">
    Identification des enjeux, actions en cours, actions &agrave; mener&nbsp;:
</h3>
<?php endif; ?>
<?php if($zhim->enjeux!=""):?>
<p><strong>Enjeux&nbsp;:</strong></p>
<p><?=$zhim->enjeux?></p>
<?php endif; ?>
<?php if($zhim->actions!=""):?>
<p><strong>Actions&nbsp;:</strong></p>
<p><?=$zhim->actions?></p>
<?php endif; ?>
<?php if(($zhim->geologie!="")OR($zhim->hydrologie!="")):?>
<h3 class="spip">Caract&eacute;ristiques physiques et hydrologiques&nbsp;:</h3>
<?php endif; ?>
<?php if($zhim->geologie!=""):?>
<p><strong>G&eacute;ologie - formation - p&eacute;dologie&nbsp;:</strong></p>
<p><?=$zhim->geologie?></p>
<?php endif; ?>
<?php if($zhim->hydrologie!=""):?>
<p><strong>Hydrologie et milieu physique&nbsp;:</strong></p>
<p><?=$zhim->hydrologie?></p>
<?php endif; ?>
<?php if(($zhim->eutrophisation!="")OR($zhim->autres!="")):?>
<h3 class="spip">Qualit&eacute; des eaux&nbsp;:</h3>
<?php endif; ?>
<?php if($zhim->eutrophisation!=""):?>
<p><strong>Eutrophisation et &eacute;l&eacute;ments nutritifs&nbsp;:</strong></p>
<p><?=$zhim->eutrophisation?></p>
<?php endif; ?>
<?php if($zhim->autres!=""):?>
<p><strong>Autres&nbsp;:</strong></p>
<p><?=$zhim->autres?></p>
<?php endif; ?>
<?php if($zhim->occupation_sol!=""):?>
<h3 class="spip">Occupation du sol et activit&eacute;s humaines&nbsp;:</h3>
<p><?=$zhim->occupation_sol?></p>
<?php endif; ?>
<?php if(($zhim->faune_flore!="")OR($zhim->habitats!="")OR($zhim->paysage!="")):?>
<h3 class="spip">Faune, flore et milieux naturels&nbsp;:</h3>
<?php endif; ?>
<?php if($zhim->faune_flore!=""):?>
<p><?=$zhim->faune_flore?></p>
<?php endif; ?>
<?php if($zhim->habitats!=""):?>
<p><strong>Diversit&eacute; des habitats&nbsp;:</strong></p>
<br />
<p><?=$zhim->habitats?></p>
<?php endif; ?>
<?php if($zhim->paysage!=""):?>
<p><strong>Valeur paysag&egrave;re&nbsp;:</strong></p>
<br />
<p><?=$zhim->paysage?></p>
<?php endif; ?>
<?php if($zhim->contexte!=""):?>
<h3 class="spip">Contexte institutionnel et r&eacute;glementaire&nbsp;:</h3>
<p><?=$zhim->contexte?></p>
<?php endif; ?>
<?php if($zhim->bibliographie!=""):?>
<h3 class="spip">Bibliographie&nbsp;:</h3>
<p><?=$zhim->bibliographie?></p>
<?php endif; ?>