<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Zonage.class.php';

/**
 * Ce fichier sert à afficher les différents zonages recensés par commune
 * @var  $id_commune Code géographique de la commune
 */
$id_commune = $_REQUEST["id_commune"];

$themes = getThemesByIdCommuneIdRubrique($id_commune,11);
?>
<?php if(count($themes) > 0): ?>
    <!-- Accès direct par thème en haut de page -->
    <div class="listerub">
        <div class="titresousrub">Accès direct</div>
        <div id="plan2">
            <ul class="plansite">
                <?php foreach($themes as $theme): ?>
                <li>
                    <a href="#<?=$theme["id_theme"]?>" class="plansecteur"><?=$theme["theme"]?></a>
                        <?php $id_theme = $theme["id_theme"]; ?>
                        <?php $types_zonages = getTypesZonagesByIdCommuneByIdTheme($id_commune, $id_theme) ?>
                    <ul>
                        <?php foreach($types_zonages as $type_zonage): ?>
                        <li><a href="#<?=$type_zonage["id_type"]?>" class="planrubniv1"><?=$type_zonage["type"]?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div><br />
    <?php foreach($themes as $theme): ?>
    <div class="listerub">
        <div class="titresousrub"><?=$theme["theme"]?></div>
        <!-- Affichage du thème des types de zonage -->
        <?php $id_theme = $theme["id_theme"]; ?>
        <?php $types_zonages = getTypesZonagesByIdCommuneByIdTheme($id_commune, $id_theme) ?>
        <?php foreach($types_zonages as $type_zonage): ?>
            <!-- Affichage du type de zonage -->
            <strong><?=$type_zonage["type"]?> :</strong><br />
            <?php $id_type = $type_zonage["id_type"]; ?>
            <?php $zonages = getZonagesByIdTypeByIdCommune($id_type, $id_commune) ?>
            <table class="encadre">
            <?php foreach($zonages as $zonage): ?>
                <!-- Affichage de l'identifiant, du nom du zonage et du lien vers la liste des ressources associées -->
                <tr bgcolor="<?=switchColor()?>" valign="top">
                    <td>
                        <strong><?= $zonage["id_regional"] ?></strong>
                    </td>
                    <td width="99%">&nbsp;<?= mb_strtoupper($zonage["nom"]) ?>
                        <?php if ($zonage["COMMENT"]!=""): ?>
                            <?= '*<br /><em><small>* '.$zonage["COMMENT"].'</small></em>' ?>
                        <?php endif;?>
                    </td>
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
    <?php else: ?>
    <p><strong>Aucun enregistrement pour cette rubrique.</strong></p>
<?php endif; ?>