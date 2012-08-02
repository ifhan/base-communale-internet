<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

$commune = $_REQUEST["commune"];

$table = "R_STATION_QUALITE_RCS_R52";
$table2 = "R_RIVIERE_QUALITE_R52";

$query_2 = "SELECT DISTINCT * 
FROM $table, $table2 
WHERE $table.id_commune = '$commune' 
AND $table.id_riviere = $table2.id_riviere
ORDER BY $table.id_station" ;
$result_2 = mysql_query($query_2);
?>
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
        <?php while($val_2 = mysql_fetch_assoc($result_2)): ?>
        <?php 
        /**
         * Affiche le numéro de la station, le nom du cours d'eau, le 
         * nom de la commune, la localisation précise		
         */
        ?>
        <tr bgcolor="<?=switchcolor()?>" valign="top">
            <td align="center">"<?=$val_2["id_station"]?></td>
            <td width="99%">
                <?=(stripslashes($val_2["nom_riviere"]))?> <?=$val_2["nom_commune"]?> (<?=$val_2["id_commune"]?>), <?=$val_2["localite"]?>
            </td>
            <td align="center">
                <a href="spip.php?page=liste_stations_reseaux&amp;reseau=<?=$val_2["id_reseau"]?>&departement=<?=$val_2["id_departement"]?>"><?php if ($val_2["id_reseau"]== 1): ?>RCS<?php elseif ($val_2["id_reseau"]== 2): ?>RNB<?php endif; ?></a>
            </td>
            <td class="cache">
                <div class="logo" align="right">
                <?php 
                $query = "SELECT map 
                FROM R_TYPE_ZONAGE_R52 
                WHERE id_type = 28";
                $result = mysql_query($query);
                $val = mysql_fetch_assoc($result);
                ?>
                    <a href="http://carmen.developpement-durable.gouv.fr/26/<?=$val["map"]?>.map&object=stations_qualite_rcs;id_station;04<?=$val_2["id_station"]?>" target="_blank"><img src="IMG/png/Gnome-Emblem-Web-32.png" style="border:none" alt="Icone web" /></a>
                </div>
            </td>
            <td class="cache">
                <div class="right">
                    <a href="spip.php?page=fiche_station_qualite&amp;station=<?=$val_2["id_station"]?>&reseau=<?=$val_2["id_reseau"]?>"><img src="IMG/png/system-search.png" alt="Lien vers la ressource" /></a>
                    <br />
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbdody>
</table>