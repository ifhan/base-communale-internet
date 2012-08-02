<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';	

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Znieff2G.class.php';

/**
 * Ce fichier sert à afficher la fiche descriptive d'une ZNIEFF
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];


$znieff = new Znieff2G();
$znieff->getZnieff2GByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td>
            <strong><?=$znieff->nom?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td>
            <strong><?=$znieff->id_regional?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td>
            <strong><?=$znieff->id_national?></strong>
        </td>
    </tr>
    <tr>
        <td>Type de zone&nbsp;:</td>
        <td>
            <strong><?=$znieff->TY_ZONE?></strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de 1&egrave;re description&nbsp;:</td>
        <td>
            <strong> 
                <?php
                $date = $znieff->AN_DESCRIP;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
		?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de mise &agrave; jour&nbsp;:</td>
        <td>
            <strong>
                <?php
                $date = $znieff->AN_MAJ;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
		?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de validation MNHN&nbsp;:</td>
        <td>
            <strong>
                <?php
                $date = $znieff->AN_SFF;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
                ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Altitude&nbsp;:</td>
        <td>
            <strong>
                <?=$znieff->ALT_MINI?> - <?=$znieff->ALT_MAXI?> m
            </strong>
        </td>
    </tr>
    <tr>
        <td>Surface d&eacute;clar&eacute;e&nbsp;:</td>
        <td>
            <strong><?=$znieff->SU_ZN?> ha</strong>
        </td>
    </tr>
    <tr>
        <td>D&eacute;partement&nbsp;: </td>
        <td>
            <strong>
                <?=$departement->nom_departement?> (<?=$departement->id_departement?>)
            </strong>
        </td>
    </tr>
</table>
<br />
<?php
$table = "znieff_znieff";
$table_2 = "znieff_zni_com";
$table_3 = "znieff_commune";

$query_2 = "SELECT 
DISTINCT $table_3.CD_INSEE, $table_3.LB_COMMUNE FROM $table, $table_2, $table_3 
WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
AND $table_3.CD_INSEE = $table_2.CD_INSEE
AND $table.NM_REGZN = '$id_regional'
ORDER BY $table_2.CD_INSEE";
$result_2 = mysql_query($query_2);
?>
<?php while ($val_2 = mysql_fetch_assoc($result_2)): ?>
    <?=$str = $val_2["CD_INSEE"];?>
    <?=$str = mb_strcut($str, 0, 2);?>
<?php endwhile; ?>
<h3 class="spip">Esp&egrave;ces d&eacute;terminantes&nbsp;:</h3>
    <?php include ("squelettes/nomenclature.html"); ?>
        <?php
        $table_2 = "znieff_liste_esp";
        $table_3 = "znieff_espece";
        $query_2 = "SELECT $table.NM_SFFZN, $table_2.NM_SFFZN, $table_2.CD_ESP, 
        $table.NM_REGZN, $table_2.FG_ESP, $table_2.CD_STATUT, $table_2.CD_ABOND, 
        $table_2.AN_I_OBS, $table_2.AN_S_OBS, $table_3.CD_ESP, $table_3.LB_ESP, 
        FROM ($table INNER JOIN $table_2 USING (NM_SFFZN)) 
        INNER JOIN $table_3 USING (CD_ESP)
        WHERE $table.NM_REGZN = '$id_regional' 
        AND $table_2.FG_ESP = 'D'
        GROUP BY MS_ARBO
        ORDER BY MS_ARBO_PERE";
        $result_2 = mysql_query($query_2);
        $nombre_2 = mysql_num_rows($result_2);
        ?>
<p>
    <strong><?=$nombre_2?> esp&egrave;ce(s) d&eacute;terminante(s)</strong> 
    recens&eacute;e(s) dans cette ZNIEFF.
</p>
<?php if($nombre_2!="0"): ?>
<table class=encadre width=99%>
    <tr>
        <th>Taxon</th>
        <th>Statut</th>
        <th>Abondance</th>
        <th>Effectif<br />Min.-Max.</th>
        <th>P&eacute;riode d'obs.<br />D&eacute;but-Fin</th>
    </tr>
    <?php while ($val_2 = mysql_fetch_assoc($result_2)):
        // Affichage de l'embranchement, de la classe ou de l'ordre
        $query_5 = "SELECT MS_ARBO, LB_ESP, MS_ARBO_PERE
        FROM $table_3
        WHERE MS_ARBO = '$val_2[MS_ARBO_PERE]'";
        $result_5 = mysql_query($query_5);
        $val_5 = mysql_fetch_assoc($result_5);

        // Affichage du sous règne, de l'embranchement, 
        // du super embranchement, de la classe ou de la super classe
	$query_4 = "SELECT LB_NIVEAU, MS_ARBO, LB_ESP, MS_ARBO_PERE
        FROM $table_3
        WHERE MS_ARBO = '$val_5[MS_ARBO_PERE]'
        AND LB_NIVEAU != 'RG'";
        $result_4 = mysql_query($query_4);
        $val_4 = mysql_fetch_assoc($result_4);
	
        // Affichage du nom vernaculaire de l'espèce
	$table_5 = "R_ESPECES_DETERMINANTES_FLORE_R52";
        $table_6 = "R_ESPECES_DETERMINANTES_ZNIEFF_R52";
        
        $query_3 = "SELECT * 
        FROM $table_3, $table_5, $table_6
        WHERE $table_6.CD_ESP = '$val_2[CD_ESP]'
        AND $table_5.ID = $table_6.ID
        AND $table_3.CD_ESP = $table_6.CD_ESP
        AND $table_3.MS_ARBO NOT LIKE '4%'"; 
        $result_3 = mysql_query($query_3);
        $val_3 = mysql_fetch_assoc($result_3);
        
        $table_5 = "R_ESPECES_DETERMINANTES_FAUNE_R52";
        
        $query_6 = "SELECT * 
        FROM $table_3, $table_5, $table_6
        WHERE $table_6.CD_ESP = '$val_2[CD_ESP]'
        AND $table_3.CD_ESP = $table_5.CD_ESP
        AND $table_3.CD_ESP = $table_6.CD_ESP
        AND $table_3.MS_ARBO LIKE '4%'"; 
        $result_6 = mysql_query($query_6);
        $val_6 = mysql_fetch_assoc($result_6);
        ?>
    <tr>
        <td class="left" bgcolor="<?=switchcolor()?>">
            <?php if($val_4["LB_ESP"]!=""): ?>
            <strong><?=$val_4["LB_ESP"]?> &raquo; </strong>
            <?php endif; ?>
            <strong><?=$val_5["LB_ESP"]?> &raquo; </strong><br />
            <?php
            // Affichage du nom latin de l'espèce, choix de la fiche espèce 
            // et affichage du lien vers la fiche espèce 
		
		if(ereg("^(1)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; } 
		
		elseif(ereg("^(2)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; }
		
		elseif(ereg("^(3)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; } 
		
		elseif(ereg("^(4)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; } 
		
		elseif(ereg("^(5)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; }	
		
		// Affichage du nom vernaculaire
		
		if(ereg("^(4)", $val_2["MS_ARBO_PERE"])) {
		
			if($val_6["NOM_VERNAC"]!="") { echo "(".utf8_encode($val_6["NOM_VERNAC"]).")"; } else { echo "";	}
		
		} else {
		
		if($val_3["NOM_VERNAC"]!="") { echo "(".utf8_encode($val_3["NOM_VERNAC"]).")"; } else { echo "";	}
		
		}
		?>
        </td>
        <td class=align>
            <?=$val_2["CD_STATUT"]?>
        </td>
        <td class=align>
            <?=$val_2["CD_ABOND"]?>
        </td>
        <td class=align>
            <?php 
		if($val_2["NB_I_ABOND"]!="0") { echo $val_2["NB_I_ABOND"];
		
		} else { echo "?"; }
		
		echo " - ";
		
		if($val_2["NB_S_ABOND"]!="0") { echo $val_2["NB_S_ABOND"]; } else { echo "?"; }	
		
		echo "</td><td class=align>";
		
		if($val_2["AN_I_OBS"]!="") { echo $val_2["AN_I_OBS"];	 } else { echo "?"; }
		
		echo " - ";
		
		if($val_2["AN_S_OBS"]!="") { echo $val_2["AN_S_OBS"]; } else { echo "?"; }
		?>
        </td>
    </tr>
        <?php endwhile; ?>
</table>
    <?php else: ?>
<p><strong>Aucune esp&egrave;ce d&eacute;terminante</strong> n'est recens&eacute;e dans cette ZNIEFF.</p>
    <?php endif; ?>
<?php
// Sources
$table_4 = "znieff_sources";

$query_3 = "SELECT 
DISTINCT $table.NM_SFFZN, $table_2.NM_SFFZN, $table_2.CD_ESP, 
$table_3.CD_ESP, $table_4.MS_SOURCE, $table.NM_REGZN, $table_2.FG_ESP, 
$table_4.LB_SOURCE
FROM $table_4, ($table INNER JOIN $table_2 USING (NM_SFFZN)) 
INNER JOIN $table_3 USING (CD_ESP)
WHERE $table.NM_REGZN = '$id_regional'
AND $table_2.FG_ESP = 'D'
AND $table_2.MS_SOURCE = $table_4.MS_SOURCE
GROUP BY $table_4.MS_SOURCE";
$result_3 = mysql_query($query_3);
$nombre_3 = mysql_num_rows($result_3);
?>
<?php if($nombre_3!="0"): ?>
<h3 class="spip">Sources&nbsp;:</h3>
<?php endif ?>
<ul class="spip">
    <?php while ($val_3 = mysql_fetch_assoc($result_3)): ?>
    <li><?=$val_3["LB_SOURCE"]?></li>
    <?php endwhile ?>
</ul>
    <?php include ("squelettes/haut-page.html"); ?>
<h3 class="spip">Esp&egrave;ces confidentielles&nbsp;:</h3>
	<?php
		$query_2 = "SELECT * FROM ($table INNER JOIN $table_2 USING (NM_SFFZN)) INNER JOIN $table_3 USING (CD_ESP) 
		WHERE $table.NM_REGZN = '$id_regional' 
		AND $table_2.FG_ESP = 'C'";
		$result_2 = mysql_query($query_2);
		$nombre_2 = mysql_num_rows($result_2);

		if($nombre_2!="0") { echo "<p><strong>".$nombre." esp&egrave;ce(s) confidentielle(s)</strong> sont recens&eacute;es dans cette ZNIEFF.</p>"; }	
		else { echo "<p><strong>Aucune esp&egrave;ce confidentielle</strong> n'est recens&eacute;e dans cette ZNIEFF.</p>"; }		
	?>
	<?php include ("squelettes/haut-page.html"); ?>
	<h3 class="spip">Autres esp&egrave;ces&nbsp;:</h3>
	<?php include ("squelettes/nomenclature.html"); ?>
	<?php
		$table_2 = "znieff_liste_esp";
		$table_3 = "znieff_espece";
		
		$query_2 = "SELECT $table.NM_SFFZN, $table_2.NM_SFFZN, $table_2.CD_ESP, 
		$table.NM_REGZN, $table_2.FG_ESP, $table_2.CD_STATUT, $table_2.CD_ABOND, $table_2.NB_I_ABOND, $table_2.NB_S_ABOND, 
		$table_2.AN_I_OBS, $table_2.AN_S_OBS, $table_3.CD_ESP, $table_3.LB_ESP, $table_3.MS_ARBO, $table_3.MS_ARBO_PERE
		FROM ($table INNER JOIN $table_2 USING (NM_SFFZN)) INNER JOIN $table_3 USING (CD_ESP)
		WHERE $table.NM_REGZN = '$id_regional' 
		AND $table_2.FG_ESP = 'A'
		GROUP BY MS_ARBO
		ORDER BY MS_ARBO_PERE";
		$result_2 = mysql_query($query_2);
		$nombre_2 = mysql_num_rows($result_2);
		
		echo "<p><strong>".$nombre_2." autre(s) esp&egrave;ce(s)</strong> recens&eacute;e(s) dans cette ZNIEFF.</p>";	
		
		if($nombre_2!="0") {
		
		echo "
			<table class=encadre width=99%>
				<tr>
					<th>Taxon</th>
					<th>Statut</th>
					<th>Abondance</th>
					<th>Effectif<br />
					Min.-Max.</th>
					<th>P&eacute;riode d'obs.<br />
					D&eacute;but-Fin</th>
				</tr>";
		
		while ($val_2 = mysql_fetch_assoc($result_2)) {
		
		// Affichage de l'embranchement, de la classe ou de l'ordre
		
		$query_5 = "SELECT MS_ARBO, LB_ESP, MS_ARBO_PERE
		FROM $table_3
		WHERE MS_ARBO = '$val_2[MS_ARBO_PERE]'";	
		$result_5 = mysql_query($query_5);
		$val_5 = mysql_fetch_assoc($result_5);
		
		// Affichage du sous r�gne, de l'embranchement, du super embranchement, de la classe ou de la super classe
		
		$query_4 = "SELECT LB_NIVEAU, MS_ARBO, LB_ESP, MS_ARBO_PERE
		FROM $table_3
		WHERE MS_ARBO = '$val_5[MS_ARBO_PERE]'
		AND LB_NIVEAU != 'RG'";
		$result_4 = mysql_query($query_4);
		$val_4 = mysql_fetch_assoc($result_4);
		
		// Affichage du nom vernaculaire de l'esp�ce
		
		$table_5 = "especes_determinantes52_flore_id";
		$table_6 = "especes_determinantes52_znieff";
		
		$query_3 = "SELECT * 
		FROM $table_3, $table_5, $table_6
		WHERE $table_6.CD_ESP = '$val_2[CD_ESP]'
		AND $table_5.ID = $table_6.ID
		AND $table_3.CD_ESP = $table_6.CD_ESP
		AND $table_3.MS_ARBO NOT LIKE '4%'"; 
		$result_3 = mysql_query($query_3);
		$val_3 = mysql_fetch_assoc($result_3);
		
		$table_5 = "especes_determinantes52_faune_id";
		
		$query_6 = "SELECT * 
		FROM $table_3, $table_5, $table_6
		WHERE $table_6.CD_ESP = '$val_2[CD_ESP]'
		AND $table_3.CD_ESP = $table_5.CD_ESP
		AND $table_3.CD_ESP = $table_6.CD_ESP
		AND $table_3.MS_ARBO LIKE '4%'"; 
		$result_6 = mysql_query($query_6);
		$val_6 = mysql_fetch_assoc($result_6);
		
		echo "<tr><td class=left bgcolor=". switchcolor() .">";
		
		if($val_4["LB_ESP"]!="") { echo "<strong>".utf8_encode($val_4["LB_ESP"])." &raquo; </strong>";  } else { echo ""; }
		
		echo "<strong>".utf8_encode($val_5["LB_ESP"])." &raquo; </strong><br />";
		
		// Choix de la fiche
		
		if(ereg("^(1)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; }
		
		elseif(ereg("^(2)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> ";  } 
		
		elseif(ereg("^(3)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; } 
		
		elseif(ereg("^(4)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; }
		
		elseif(ereg("^(5)", $val_2["MS_ARBO_PERE"])) { echo "<em>".utf8_encode($val_2["LB_ESP"])."</em> "; }	
		
		// Affichage du nom vernaculaire
		
		if(ereg("^(4)", $val_2["MS_ARBO_PERE"])) {
		
			if($val_6["NOM_VERNAC"]!="") { echo "(".utf8_encode($val_6["NOM_VERNAC"]).")"; } else { echo "";	}
		
		} else {	
		
			if($val_3["NOM_VERNAC"]!="") { echo "(".utf8_encode($val_3["NOM_VERNAC"]).")"; } else { echo "";	}
		
		}
		
		echo "</td><td class=align>";
		echo $val_2["CD_STATUT"]."</td><td class=align>";
		echo $val_2["CD_ABOND"]."</td><td class=align>";
		
		if($val_2["NB_I_ABOND"]!="0") { echo $val_2["NB_I_ABOND"]; } else { echo "?"; }
		
		echo " - ";
		
		if($val_2["NB_S_ABOND"]!="0") { echo $val_2["NB_S_ABOND"]; } else { echo "?"; }	
		
		echo "</td><td class=align>";
		
		if($val_2["AN_I_OBS"]!="") { echo $val_2["AN_I_OBS"]; } else { echo "?"; }
		
		echo " - ";
		
		if($val_2["AN_S_OBS"]!="") { echo $val_2["AN_S_OBS"]; }  else { echo "?"; }
		
		echo "</td></tr>";

			}
			
		echo "</table>";
		
		} else { echo "<p><strong>Aucune autre esp&egrave;ce</strong> n'est recens&eacute;e dans cette ZNIEFF.</p>"; }	

		// Sources
			
			$query_3 = "SELECT DISTINCT $table.NM_SFFZN, $table_2.NM_SFFZN, $table_2.CD_ESP, 
			$table_3.CD_ESP, $table_4.MS_SOURCE, $table.NM_REGZN, $table_2.FG_ESP, $table_4.LB_SOURCE
			FROM $table_4, ($table INNER JOIN $table_2 USING (NM_SFFZN)) INNER JOIN $table_3 
			USING (CD_ESP)
			WHERE $table.NM_REGZN = '$id_regional'
			AND $table_2.FG_ESP = 'A'
			AND $table_2.MS_SOURCE = $table_4.MS_SOURCE
			GROUP BY $table_4.MS_SOURCE";
			$result_3 = mysql_query($query_3);
			$nombre_3 = mysql_num_rows($result_3);

		if($nombre_3!="0") { echo "<h3 class=spip>Sources&nbsp;:</h3>"; } 
		
		else { echo ""; } 
	
		echo "<ul class=spip>";
		 		
		while ($val_3 = mysql_fetch_assoc($result_3)) { echo "<li>".utf8_encode($val_3["LB_SOURCE"])."</li>"; }
			
		echo "</ul>";
?>