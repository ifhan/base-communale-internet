<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/StationTemperature.class.php';
require_once 'classes/Zonage.class.php';

/**
 * @var $id_station Identifiant de la station
 */
$id_station = $_REQUEST["id_station"];

$station_temperature = new StationTemperature();
$station_temperature->getStationTemperatureByIdStation($id_station);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType("28");
?>
<div text="top">
    <table>
        <tr>
            <td style="vertical-align:bottom;">
                <img src="IMG/png/gnome-globe.png" style="border:none" alt="Icone web" />
            </td>
            <td>
                <a href="<?=URL_CARMEN?><?=$zonage->map?>.map&object=stations_temperature_rcs;id_station;04<?=$id_station?>" target="_blank">Consulter la localisation de la station sur CARMEN</a>.   
            </td>
        </tr>
    </table>
</div>
<h3 class="spip">Principales caract&eacute;ristiques de la station :</h3>
<table class="spip">
    <thead>
        <tr class="row_first">
            <th>Identifiant</th>
            <th>Cours d'eau</th>
            <th>Nom de la station</th>
            <th>Date de mise en service</th>
        </tr>
    </thead>
    <tbody>
        <tr valign="top">
            <td><?=$station_temperature->id_station?></td>
            <td><?=$station_temperature->riviere?></td>
            <td><?=$station_temperature->commune?> (<?=$station_temperature->id_commune?>) <?=$station_temperature->localite?></td>
            <td><?=$station_temperature->en_service?></td>
        </tr>
    </tbody>
</table>
<div class="listedoc">
    <h3>T&eacute;l&eacute;charger :</h3>
    <ul>
<?php
$dir = "data/fiches/temperature/";
/**
 *  Ouvre un dossier bien connu, et liste tous les fichiers
 */
if(@is_dir($dir)):
    if($dh = @opendir($dir)):
        while(($file = @readdir($dh)) !== false):
            if($file != "." && $file != ".."):
                if (file_exists("data/fiches/temperature/$file/" . $id_station . ".pdf")): ?>
        <li>
            <a class="document" 
               href="data/fiches/temperature/<?=$file?>/<?=$id_station?>.pdf" target="_blank">Temp&eacute;ratures en continu en <?=$file?></a>
            <span class=docformat>
                <em>
                    (PDF, <?=@ConvertirTaille("data/fiches/temperature/$file/" . $id_station . ".pdf")?>)
                </em>
            </span>
        </li>
            <?php endif;
            endif;
        endwhile;
        closedir($dh);
    endif;
endif;
?>
    </ul>
</div>