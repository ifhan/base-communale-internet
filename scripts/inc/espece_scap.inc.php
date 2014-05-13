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
    <table  class="spip">
    <tr class="row_first">
        <th>Identifiant TAXREF</th>
        <th>Nom scientifique</th>
        <th>Nom vernaculaire</th>
        <th>Priorit&eacute; SCAP</th>
        <th>Esp&egrave;ce &agrave; faible occurence ?</th>
    </tr>
        <?php foreach ($sp_connues as $sp_connue): ?>
            <tr bgcolor="<?=switchColor()?>">
                <td>
                    <?=$sp_connue["id_taxref"]?>
                </td>
                <td>
                    <a href="http://inpn.mnhn.fr/espece/cd_nom/<?=$sp_connue["id_taxref"]?>" 
                        target="_blank">
                        <em><?= $sp_connue["lb_nom"] ?></em>
                    </a>
                </td>
                <td><?= $sp_connue["nom_vernac"] ?></td>
                <td><?= $sp_connue["priorite"] ?></td>
                <td>
                    <?php if($sp_connue["nb_occurence"] < "100"):
                        echo "Oui";
                    else:
                        echo "Non";
                    endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>