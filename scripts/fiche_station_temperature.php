<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

$id_station = $_REQUEST["id_station"];
$query = "SELECT map FROM local_types_zonages WHERE id_type = 28";
$result = mysql_query($query);
$val = mysql_fetch_assoc($result);

echo "<div text=top><table><tr>";
echo "<td style=vertical-align:bottom; ><img src=IMG/png/gnome-globe.png style=border:none alt=Icone web /></td>";
echo "<td><a href=http://carmen.developpement-durable.gouv.fr/26/" . $val["map"] . ".map&object=stations_temperature_rcs;id_station;04" . $station;
echo " target=_blank>Consulter la localisation de la station sur CARMEN";
echo "</a>.</div></td></tr></table></div>";

$query = "SELECT * FROM R_STATIONS_HYDROTEMPERATURE_R52 WHERE id_station = '$id_station' ";
$result = mysql_query($query);
$nombre = mysql_num_rows($result);

echo "<h3 class=spip>Principales caract&eacute;ristiques de la station :</h3>";
echo "<table class=spip>";
echo "<thead><tr class=row_first><th>Identifiant</th><th>Cours d'eau</th><th>Nom de la station</th><th>Date de mise en service</th></tr></thead><tbody>";

while ($val = mysql_fetch_assoc($result)) {

    // Affichage du num�ro de la station, du nom du cours d'eau, du nom de la commune, de la localitisation pr�cise

    echo "<tr bgcolor=" . switchcolor() . " valign=top><td>" . $val["id_station"] . "</td><td>";
    echo utf8_encode(stripslashes($val["riviere"]));
    echo "</td><td>" . utf8_encode($val["commune"]) . " (" . $val["id_commune"] . ") " . utf8_encode($val["localite"]);
    echo "</td><td>" . date("d/m/Y", strtotime($val["en_service"])) . "</td></tr>";
}

echo "</tbody></table>";

$dir = "data/fiches/temperature/";

echo "<div class=listedoc><h3>T&eacute;l&eacute;charger :</h3><ul>";

// Ouvre un dossier bien connu, et liste tous les fichiers

if (@is_dir($dir)) {

    if ($dh = @opendir($dir)) {

        while (($file = @readdir($dh)) !== false) {

            if ($file != "." && $file != "..") {

                if (file_exists("data/fiches/temperature/$file/" . $id_station . ".pdf")) {

                    echo "<li><a class=document href=data/fiches/temperature/$file/" . $id_station . ".pdf target=_blank>Temp&eacute;ratures en continu en " . $file . "</a>";
                    echo "<span class=docformat><em>(PDF, ";
                    echo @ConvertirTaille("data/fiches/temperature/$file/" . $id_station . ".pdf");
                    echo ")</em></span></li>";
                } else {
                    echo "";
                }
            }
        }

        closedir($dh);
    }
}

echo "</ul></div>";

mysql_close();
?>