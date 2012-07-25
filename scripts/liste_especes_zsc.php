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
        <th>Code  / Nom / Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($amphibiens_reptiles as $amphibien_reptile): ?>
    <tr bgcolor="<?= switchcolor() ?>">
        <td>
            <?= $amphibien_reptile["SPECNUM"] ?> / 
            <em><?= $amphibien_reptile["SPECNAME"] ?></em> / 
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
        <th>Code  / Nom / Esp&egrave;ce de l'annexe 2</th>
    </tr>
    <?php foreach ($invertebres as $invertebre): ?>
    <tr bgcolor="<?= switchcolor() ?>">
        <td>
            <?= $invertebre["SPECNUM"] ?> / 
            <em><?= $invertebre["SPECNAME"] ?></em> / 
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
		
$query = "SELECT * FROM natura_mammal WHERE SITECODE = '$id_regional'";
$result = mysql_query($query);
$nombre = mysql_num_rows($result);

if ($nombre != "0") {

    echo "<h3 class=spip>Mammif&egrave;res&nbsp;:</h3><table><tr><td valign=top>";

    $query = "SELECT * FROM natura_mammal WHERE SITECODE ='$id_regional'
		AND ANNEX_II = 'Y' ORDER BY SPECNUM";
    $result = mysql_query($query);

    echo "<table><tr><th>Esp&egrave;ces de l'annexe 2&nbsp;:</th></tr>";

    while ($val = mysql_fetch_array($result)) {
        echo "<tr><td valign=top bgcolor='" . switchcolor() . "'>" . $val["SPECNUM"] . " " . utf8_encode($val["SPECNAME"]) . "</td></tr>";
    }

    echo "</table></td><td valign=top>";

    $query = "SELECT * FROM natura_mammal WHERE SITECODE = '$id_regional'
		AND ANNEX_II = '' ORDER BY SPECNUM";
    $result = mysql_query($query);

    echo "<table><tr><th>Autres esp&egrave;ces&nbsp;:</th></tr>";

    while ($val = mysql_fetch_array($result)) {
        echo "<tr><td valign=top bgcolor='" . switchcolor() . "'>" . $val["SPECNUM"] . " " . utf8_encode($val["SPECNAME"]) . "</td></tr>";
    }

    echo "</table></td></tr></table><br />";
}

/**
 *  4. Plantes
 */

$query = "SELECT * FROM natura_plant WHERE SITECODE = '$id_regional'";
$result = mysql_query($query);
$nombre = mysql_num_rows($result);

if ($nombre != "0") {

    echo "<h3 class=spip>Plantes&nbsp;:</h3><table><tr><td valign=top>";

    $query = "SELECT * FROM natura_plant WHERE SITECODE = '$id_regional'
		AND ANNEX_II = 'Y' ORDER BY SPECNUM";
    $result = mysql_query($query);

    echo "<table><tr><th>Esp&egrave;ces de l'annexe 2&nbsp;:</th></tr>";

    while ($val = mysql_fetch_array($result)) {
        echo "<tr><td valign=top bgcolor='" . switchcolor() . "'>" . $val["SPECNUM"] . " " . utf8_encode($val["SPECNAME"]) . "</td></tr>";
    }

    echo "</table></td><td valign=top>";

    $query = "SELECT * FROM natura_plant WHERE SITECODE = '$id_regional'
		AND ANNEX_II = '' ORDER BY SPECNUM";
    $result = mysql_query($query);

    echo "<table><tr><th>Autres esp&egrave;ces&nbsp;:</th></tr>";

    while ($val = mysql_fetch_array($result)) {
        echo "<tr><td valign=top bgcolor='" . switchcolor() . "'>" . $val["SPECNUM"] . " " . utf8_encode($val["SPECNAME"]) . "</td></tr>";
    }

    echo "</table></td></tr></table><br />";
}

/**
 *  5. Poissons
 */

$query = "SELECT * FROM natura_fishes WHERE SITECODE = '$id_regional'";
$result = mysql_query($query);
$nombre = mysql_num_rows($result);

if ($nombre != "0") {

    echo "<h3 class=spip>Poissons&nbsp;:</h3><table><tr><td valign=top>";

    $query = "SELECT * FROM natura_fishes WHERE SITECODE = '$id_regional'
		AND ANNEX_II = 'Y' ORDER BY SPECNUM";
    $result = mysql_query($query);

    echo "<table><tr><th>Esp&egrave;ces de l'annexe 2&nbsp;:</th></tr>";

    while ($val = mysql_fetch_array($result)) {
        echo "<tr><td valign=top bgcolor='" . switchcolor() . "'>" . $val["SPECNUM"] . " " . utf8_encode($val["SPECNAME"]) . "</td></tr>";
    }

    echo "</table></td><td valign=top>";

    $query = "SELECT * FROM natura_fishes WHERE SITECODE = '$id_regional'
		AND ANNEX_II = '' ORDER BY SPECNUM";
    $result = mysql_query($query);

    echo "<table><tr><th>Autres esp&egrave;ces&nbsp;:</th></tr>";

    while ($val = mysql_fetch_array($result)) {
        echo "<tr><td valign=top bgcolor='" . switchcolor() . "'>" . $val["SPECNUM"] . " " . utf8_encode($val["SPECNAME"]) . "</td></tr>";
    }

    echo "</table></td></tr></table><br />";
}

/**
 *  6. Autres espèces
 */

$query = "SELECT * FROM natura_spec WHERE SITECODE = '$id_regional'";
$result = mysql_query($query);
$nombre = mysql_num_rows($result);

if ($nombre != "0") {

    echo "<h3 class=spip>Autres&nbsp;:</h3>";

    $query = "SELECT * FROM natura_spec WHERE SITECODE = '$id_regional' ORDER BY SPECNAME";
    $result = mysql_query($query);

    echo "<table>";

    while ($val = mysql_fetch_array($result)) {
        echo "<tr><td valign=top bgcolor='" . switchcolor() . "'>" . $val["SPECNUM"] . " " . utf8_encode($val["SPECNAME"]) . "</td></tr>";
    }

    echo "</table>";
}
?>