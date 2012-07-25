<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Rnn.class.php';
require_once 'classes/Zonage.class.php';

/**
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$rnn = new Rnn();
$rnn->getRnnById($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType($id_type);

$rnn_photos = getRnnPhotosByIdRegional($id_regional);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$rnn->nom?></strong></td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td><strong><?=$rnn->id_regional?></strong></td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td><strong><?=$rnn->id_national?></strong></td>
    </tr>
    <tr>
        <td>Surface calcul&eacute;e dans le SIG&nbsp;:</td>
        <td><strong><?=$rnn->surf_sig_l93?> ha</strong></td>
    </tr>
    <tr>
        <td>D&eacute;cret&nbsp;:</td>
        <td>
            <strong>n&deg; <?=$rnn->id_decret?> du 
                <?=$rnn->date?>
            </strong>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><?=$rnn->commentaire_decret?></td>
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
        <?php foreach ($rnn_photos as $rnn_photo): ?>
        <div class="mosaique">
            <div class="image" align="center">
                <a class="group" rel="fancybox-button" href="data/photos/<?=$zonage->path?>/<?=$rnn_photo["id_photo"]?>.jpg" title="<?php 
                if($rnn_photo["titre"]!="") { echo $rnn_photo["titre"]." - "; }
		if($rnn_photo["auteur"]!="") { echo $rnn_photo["auteur"]; }
		if($rnn_photo["fournisseur"]!="") { echo " &copy;".$rnn_photo["fournisseur"]; }
                ?>">
                    <img src="data/photos/<?=$zonage->path?>_small/<?=$rnn_photo["id_photo"]?>_small.jpg" alt="<?=$rnn_photo["titre"]?> - <?=$rnn_photo["id"]?> (<?=$rnn_photo["resolution"]?>)"/>
                </a>
            </div>
            <div class="link-paysage">
		<?php if(!empty($rnn_photo["auteur"])): ?>
                    <?=$rnn_photo["auteur"]?>
                <?php endif; ?>
		<?php if(!empty($rnn_photo["fournisseur"])): ?>
                &copy;<?=$rnn_photo["fournisseur"]?>
                <?php endif; ?>
		<?php if(!empty($rnn_photo["commentaire"])): ?>
                , <?=$rnn_photo["commentaire"]?>
                <?php endif; ?>
            </div>
            <div class="link-paysage">
                <?php		
		$exif = exif_read_data('data/photos/'.$zonage->path.'/'.$rnn_photo["id_photo"].'.jpg', 'IFD0');
		echo $exif===false ? "Aucun en-t&ecirc;te de donn&eacute;s n'a &eacute;t&eacute; trouv&eacute;e.<br />\n" : "";
		$exif = exif_read_data('data/photos/'.$zonage->path.'/'.$rnn_photo["id_photo"].'.jpg', 0, true);		
		echo "Date de prise de vue : " . date("d/m/Y", strtotime($exif['IFD0']['DateTime'])) ."<br />\n";
		echo "R&eacute;solution : " . $exif['COMPUTED']['Width'] . "x" . $exif['COMPUTED']['Height'] ."<br />\n";
		echo "Type de fichier : " . $exif['FILE']['MimeType'] . "<br />\n";
		echo "Taille du fichier : ";
		echo ConvertirTaille('data/photos/'.$zonage->path.'/'.$rnn_photo["id_photo"].'.jpg');
		?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>