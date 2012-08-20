<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';
?>

<head>

	<title>Liste des habitats Natura 2000 (Nomenclature EUR 15)</title>

	<?php include("inc-meta_print.php") ?>
	
				<h1 class="titre-texte">Liste des habitats Natura 2000</h1>
				<div class="soustitre">Nomenclature EUR 15</div>
				<div class="ps"></div>
			</td>
		</tr>
	</table><br />

	<div class="blue_link"><?php include("liste_eur15.php") ?></div><br />

</body>

</html>