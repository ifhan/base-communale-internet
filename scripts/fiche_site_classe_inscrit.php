<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/SiteClasseInscrit.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$site_classe_inscrit = new SiteClasseInscrit();
$site_classe_inscrit->getSiteClasseInscritDataByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);

$entites = getEntitesFromSiteByIdRegional($id_regional);
?>
<h3 class="spip"><?=$site_classe_inscrit->nom?></h3><br />
<?php foreach($entites as $entite): ?>
<table class="cadre_plein">
    <tr>
        <td width="30%">Nom de l'entit&eacute;&nbsp;:</td>
        <td><strong><?=$entite["nom_entite"]?></strong></td>
    </tr>
    <tr>
        <td>Identifiant de l'entit&eacute;&nbsp;:</td>
        <td><strong><?=$entite["id_sp"]?></strong></td>
    </tr>
    <tr>
        <td>Type de protection&nbsp;:</td>
        <td>
            <strong>
                <?php if ($entite["type_site"]=="SC"): ?>
                Site class&eacute;
                <?php elseif ($entite["type_site"]=="SI"): ?>
                Site inscrit
                <?php elseif ($entite["type_site"]=="ZP"): ?>
                Zone de protection
                <?php endif; ?>
            </strong>
        </td>
    </tr>
    <?php if(!empty($entite["texte_protection"])): ?>
    <tr>
        <td>Texte de protection&nbsp;:</td>
        <td>
            <strong><?=$entite["texte_protection"]?></strong>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Date de protection&nbsp;:</td>
        <td>
            <strong>
                <?php echo date("d/m/Y", strtotime($entite["date"])); ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td>
            <strong><?=$entite["surf_sig_l93"]?> ha</strong>
        </td>
    </tr>
    <?php if(!empty($entite["typologie"])): ?>
    <tr>
        <td>Typologie&nbsp;:</td>
        <td>
            <strong><?=$entite["typologie"]?></strong>
        </td>
    </tr>
    <?php endif; ?>		
</table>
<br />
<?php endforeach; ?>
<h3 class="spip">D&eacute;partement(s)&nbsp;:</h3>
<p><?=$departement->nom_departement?> (<?=$departement->id_departement?>)</p>
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<?php $id_type="13"; ?>
<?php require_once 'inc/commune.inc.php'; ?>
<?php if(!empty($site_classe_inscrit->commentaires)): ?>
<h3 class=spip>Commentaires&nbsp;:</h3>
<p><?=$site_classe_inscrit->commentaires?></p>
<?php endif; ?>
<?php if(!empty($site_classe_inscrit->sources)): ?>
<h3 class=spip>El&eacute;ments bibliographiques&nbsp;:</h3>
<p><?=$site_classe_inscrit->sources?></p>
<?php endif; ?>