<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<?php

// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';


	// Récupération de l'identifiant de l'organisme
	
	$organisme = $_GET["id_organisme"];
	
	// Recherche de l'organisme choisi
	
	$table = "organismes_organisme";
	
	$query = "SELECT * FROM $table WHERE id = '$organisme' "; 
	$result = mysql_query($query);
	$val = mysql_fetch_assoc($result);
?>

<head>

	<title>Organisme</title>

	<?php include("inc-meta_print.php") ?>

				<h1 class="titre-texte">Organisme</h1>
				<div class="soustitre">Fiche descriptive</div>
				<div class="ps"></div>
			</div>		
		</td>
	</tr>
</table><br />

	<div class="blue_link"><?php include("organisme.php") ?></div><br />

</body>

</html>