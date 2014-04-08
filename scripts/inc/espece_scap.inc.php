<?php
// Application-wide data and database connection
require_once(dirname(__FILE__) . "/../config/constants.inc.php");
require_once(dirname(__FILE__) . "/../config/database.inc.php");

// Utility functions  
require_once (dirname(__FILE__) . "/../classes/utilities.inc.php");

// Classes
require_once (dirname(__FILE__) . "/../classes/SecteurScap.class.php");

/**
 * @var $id_regional Identifiant régional du zonage
 * @var $id_type Identifiant du type de zonage
 */
$id_regional = $_REQUEST["id_regional"];
//$id_type = $_REQUEST["id_type"];

$sp_connues = getEspecesScapByIdRegional($id_regional);

if (isset($id_regional)):
    $sp_connues = getEspecesScapByIdRegional($id_regional);
endif;
if (isset($communes)): ?>
    <table width="99%">
        <?php foreach ($sp_connues as $sp_connue): ?>
            <tr>
                <td bgcolor="<?=switchColor()?>">
                    <?=$sp_connue["id_taxref"]?>
                    <a href="http://inpn.mnhn.fr/espece/cd_nom/<?=$sp_connue["id_taxref"]?>" 
                        target="_blank">
                        <em><?= $sp_connue["lb_nom"] ?></em>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>