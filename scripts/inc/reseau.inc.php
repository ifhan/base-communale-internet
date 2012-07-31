<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

$reseau = $_GET["reseau"];
?>
<?php if ($reseau == "1"): ?>
stations du RCS
<?php elseif ($reseau == "2"): ?>
anciennes stations du RNB non retenues dans le RCS
<?php endif; ?>
?>