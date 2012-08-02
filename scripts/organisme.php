<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

/**
 *  Récupération de l'identifiant de l'organisme
 */
$organisme = $_REQUEST["id_organisme"];

/**
 * Recherche de l'organisme choisi
 */
$query = "SELECT * 
FROM R_DOCOB_ORGANISMES_R52 
WHERE id = '$organisme' ";
$result = mysql_query($query);
$val = mysql_fetch_assoc($result);
?>
<h1 class="align">
    <?php 
    echo utf8_encode($val["nom_organisme"]);
    if ($val["sigle"] != $val["nom_organisme"]) { echo " (".$val["sigle"].")"; }
    else { echo "&nbsp;"; }
    ?>		
</h1><br />
<fieldset>
	<legend>Statut</legend>
	<p><?php echo utf8_encode($val["statut"]); ?></p>
</fieldset><br />
<fieldset>
	<legend>Adresse postale</legend>
	<p><?php echo utf8_encode($val["adresse"])."<br />".$val["cp"]." ".utf8_encode($val["commune"]); ?></p>
</fieldset><br />
<fieldset>
	<legend>Contact(s)</legend>
	<?php
	
		// Recherche des contacts dans cet organisme (spécifique à Intranet)
		
		$query_2 = "SELECT * FROM R_DOCOB_ORGANISMES_PERSONNES_R52 WHERE organisme_id = '$organisme' "; 
		$result_2 = mysql_query($query_2);
		while($val_2 = mysql_fetch_assoc($result_2)) {
		
			echo "<p>".$val_2["civilite"]." ".$val_2["prenom"]." ".$val_2["nom_personne"]."<br />";
			echo "T&eacute;l&eacute;phone&nbsp;: ".$val_2["tel"]."<br />";
			echo "T&eacute;l&eacute;copie&nbsp;: ".$val_2["fax"]."<br />";
			echo "Courriel&nbsp;: <a href='mailto:".$val_2["courriel"]."''>".$val_2["courriel"]."</a></p>";
		
		}
	?>
</fieldset><br />
<fieldset>
	<legend>Sites concern&eacute;s</legend>
	<h3>En tant qu'op&eacute;rateur&nbsp;:</h3> 
	<?php
		// Recherche des SIC où cet organisme est opérateur
		
		$table = "natura_docob";
		$table_2 = "zonages_sites_natura52";
		$query_3 = "SELECT * FROM $table, $table_2 WHERE $table.operateur_id = '$organisme'
		AND $table.site_id = $table_2.id_regional AND $table_2.id_type = '6' "; 
		$result_3 = mysql_query($query_3);
		$nombre_3 = mysql_num_rows($result_3); 
	?>
	<p><em>- <?php echo $nombre_3 ;?> Site(s) d'Importance Communautaire (SIC)</em></p>
	<?php
		echo "<ul class=square>";
		while ($val_3 = mysql_fetch_assoc($result_3)) {
			
			echo "<li><a href='spip.php?page=fiche&amp;type=6&amp;id_regional=".$val_3["id_regional"]."'>";
			echo $val_3["id_regional"]." ".$val_3["nom"]."<br /></a></li>";
		}

		echo "</ul>";

		// Recherche des ZPS où cet organisme est opérateur

		$query_3 = "SELECT * FROM $table, $table_2 WHERE $table.operateur_id = '$organisme'
		AND $table.site_id = $table_2.id_regional AND $table_2.id_type = '5' ";
		$result_3 = mysql_query($query_3);
		$nombre_3 = mysql_num_rows($result_3); 
	?>		
	<p><em>- <?php echo $nombre_3 ;?> Zone(s) de Protection Sp&eacute;ciale (ZPS)</em></p>
	<?php
		echo "<ul class=square>";
		while ($val_3 = mysql_fetch_assoc($result_3)) {
		
			echo "<li><a href='spip.php?page=fiche&amp;type=5&amp;id_regional=".$val_3["id_regional"]."'>";
			echo $val_3["id_regional"]." ".$val_3["nom"]."<br /></a></li>";
		}

		echo "</ul>";
	?>
	<h3>En tant qu'animateur&nbsp;:</h3> 
	<?php
		// Recherche des SIC où cet organisme est animateur

		$table = "natura_docob";
		$table_2 = "zonages_sites_natura52";
		$query_3 = "SELECT * FROM $table, $table_2 WHERE $table.structure_animatrice_id = '$organisme'
		AND $table.site_id = $table_2.id_regional AND $table_2.id_type = '6' "; 
		$result_3 = mysql_query($query_3);
		$nombre_3 = mysql_num_rows($result_3); 

	?>
	<p><em>- <?php echo $nombre_3 ; ?> Site(s) d'Importance Communautaire (SIC)</em></p>
	<?php		
		
		echo "<ul class=square>";
		while ($val_3 = mysql_fetch_assoc($result_3)) {
		
			echo "<li><a href='spip.php?page=fiche&amp;type=6&amp;id_regional=".$val_3["id_regional"]."'>";
			echo $val_3["id_regional"]." ".$val_3["nom"]."<br /></a></li>";
		}

		echo "</ul>";

		// Recherche des ZPS où cet organisme est animateur

		$query_3 = "SELECT * FROM $table, $table_2 WHERE $table.structure_animatrice_id = '$organisme'
		AND $table.site_id = $table_2.id_regional AND $table_2.id_type = '5' ";
		$result_3 = mysql_query($query_3);
		$nombre_3 = mysql_num_rows($result_3); 
	?>
	<p><em>- <?php echo $nombre_3 ;?> Zone(s) de Protection Sp&eacute;ciale (ZPS)</em></p>
	<?php	
		
		echo "<ul class=square>";
		while ($val_3 = mysql_fetch_assoc($result_3)) {
		
			echo "<li><a href='spip.php?page=fiche&amp;type=5&amp;id_regional=".$val_3["id_regional"]."'>";
			echo $val_3["id_regional"]." ".$val_3["nom"]."<br /></a></li>";
		}

		echo "</ul>";
	?>
</fieldset>
<?php mysql_close(); ?>