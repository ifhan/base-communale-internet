<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Récupération de l'identifiant de la station
$station = $_REQUEST["station"];

$query = "SELECT map 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = 28";
$result = mysql_query($query);
$val = mysql_fetch_assoc($result);
?>

<div text="top">
    <table>
        <tr>
            <td style="vertical-align:bottom;">
                <img src="../IMG/png/gnome-globe.png" 
                     style="border:none" alt="Icone web">
            </td>
            <td>
                <a href="http://carmen.developpement-durable.gouv.fr/26/<?=$val["map"]?>.map
                   &object=stations_qualite_rcs;
                   id_station;04<?=$station?>" target="_blank">
                    Consulter la localisation de la station sur CARMEN
                </a>.    
            </td>
        </tr>
    </table>
</div><br />
<?php
$dir = "data/fiches/qualite/";

// Ouvre un dossier bien connu, et liste tous les fichiers
if (@is_dir($dir)) {
    if ($dh = @opendir($dir)) {
        while (($file = @readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                echo "<div class=listedoc>";
                if ( (file_exists("data/fiches/qualite/$file/Physico-chimie/".$station.".pdf")) || (file_exists("data/fiches/qualite/$file/Pesticides/".$station.".pdf")) ) {
					
						echo "<h3>".$file." :</h3><ul>";					
					
					}
					
					if (file_exists("data/fiches/qualite/$file/Physico-chimie/".$station.".pdf")) {
						
						echo "<li><a class=document href='data/fiches/qualite/$file/Physico-chimie/".$station.".pdf' target=_blank>Physico-chimie</a>";
						echo "<span class=docformat> <em>(PDF, ";
						echo @ConvertirTaille("data/fiches/qualite/$file/Physico-chimie/".$station.".pdf");
						echo ")</em></span></li>";

					}

					if (file_exists("data/fiches/qualite/$file/Pesticides/".$station.".pdf")) {

						echo "<li><a class=document href='data/fiches/qualite/$file/Pesticides/".$station.".pdf' target=_blank>Pesticides</a>";
						echo "<span class=docformat> <em>(PDF, ";
						echo @ConvertirTaille("data/fiches/qualite/$file/Pesticides/".$station.".pdf");
						echo ")</em></span></li>";

					}

					if (file_exists("data/fiches/qualite/$file/IBGN/".$station.".pdf")) {

						echo "<li><a class=document href='data/fiches/qualite/$file/IBGN/".$station.".pdf' target=_blank>IBGN</a>";
						echo "<span class=docformat> <em>(PDF, ";
						echo @ConvertirTaille("data/fiches/qualite/$file/IBGN/".$station.".pdf");
						echo ")</em></span></li>";

					}

					if (file_exists("data/fiches/qualite/$file/IBD/".$station.".pdf")) {

						echo "<li><a class=document href='data/fiches/qualite/$file/IBD/".$station.".pdf' target=_blank>IBD</a>";
						echo "<span class=docformat> <em>(PDF, ";
						echo @ConvertirTaille("data/fiches/qualite/$file/IBD/".$station.".pdf");
						echo ")</em></span></li>";

					}

					echo "</div>";

				}

			}

			closedir($dh);

		}

	}
			 
	mysql_close();
?>