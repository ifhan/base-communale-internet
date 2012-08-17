<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Epci.class.php';

/**
 * Ce fichier sert à afficher un tableau des EPCI du département ainsi que
 * les liens de visualisation et de téléchargement des vidéos correspondantes
 * @var $id_dpt Code géographique du département
 */
$id_dpt = $_REQUEST["id_dpt"];

$array_epci = getEpciVideosByIdDpt($id_dpt);
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Nom</th>
            <th align="center">Lire</th>
            <th align="center">T&eacute;l&eacute;charger</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array_epci as $epci): ?>
        <tr valign="top">
            <td><?=$epci["nom_epci"]?></td>
            <td align="center">
                <a href="spip.php?page=popup_video&id_epci=<?=$epci["siren"]?>" target="_blank"><img src="IMG/png/gtk-media-play-ltr.png" style="border:none" alt="Lire" /></a>
            </td>
            <td align="center">
                <a href="<?=URL_BASE_COMMUNALE?>data/videos/tache_urbaine/<?=$epci["siren"]?>.ogg"><img src="IMG/png/filesave.png" style="border:none" alt="T&eacute;l&eacute;charger" /></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>