<?php

// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

class Epci 
{
    public $nom_epci;
    
    public function name()
    {
        return $this->nom_epci;
    }
    
}

try {

    $id_epci = $_REQUEST["id_epci"];
    $result = $pdo->query("SELECT * FROM admin_epci WHERE id_epci = $id_epci ");
 
    // Map results to object
    $result->setFetchMode(PDO::FETCH_CLASS, 'Epci');
    
    while($epci = $result->fetch()) {
        // Call our custom name method
        echo $epci->name();
    }
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

?>