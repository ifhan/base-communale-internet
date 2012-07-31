<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Commune.class.php';

/**
 * Ce fichier sert à afficher un tableau des communes du département ainsi que
 * les liens de visualisation et de téléchargement des vidéos correspondantes
 * @var  $id_dpt Code géographique du département
 */
$id_dpt = $_REQUEST["id_dpt"];

$communes = getCommunesByIdDpt($id_dpt);
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Nom (Code g&eacute;ographique)</th>
            <th align="center">Lire</th>
            <th align="center">T&eacute;l&eacute;charger</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($communes as $commune):
        /**
         *  
         */
        ?>
        <tr valign="top">
            <td><?=$commune["nom_commune"]?> (<?=$commune["id_commune"]?>)</td>
            <td align="center">
                <a href="spip.php?page=popup_video&commune=<?=$commune["id_commune"]?>" target="_blank"><img src="IMG/png/gtk-media-play-ltr.png" style="border:none" alt="Lire" /></a>
            </td>
            <td align="center">
                <a href="<?=URL_BASE_COMMUNALE?>data/videos/tache_urbaine/<?=$commune["id_commune"]?>.ogg"><img src="IMG/png/filesave.png" style="border:none" alt="T&eacute;l&eacute;charger" /></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>