<?php
// Application-wide data and database connection
require_once(dirname(__FILE__)."/../config/constants.inc.php");
require_once(dirname(__FILE__)."/../config/database.inc.php");

// Classes
require_once(dirname(__FILE__)."/../classes/CoursEau.class.php");

/**
 * Ce fichier sert à afficher le nom du cours d'eau sélectionné dans un
 * squelette SPIP
 * @var $id_riviere Identifiant de la rivière
 * @var $id_regional Identifiant de la station
 */
$id_riviere = $_REQUEST["id_riviere"];
$id_regional = $_REQUEST["id_regional"];
?>
<?php if($id_regional!=""): ?>
    <?php
    $riviere = new CoursEau();
    $riviere->getRiviereByIdStation($id_regional);
    ?>
    <?=$riviere->riviere?>
<?php elseif($id_riviere!="0"): ?>
    <?php
    $riviere = new CoursEau();
    $riviere->getRiviereByIdRiviere($id_riviere);
    ?>
    sur <?=$riviere->nom?>
<?php endif; ?>