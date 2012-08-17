<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Departement.class.php';

/**
 * Ce fichier sert à afficher un tableau des départements de la région ainsi que
 * les liens de visualisation et de téléchargement des vidéos correspondantes
 */

$id_region = "18";
$departements = getDepartementsByIdRegion($id_region);
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
        <?php foreach ($departements as $departement): ?>
        <tr valign="top">
            <td><?=$departement["nom_departement"]?></td>
            <td align="center">
                <a href="spip.php?page=popup_video&id_dpt=<?=$departement["id_departement"]?>" target="_blank"><img src="IMG/png/gtk-media-play-ltr.png" style="border:none" alt="Lire" /></a>
            </td>
            <td align="center">
                <a href="http://www.donnees.pays-de-la-loire.developpement-durable.gouv.fr/data/videos/tache_urbaine/<?=$departement["id_departement"]?>.ogg"><img src="IMG/png/filesave.png" style="border:none" alt="T&eacute;l&eacute;charger" /></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>