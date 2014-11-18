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
        <th>Groupe</th>
        <th>Identifiant TAXREF</th>
        <th>Nom scientifique</th>
        <th>Nom vernaculaire</th>
        <th>Priorit&eacute; SCAP*</th>
    </tr>
        <?php foreach ($sp_connues as $sp_connue): ?>
            <tr bgcolor="<?=switchColor()?>">
                <td>
                    <?=$sp_connue["groupe"]?>
                </td>
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
                <td style="text-align:center"><?= $sp_connue["priorite"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<p style="font-size: x-small">
    *Priorit&eacute; 1 : Pas ou tr&egrave;s peu d'aires prot&eacute;g&eacute;es<br />
    Priorit&eacute; 2 : Pr&eacute;sence significative d'aires prot&eacute;g&eacute;es et insuffisance qualitative du r&eacute;seau<br />
    Priorit&eacute; 3 : Pr&eacute;sence significative d'aires prot&eacute;g&eacute;es et suffisance qualitative du r&eacute;seau
</p>
<?php endif; ?>