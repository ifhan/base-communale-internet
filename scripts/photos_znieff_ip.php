<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/ZnieffIp.class.php';
require_once 'classes/Zonage.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$znieff = new ZnieffIp();
$znieff->getZnieffIpByIdRegional($id_regional,$id_type);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);

$znieff_photos = getZnieffIpPhotosByIdRegional($id_regional,$id_type);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType($id_type);
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
        <td>Identifiant <abbr title="Mus&eacute;um National d'Histoire Naturelle">MNHN</abbr>&nbsp;:</td>
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
<div class="textart">
    <h3 class="spip">Portfolio</h3>
    <hr class="hrart">
    <div id="documents_porfolio">
        <?php foreach($znieff_photos as $znieff_photo): ?>   
        <div class="mosaique">
            <div class="image" align="center">
                <a class="group" 
                   rel="fancybox-button" 
                   href="data/photos/<?=$zonage->path?>/<?=$znieff_photo["id_photo"]?>.jpg" 
                   title="<?php 
                if ($znieff_photo["titre"] != "") { echo $znieff_photo["titre"] . " - "; }
                if ($znieff_photo["auteur"] != "") { echo $znieff_photo["auteur"]; }
                if ($znieff_photo["fournisseur"] != "") { echo " &copy;" . utf8_encode($znieff_photo["fournisseur"]); }
                ?>">
                    <img 
                        src="data/photos/<?=$zonage->path?>_small/<?=$znieff_photo["id_photo"]?>_small.jpg" 
                        alt="<?=$znieff_photo["titre"]?> - <?=$znieff_photo["id"]?> (<?=$znieff_photo["resolution"]?>)"/>
                </a>
            </div>
            <div class="link-paysage">
                <?php if ($znieff_photo["auteur"] != ""): ?>
                    <?=$znieff_photo["auteur"]?>
                <?php endif; ?>
                <?php if ($znieff_photo["fournisseur"] != ""): ?>
                    &copy;<?=$znieff_photo["fournisseur"]?>
                <?php endif; ?>
                <?php if ($znieff_photo["commentaire"] != ""): ?>
                    , <?=$znieff_photo["commentaire"]?>
                <?php endif; ?>
            </div>
            <div class="link-paysage">
                <?php
                $exif = exif_read_data('data/photos/' . $zonage->path . '/' . $znieff_photo["id_photo"] . '.jpg', 'IFD0');
                echo $exif === false ? "Aucun en-t&ecirc;te de donn&eacute;s n'a &eacute;t&eacute; trouv&eacute;e.<br />\n" : "";
                $exif = exif_read_data('data/photos/' . $zonage->path . '/' . $znieff_photo["id_photo"] . '.jpg', 0, true);
                echo "Date de prise de vue : " . date("d/m/Y", strtotime($exif['IFD0']['DateTime'])) . "<br />\n";
                echo "R&eacute;solution : " . $exif['COMPUTED']['Width'] . "x" . $exif['COMPUTED']['Height'] . "<br />\n";
                echo "Type de fichier : " . $exif['FILE']['MimeType'] . "<br />\n";
                echo "Taille du fichier : ";
                echo convertFilesize('data/photos/' . $zonage->path . '/' . $znieff_photo["id_photo"] . '.jpg');
                ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>