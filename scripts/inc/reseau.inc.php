<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

$id_reseau = $_GET["id_reseau"];
?>
<?php if ($id_reseau == "1"): ?>
stations du RCS
<?php elseif ($id_reseau == "2"): ?>
anciennes stations du RNB non retenues dans le RCS
<?php endif; ?>