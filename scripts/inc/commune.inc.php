<?php
// Application-wide data and database connection
require_once(dirname(__FILE__) . "/../config/constants.inc.php");
require_once(dirname(__FILE__) . "/../config/database.inc.php");

// Utility functions  
require_once (dirname(__FILE__) . "/../classes/utilities.inc.php");

// Classes
require_once (dirname(__FILE__) . "/../classes/Commune.class.php");
require_once (dirname(__FILE__) . "/../classes/Epci.class.php");
require_once (dirname(__FILE__) . "/../classes/Scot.class.php");

/**
 * @var $id_regional Identifiant régional du zonage
 * @var $id_type Identifiant du type de zonage
 * @var $id_commune Code géographique de la commune
 * @var $id_epci Identifiant de l'EPCI
 * @var $id_scot Identifiant du SCOT
 */
$id_regional = $_REQUEST["id_regional"];
$id_type = $_REQUEST["id_type"];
$id_commune = $_REQUEST["id_commune"];
$id_epci = $_REQUEST["id_epci"];
$id_scot = $_REQUEST["id_scot"];

if (isset($id_regional)):
    $communes = getCommunesByIdRegional($id_regional,$id_type);
elseif (isset($id_epci)):
    $communes = getCommunesEpciByIdEpci($id_epci);
elseif (isset($id_scot)):
    $communes = getCommunesScotByIdScot($id_scot);
endif;
if (isset($communes)): ?>
    <table width="99%">
        <?php foreach ($communes as $commune): ?>
            <tr>
                <td bgcolor="<?= switchcolor() ?>">
                    <?=$commune["id_commune"]?>
                    <?php
                    $str = $commune["id_commune"];
                    $str = mb_strcut($str, 0, 2);

                    if ($str != 41 XOR $str != 61):
                        echo "";
                        ?> 
                    <?php else: ?>
                        <a href="spip.php?page=fiche_commune&amp;id_commune=<?=$commune["id_commune"]?>">
                        <?php endif; ?>
                        <?= $commune["nom_commune"] ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php
endif;
if (isset($id_commune)):
    $commune = new Commune();
    $commune->getCommuneById($id_commune); ?>
    <?= $commune->nom_commune ?> (<?= $commune->id_commune ?>)
<?php endif; ?>