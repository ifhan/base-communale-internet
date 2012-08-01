<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/StationQualite.class.php';
require_once 'classes/Zonage.class.php';

/**
 * Ce fichier sert à afficher un tableau listant les stations par rivière et 
 * par département ou pour l'ensemble de la région
 * @var $id_dpt Code géographique du département
 * @var $id_riviere Identifiant de la rivière
 */
$id_dpt = $_REQUEST["id_dpt"];
$id_riviere = $_REQUEST["id_riviere"];

$stations_qualite = getStationsQualiteByIdDptByIdRiviere($id_dpt, $id_riviere);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType("28");
?>
<p>
    <strong><?=count($stations_qualite)?> station(s)</strong> 
    recens&eacute;e(s) sur l'aire g&eacute;ographique choisie.
</p>
<br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom de la station</th>
            <th>R&eacute;seau</th>
            <th>Carte</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($stations_qualite as $station_qualite): ?>
        <tr valign="top">
            <td align="center"><?=$station_qualite["id_station"]?></td>
            <td width="99%">
                <?=stripslashes($station_qualite["nom_riviere"])?> <?=$station_qualite["nom_commune"]?> (<?=$station_qualite["id_commune"]?>), <?=$station_qualite["localite"]?>
            </td>
            <td align="center">
                <a href="spip.php?page=liste_stations_reseaux&amp;id_reseau=<?=$station_qualite["id_reseau"]?>&id_dpt=<?=$station_qualite["id_id_dpt"]?>">
                   <?php
                   if ($station_qualite["id_reseau"] == 1):
                   echo "RCS";
                   elseif ($station_qualite["id_reseau"] == 2):
                   echo "RNB";
                   endif;
                   ?>
                </a>
            </td>
            <td class="cache">
                <div class="logo" align="right">
                    <a href="<?=URL_CARMEN?><?=$zonage->map?>.map&object=stations_qualite_rcs;id_station;04<?=$station_qualite["id_station"]?>" target="_blank"><img src="IMG/png/Gnome-Emblem-Web-32.png" style="border:none" alt="Icone web" /></a>
                </div>
            </td>
            <td class=cache>
                <div class=right>
                    <a href="spip.php?page=fiche_station_qualite&amp;station=<?=$station_qualite["id_station"]?>&id_reseau=<?=$station_qualite["id_reseau"]?>"><img src="IMG/png/system-search.png" alt="Lien vers la ressource"/></a>
                    <br />
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
