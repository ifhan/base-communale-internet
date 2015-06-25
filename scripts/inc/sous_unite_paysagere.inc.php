<?php
// Application-wide data and database connection
require_once(dirname(__FILE__) . "/../config/constants.inc.php");
require_once(dirname(__FILE__) . "/../config/database.inc.php");

// Utility functions  
require_once (dirname(__FILE__) . "/../classes/utilities.inc.php");

// Classes
require_once (dirname(__FILE__) . "/../classes/SousUnitePaysagere.class.php");

/**
 * @var $id_regional Identifiant régional de l'Unité paysagère
 */
$id_regional = $_REQUEST["id_regional"];

if (isset($id_regional)):
    $sous_unites_paysageres = getSousUnitePaysagereByIdUp($id_regional);
endif;
if (isset($sous_unites_paysageres)): ?>
    <table width="99%">
        <?php foreach ($sous_unites_paysageres as $sous_unite_paysagere): ?>
            <tr>
                <td bgcolor="<?=switchColor()?>">
                    <?=$sous_unite_paysagere["id_regional"]?>
                    <a href="spip.php?page=zonage&amp;id_type=70&amp;id_regional=<?=$sous_unite_paysagere["id_regional"]?>">
                        <?= $sous_unite_paysagere["nom"] ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>