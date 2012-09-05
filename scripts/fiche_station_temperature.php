<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/StationTemperature.class.php';
require_once 'classes/Zonage.class.php';

/**
 * Ce fichier sert à afficher l'ensemble des fichiers PDF concernant la station
 * @var $code_hydro Identifiant de la station
 */
$code_hydro = $_REQUEST["code_hydro"];

$station_temperature = new StationTemperature();
$station_temperature->getStationTemperatureByIdStation($code_hydro);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType("28");
?>
<div text="top">
    <table>
        <tr>
            <td style="vertical-align:bottom;">
                <img src="IMG/png/gnome-globe.png" 
                     style="border:none" 
                     alt="Icone web" />
            </td>
            <td>
                <a href="<?=URL_CARMEN?><?=$zonage->map?>.map&object=stations_temperature_rcs;code_hydro;04<?=$code_hydro?>" 
                   target="_blank">Consulter la localisation de la station sur CARMEN</a>.   
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
            <td><?=$station_temperature->code_hydro?></td>
            <td><?=$station_temperature->riviere?></td>
            <td><?=$station_temperature->commune?> (<?=$station_temperature->id_commune?>) <?=$station_temperature->localite?></td>
            <td><?=$station_temperature->mise_en_service?></td>
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
                if (file_exists("data/fiches/temperature/$file/" . $code_hydro . ".pdf")): ?>
        <li>
            <a class="document" 
               href="data/fiches/temperature/<?=$file?>/<?=$code_hydro?>.pdf" 
               target="_blank">Temp&eacute;ratures en continu en <?=$file?></a>
            <span class="docformat">
                <em>
                    (PDF, <?=@convertFilesize("data/fiches/temperature/$file/" . $code_hydro . ".pdf")?>)
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