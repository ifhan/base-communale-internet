<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/SiteNatura.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$site_natura = new SiteNatura();
$site_natura->getSiteNaturaByIdRegionalIdType($id_regional, $id_type);

$departements = getDepartementsByIdRegional($id_regional);

$amphibiens_reptiles = getAmpbhibiensReptilesByIdRegional($id_regional);
$invertebres = getInvertebresByIdRegional($id_regional);
$mammiferes = getMammiferesByIdRegional($id_regional);
$plantes = getPlantesByIdRegional($id_regional);
$poissons = getPoissonsByIdRegional($id_regional);
$autres_especes = getAutresEspecesByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$site_natura->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$site_natura->id_regional?></strong></td>
    </tr>
    <?php if(!empty($site_natura->date_transmission)):?>
    <tr>
        <td>Date de transmission&nbsp;:</td>
        <td>
            <strong><?=$site_natura->date_transmission?></strong>
        </td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($site_natura->date_designation)): ?>
    <tr>
        <td>Date de d&eacute;signation&nbsp;:</td>
        <td><strong><?=$site_natura->date_designation?></strong></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td><strong><?=$site_natura->surf_sig_l93?> ha</strong></td>
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
<?php
/**
 *  Affichage des espèces recensées sur le zonage
 */
/**
 *  1. Amphibiens & reptiles
 */
?>
<?php if(count($amphibiens_reptiles) > 0): ?>
<h3 class="spip">Amphibiens et reptiles&nbsp;:</h3>
<table>
    <tr>
        <th>Code  | Nom | Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($amphibiens_reptiles as $amphibien_reptile): ?>
    <tr bgcolor="<?= switchColor() ?>">
        <td>
            <?= $amphibien_reptile["SPECNUM"] ?> | 
            <em><?= $amphibien_reptile["SPECNAME"] ?></em> | 
            <?php if($amphibien_reptile["ANNEX_II"]=='Y'): ?>
            Oui
            <?php endif ?>
            <?php if($amphibien_reptile["ANNEX_II"]==''): ?>
            Non
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br />
<?php endif; ?>
<?php
/**
 * 2. Invertébrés
 */
?>
<?php if(count($invertebres) > 0): ?>
<h3 class="spip">Invert&eacute;br&eacute;s&nbsp;:</h3>
<table>
    <tr>
        <th>Code  | Nom | Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($invertebres as $invertebre): ?>
    <tr bgcolor="<?= switchColor() ?>">
        <td>
            <?= $invertebre["SPECNUM"] ?> | 
            <em><?= $invertebre["SPECNAME"] ?></em> | 
            <?php if($invertebre["ANNEX_II"]=='Y'): ?>
            Oui
            <?php endif ?>
            <?php if($invertebre["ANNEX_II"]==''): ?>
            Non
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br />
<?php endif; ?>
<?php 	
/**
 *  3. Mammifères
 */
?>		
<?php if(count($mammiferes) > 0): ?>
<h3 class="spip">Mammif&egrave;res&nbsp;:</h3>
<table>
    <tr>
        <th>Code  | Nom | Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($mammiferes as $mammifere): ?>
    <tr bgcolor="<?= switchColor() ?>">
        <td>
            <?= $mammifere["SPECNUM"] ?> | 
            <em><?= $mammifere["SPECNAME"] ?></em> | 
            <?php if($mammifere["ANNEX_II"]=='Y'): ?>
            Oui
            <?php endif ?>
            <?php if($mammifere["ANNEX_II"]==''): ?>
            Non
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br />
<?php endif; ?>
<?php
/**
 *  4. Plantes
 */
?>
<?php if(count($plantes) > 0): ?>
<h3 class="spip">Plantes&nbsp;:</h3>
<table>
    <tr>
        <th>Code  | Nom | Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($plantes as $plante): ?>
    <tr bgcolor="<?= switchColor() ?>">
        <td>
            <?= $plante["SPECNUM"] ?> | 
            <em><?= $plante["SPECNAME"] ?></em> | 
            <?php if($plante["ANNEX_II"]=='Y'): ?>
            Oui
            <?php endif ?>
            <?php if($plante["ANNEX_II"]==''): ?>
            Non
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br />
<?php endif; ?>
<?php
/**
 *  5. Poissons
 */
?>
<?php if(count($poissons) > 0): ?>
<h3 class="spip">Poissons&nbsp;:</h3>
<table>
    <tr>
        <th>Code  | Nom | Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($poissons as $poisson): ?>
    <tr bgcolor="<?= switchColor() ?>">
        <td>
            <?= $poisson["SPECNUM"] ?> | 
            <em><?= $poisson["SPECNAME"] ?></em> | 
            <?php if($poisson["ANNEX_II"]=='Y'): ?>
            Oui
            <?php endif ?>
            <?php if($poisson["ANNEX_II"]==''): ?>
            Non
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br />
<?php endif; ?>
<?php
/**
 *  6. Autres espèces
 */
?>
<?php if(count($autres_especes) > 0): ?>
<h3 class="spip">Autres esp&egrave;ces&nbsp;:</h3>
<table>
    <tr>
        <th>Nom | Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($autres_especes as $autre_espece): ?>
    <tr bgcolor="<?= switchColor() ?>">
        <td>
            <em><?= $autre_espece["SPECNAME"] ?></em> | 
            <?php if($autre_espece["ANNEX_II"]=='Y'): ?>
            Oui
            <?php endif ?>
            <?php if($autre_espece["ANNEX_II"]==''): ?>
            Non
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br />
<?php endif; ?>