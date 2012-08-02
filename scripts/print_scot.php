<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';
	
	$scot = $_GET["scot"];
?>

<head>

	<title>Version imprimable</title>

	<?php include("inc-meta_print.php") ?>
	
				<h1 class="titre-texte"><?php include("query_scot.php") ?></h1>
				<div class="soustitre">Sch&eacute;ma de Coh&eacute;rence Territoriale (SCoT)</div>
				<div class="ps">Liste des zonages recens&eacute;s</div>
			</td>
		</tr>
	</table><br />

	<div class="blue_link"><?php include("scot.php") ?></div><br />

</body>

</html>