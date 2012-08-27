<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/SiteClasseInscrit.class.php';
require_once 'classes/Zonage.class.php';

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

$zonage = new Zonage();
$zonage->getTypeZonageByIdType($id_type);

$site_photos = getSiteClasseInscritPhotosByIdRegional($id_regional, $id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom du site&nbsp;:</td>
        <td><strong><?=$site_classe_inscrit->nom?></strong></td>
    </tr>
	<tr>
            <td>Identifiant r&eacute;gional&nbsp;:</td>
            <td><strong><?=$site_classe_inscrit->id_regional?></strong></td>
        </tr>
</table>
<h3 class="spip">D&eacute;partement(s)&nbsp;:</h3>
<p><?=$departement->nom_departement?> (<?=$departement->id_departement?>)</p>
<div class="textart">
    <h3 class="spip">Portfolio</h3>
    <hr class="hrart">
    <div id="documents_porfolio">
        <?php foreach ($site_photos as $site_photo): ?>
        <div class="mosaique">
            <div class="image" align="center">
                <a class="group" 
                   rel="fancybox-button" 
                   href="data/photos/<?=$zonage->path?>/<?=$site_photo["id_photo"]?>.jpg" 
                   title="<?php if($site_photo["titre"]!="") { echo $site_photo["titre"]." - "; }
		if($site_photo["auteur"]!="") { echo $site_photo["auteur"]; }
		if($site_photo["fournisseur"]!="") { echo " &copy;".$site_photo["fournisseur"]; } ?>">
                    <img src="data/photos/<?=$zonage->path?>_small/<?=$site_photo["id_photo"]?>_small.jpg" alt="<?=$site_photo["titre"]?> - <?=$site_photo["id"]?> (<?=$site_photo["resolution"]?>)"/></a>
            </div>
		<div class=link-paysage>
		    <?php if($site_photo["auteur"]!=""): ?> 
                        <?=$site_photo["auteur"]?>
                    <?php endif; ?>
                    <?php if($site_photo["fournisseur"]!=""): ?>
                        &copy;<?=$site_photo["fournisseur"]?> 
                    <?php endif; ?>
		    <?php if($site_photo["commentaire"]!=""):?> 
                        , <?=$site_photo["commentaire"]?>
                    <?php endif; ?>
		</div>
                <div class="link-paysage">
                    <?php 
                    $exif = exif_read_data('data/photos/' . $zonage->path . '/' . $site_photo["id_photo"] . '.jpg', 'IFD0');
                    echo $exif === false ? "Aucun en-t&ecirc;te de donn&eacute;s n'a &eacute;t&eacute; trouv&eacute;e.<br />\n" : "";
                    $exif = exif_read_data('data/photos/' . $zonage->path . '/' . $site_photo["id_photo"] . '.jpg', 0, true);
                    echo "Date de prise de vue : " . date("d/m/Y", strtotime($exif['IFD0']['DateTime'])) . "<br />\n";
                    echo "R&eacute;solution : " . $exif['COMPUTED']['Width'] . "x" . $exif['COMPUTED']['Height'] . "<br />\n";
                    echo "Type de fichier : " . $exif['FILE']['MimeType'] . "<br />\n";
                    echo "Taille du fichier : ";
                    echo convertFilesize('data/photos/' . $zonage->path . '/' . $site_photo["id_photo"] . '.jpg');
                    ?>	
                </div>
        </div>           
        <?php endforeach; ?>
    </div>
</div>