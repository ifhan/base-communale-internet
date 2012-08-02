<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/StationTemperature.class.php';

$stations_temperature = getStationsTemperatures();
?>
<p>
    <strong><?=count($stations_temperature)?> stations</strong> 
    recens&eacute;es en Pays de la Loire.
</p>
<br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>D&eacute;partement</th>
            <th>Identifiant</th>
            <th>Cours d'eau</th>
            <th>Nom de la station</th>
            <th>Date de mise en service</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($stations_temperature as $station_temperature): ?>
        <tr valign="top">
            <td align="center"><?=$station_temperature["id_dpt"]?></td>
            <td align="center"><?=$station_temperature["id_station"]?></td>
            <td><?=stripslashes($station_temperature["riviere"])?></td>
            <td><?=$station_temperature["commune"]?> (<?=$station_temperature["id_commune"]?>) <?=$station_temperature["localite"]?></td>
            <td><?=date("d/m/Y", strtotime($station_temperature["en_service"]))?></td>
            <td>
                <a href="spip.php?page=fiche_station_temperature&id_station=<?=$station_temperature["id_station"]?>"><img src="IMG/png/system-search.png" alt="Icone afficher la fiche du zonage" /></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
