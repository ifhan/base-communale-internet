<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Zonage.class.php';

/**
 * Ce fichier sert à afficher les liens vers l'ensemble des fichiers PDF
 * concernant la station
 * @var Identifiant de la station
 */
$id_station = $_REQUEST["id_station"];

$zonage = new Zonage();
$zonage->getTypeZonageByIdType("28");
?>
<div text="top">
    <table>
        <tr>
            <td style="vertical-align:bottom;">
                <img src="IMG/png/gnome-globe.png" style="border:none" alt="Icone web">
            </td>
            <td>
                <a href="<?=URL_CARMEN?><?=$zonage->map?>.map&object=stations_qualite_rcs;id_station;04<?=$id_station?>" target="_blank">Consulter la localisation de la station sur CARMEN</a>.    
            </td>
        </tr>
    </table>
</div><br />
<?php
$dir = "data/fiches/qualite/";
/**
 *  Ouvre un dossier bien connu, et liste tous les fichiers
 */
if (@is_dir($dir)):
    if ($dh = @opendir($dir)):
        while (($file = @readdir($dh)) !== false):
            if ($file != "." && $file != ".."): ?>
<div class="listedoc">
    <?php if((file_exists("data/fiches/qualite/$file/Physico-chimie/" . $id_station . ".pdf")) || (file_exists("data/fiches/qualite/$file/Pesticides/" . $id_station . ".pdf"))): ?>
    <h3><?=$file?></h3>
    <?php endif; ?>
    <ul>
        <?php if(file_exists("data/fiches/qualite/$file/Physico-chimie/" . $id_station . ".pdf")): ?>
        <li><a class="document" 
               href="data/fiches/qualite/$file/Physico-chimie/<?=$id_station?>.pdf" target="_blank">Physico-chimie</a>
            <span class="docformat"> 
                <em>(PDF, <?=@ConvertirTaille("data/fiches/qualite/$file/Physico-chimie/" . $id_station . ".pdf")?>)</em>
            </span>
        </li>
        <?php endif; ?>
        <?php if(file_exists("data/fiches/qualite/$file/Pesticides/" . $id_station . ".pdf")):  ?>
        <li>
            <a class="document" 
               href="data/fiches/qualite/$file/Pesticides/<?=$id_station?>.pdf" target="_blank">Pesticides</a>
            <span class="docformat">
                <em>(PDF, <?=@ConvertirTaille("data/fiches/qualite/$file/Pesticides/" . $id_station . ".pdf")?>)</em>
            </span>
        </li>
        <?php endif; ?>
        <?php if(file_exists("data/fiches/qualite/$file/IBGN/" . $id_station . ".pdf")):  ?>
        <li>
            <a class="document" 
               href="data/fiches/qualite/$file/IBGN/<?=$id_station?>.pdf" target="_blank">IBGN</a>
            <span class="docformat">
                <em>(PDF, <?=@ConvertirTaille("data/fiches/qualite/$file/IBGN/" . $id_station . ".pdf")?>)</em>
            </span>
        </li>
        <?php endif; ?>
        <?php if(file_exists("data/fiches/qualite/$file/IBD/" . $id_station . ".pdf")):  ?>
        <li>
            <a class="document" 
               href="data/fiches/qualite/$file/IBD/<?=$id_station?>.pdf" target="_blank">IBD</a>
            <span class="docformat">
                <em>(PDF, <?=@ConvertirTaille("data/fiches/qualite/$file/IBD/" . $id_station . ".pdf")?>)</em>
            </span>
        </li>
        <?php endif; ?>
</div>
    <?php endif;
        endwhile;
        closedir($dh);
    endif;
endif; ?>