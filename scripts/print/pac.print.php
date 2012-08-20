<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';
	
	$commune = $_GET["commune"];
?>

<head>
	<title>
	<?php  

		$query = "SELECT * FROM BDC_COMMUNE_52 WHERE id_commune = $commune"; 
		$result = mysql_query($query);
		$val = mysql_fetch_assoc($result);
	
		echo "Liste des zonages sur la commune de ".$val["nom_commune"]." (".$val["id_commune"].")";

	?>
	</title>

	<?php include("inc-meta_print.php") ?>

				<h1 class="titre-texte">Commune de <?php include("query_commune.php")?></h1>
				<div class="soustitre">Liste des zonages recens&eacute;s</div>
				<div class="ps"></div>
			</td>
		</tr>
	</table><br />

	<div class="blue_link"><?php include("pac.php")?></div><br />

</body>

</html>