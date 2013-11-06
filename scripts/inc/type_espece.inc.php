<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

$type_sp  = $_REQUEST["type_sp"];

if(isset($type_sp)) {
    echo ucfirst(strtolower($type_sp));
}
?>