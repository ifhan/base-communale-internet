<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes
require_once(dirname(__FILE__)."/../classes/Zonage.class.php");
require_once(dirname(__FILE__)."/../classes/HabitatEur15.class.php");
require_once(dirname(__FILE__)."/../classes/HabitatCorine.class.php");

$id_type = $_REQUEST["id_type"];
$id_eur15 = $_REQUEST["id_eur15"];
$id_corine = $_REQUEST["id_corine"];

if(isset($id_type)) {
    $zonage = new Zonage();
    $zonage->getTypeZonageByIdType($id_type);
    echo $zonage->type;
}

if(isset($id_eur15)) {
    $habitat_eur15 = new HabitatEur15();
    $habitat_eur15->getHabitatEur15ById($id_eur15);
    echo $habitat_eur15->lb_eur15;
}
	
if(isset($id_corine)) {
    $habitat_corine = new HabitatCorine();
    $habitat_corine->getHabitatCorineById($id_corine);
    echo $habitat_corine->id_corine." - ".$habitat_corine->lb_corine;
}
?>