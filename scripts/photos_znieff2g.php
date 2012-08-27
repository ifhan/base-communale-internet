<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Znieff2G.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$znieff2g = new Znieff2G();
$znieff2g->getZnieff2GByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);

$znieff2g_photos = getZnieff2GPhotosByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td>
            <strong><?=$znieff2g->nom?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td>
            <strong><?=$znieff2g->id_regional?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td>
            <strong><?=$znieff2g->id_national?></strong>
        </td>
    </tr>
    <tr>
        <td>Type de zone&nbsp;:</td>
        <td>
            <strong><?=$znieff2g->TY_ZONE?></strong>
        </td>
    </tr>		
    <tr>
        <td>Ann&eacute;e de 1&egrave;re description&nbsp;:</td>
        <td>
            <strong> 
                <?php
                $date = $znieff2g->AN_DESCRIP;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
                ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de mise &agrave; jour&nbsp;:</td>
        <td>
            <strong> 
                <?php
                $date = $znieff2g->AN_MAJ;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
                ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de validation MNHN&nbsp;:</td>
        <td>
            <strong>
                <?php
                $date = $znieff2g->AN_SFF;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
                ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Altitude&nbsp;:</td>
        <td>
            <strong>
                <?php echo $znieff2g->ALT_MINI . " - " . $znieff2g->ALT_MAXI . " m" ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Surface d&eacute;clar&eacute;e&nbsp;:</td>
        <td>
            <strong><?=$znieff2g->SU_ZN?> ha</strong>
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
        <?php foreach($znieff2g_photos as $znieff2g_photo): ?>   
        <div class="mosaique">
            <div class="image" align="center">
                <a class="group" 
                   rel="fancybox-button" 
                   href="data/photos/znieff2g/<?=$znieff2g_photo["id_photo"]?>.jpg" 
                   title="<?php 
                if ($znieff2g_photo["titre"] != "") { echo $znieff2g_photo["titre"] . " - "; }
                if ($znieff2g_photo["auteur"] != "") { echo $znieff2g_photo["auteur"]; }
                if ($znieff2g_photo["fournisseur"] != "") { echo " &copy;" . utf8_encode($znieff2g_photo["fournisseur"]); }
                ?>">
                    <img src="data/photos/znieff2g_small/<?=$znieff2g_photo["id_photo"]?>_small.jpg" alt="<?=$znieff2g_photo["titre"]?> - <?=$znieff2g_photo["id"]?> (<?=$znieff2g_photo["resolution"]?>)"/>
                </a>
            </div>
            <div class="link-paysage">
                <?php if ($znieff2g_photo["auteur"] != ""): ?>
                    <?=$znieff2g_photo["auteur"]?>
                <?php endif; ?>
                <?php if ($znieff2g_photo["fournisseur"] != ""): ?>
                    &copy;<?=$znieff2g_photo["fournisseur"]?>
                <?php endif; ?>
                <?php if ($znieff2g_photo["commentaire"] != ""): ?>
                    , <?=$znieff2g_photo["commentaire"]?>
                <?php endif; ?>
            </div>
            <div class="link-paysage">
                <?php
                $exif = exif_read_data('data/photos/znieff2g/' . $znieff2g_photo["id_photo"] . '.jpg', 'IFD0');
                echo $exif === false ? "Aucun en-t&ecirc;te de donn&eacute;s n'a &eacute;t&eacute; trouv&eacute;e.<br />\n" : "";
                $exif = exif_read_data('data/photos/znieff2g/' . $znieff2g_photo["id_photo"] . '.jpg', 0, true);
                echo "Date de prise de vue : " . date("d/m/Y", strtotime($exif['IFD0']['DateTime'])) . "<br />\n";
                echo "R&eacute;solution : " . $exif['COMPUTED']['Width'] . "x" . $exif['COMPUTED']['Height'] . "<br />\n";
                echo "Type de fichier : " . $exif['FILE']['MimeType'] . "<br />\n";
                echo "Taille du fichier : ";
                echo convertFilesize('data/photos/znieff2g/' . $znieff2g_photo["id_photo"] . '.jpg');
                ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>