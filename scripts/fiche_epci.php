<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Zonage.class.php';

/**
 *  Ce fichier sert a afficher les differents zonages recensés par epci
 */
$id_epci = $_REQUEST["id_epci"];

$themes = getThemesByIdEpci($id_epci);
/**
 *  Affichage des communes de l'EPCI
 */
?>
<h3 class="spip">Communes concern&eacute;es&nbsp;:</h3>
<?php include("inc/commune.inc.php"); ?><br />
<?php if(count($themes) > 0): ?>
    <?php foreach($themes as $theme): ?>
    <div class="listerub">
        <div class="titresousrub"><?=$theme["theme"]?></div>
        <?php
        /**
         * Affichage du thème des types de zonage 
         */
        ?>
        <?php $id_theme = $theme["id_theme"]; ?>
        <?php $types_zonages = getTypesZonagesByIdEpciByIdTheme($id_epci, $id_theme) ?>
        <?php foreach($types_zonages as $type_zonage): ?>
            <?php
            /**
             * Affichage du type de zonage 
             */
            ?>
            <strong><?=$type_zonage["type"]?> :</strong><br />
            <?php $id_type = $type_zonage["id_type"]; ?>
            <?php $zonages = getZonagesByIdTypeByIdEpci($id_type, $id_epci) ?>
            <table class="encadre">
            <?php foreach($zonages as $zonage): ?>
                <?php
                /**
                 * Affichage de l'identifiant, du nom du zonage et 
                 * du lien vers la liste des ressources associées
                 */
                ?>
                <tr bgcolor="<?=switchcolor()?>" valign="top">
                    <td>
                        <strong><?= $zonage["id_regional"] ?></strong>
                    </td>
                    <td width="99%">&nbsp;<?= $zonage["nom"] ?></td>
                    <td class="cache">
                        <a href="spip.php?page=zonage&id_type=<?= $zonage["id_type"] ?>&amp;id_regional=<?= $zonage["id_regional"] ?>"><div align="right" class="cache"><img src="IMG/png/system-search.png" alt="Lien vers la ressource" /></a></div>
                    </td>
                 </tr>
            <?php endforeach; ?> 
            </table>
            <br />
        <?php endforeach; ?>
    </div>
    <?php include("squelettes/haut-page.html"); ?>
    <?php endforeach; ?>
<?php endif; ?>