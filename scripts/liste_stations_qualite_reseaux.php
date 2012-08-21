<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/StationQualite.class.php';
require_once 'classes/Zonage.class.php';

/**
 * Ce fichier sert à afficher un tableau listant les stations par type de 
 * réseau, par département ou pour l'ensemble de la région
 * @var $id_reseau Identifiant du réseau
 * @var $id_dpt Code géographique du département
 */
$id_reseau = $_REQUEST["id_reseau"];
$id_dpt = $_REQUEST["id_dpt"];

$stations_qualite = getStationsQualiteByIdDptByIdReseau($id_dpt, $id_reseau);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType("28");
?>
<p>
    <strong><?=count($stations_qualite)?> stations</strong> 
    recens&eacute;es sur le r&eacute;seau choisi.
</p>
<br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>D&eacute;partement</th>
            <th>Identifiant</th>
            <th>Nom de la station</th>
            <th>Carte</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($stations_qualite as $station_qualite): ?>
        <tr valign="top">
            <td align="center"><?=$station_qualite["id_departement"]?></td>
            <td align="center"><?=$station_qualite["id_regional"]?></td>
            <td width="99%">
                <?=(stripslashes($station_qualite["nom"]))?> <?=$station_qualite["nom_commune"]?> (<?=$station_qualite["id_commune"]?>) <?=$station_qualite["localite"]?>
            </td>
            <td class="cache">
                <div class="right">
                    <a href="<?=URL_CARMEN?><?=$zonage->map?>.map&object=stations_qualite_rcs;id_regional;04<?=$station_qualite["id_regional"]?>" target="_blank"><img src="IMG/png/Gnome-Emblem-Web-32.png" style="border:none" alt="Icone web" /></a>
                </div>
            </td>
            <td class="cache">
                <div class="right">
                    <a href="spip.php?page=fiche_station_qualite&amp;id_regional=<?=$station_qualite["id_regional"]?>&id_reseau=<?=$station_qualite["id_reseau"]?>"><img src="IMG/png/system-search.png" alt="Icone afficher" /></a>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>