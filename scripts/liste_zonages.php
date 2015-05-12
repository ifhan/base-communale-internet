<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Sic.class.php';
require_once 'classes/Zonage.class.php';

/**
 * @var $id_eur15 Identifiant de l'habitat de la nomenclature EUR15
 * @var $id_corine Identifiant de l'habitat de la nomenclature CORINE
 * @var $id_dpt Identifiant du département 
 * @var $id_type Identifiant du type de zonage 
 */
$id_eur15 = $_REQUEST["id_eur15"];
$id_dpt = $_REQUEST["id_dpt"];
$id_type = $_REQUEST["id_type"];
?>
<!-- 1. Affiche les sites Natura 2000 par habitat de la nomenclature EUR15 
     Seule la Directive Habitats est concernée : lien vers les SIC 
     @todo prévoir un lien vers les ZSC -->
<?php if(isset($id_eur15)): ?>
<?php $array_sic = getSicByIdEur15($id_eur15); ?>
<?php if (count($array_sic) > 0): ?><br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($array_sic as $sic): ?>
        <tr valign="top">
        <?php if (isset($sic["id_regional"])): ?>
            <td><?= $sic["id_regional"]; ?></td>
        <?php endif; ?>
            <td width="100%"><?= $sic["nom"]; ?></td>
            <td class="cache">
                <div align="right">
                    <a href="spip.php?page=zonage&id_type=<?= $sic["id_type"]; ?>&amp;id_regional=<?= $sic["id_regional"]; ?>">
                        <img src="IMG/png/system-search.png" alt="Icone Afficher" />
                    </a><br />
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>Cet habitat n'a pas &eacute;t&eacute; recens&eacute; en Pays de la Loire.</p>
<?php endif; ?>
<!-- 2. Affichage du type de zonage sélectionné dans le formulaire -->
<!-- 2.1 Affichage pour un département -->
<?php elseif($id_dpt != "0"): ?>
<?php $zonages = getZonagesByIdTypeByIdDpt($id_type, $id_dpt); ?>
<!-- Affiche le nombre de résultats retourne par la requête  -->
<p>
    <strong><?= count($zonages) ?> enregistrement(s)</strong> 
    recens&eacute;(s) sur l'aire g&eacute;ographique choisie.
</p>
<?php if(count($zonages)>0): ?><br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($zonages as $zonage): ?>
        <tr valign="top">
        <?php if ($zonage["id_regional"] != "0") : ?>
            <td><?= $zonage["id_regional"] ?> </td>
        <?php endif; ?>
            <td width="100%">&nbsp;<?=$zonage["nom"]?></td>
            <td class="cache">
                <div align="right">
                    <a href="spip.php?page=zonage&id_type=<?= $id_type ?>&amp;id_regional=<?= $zonage["id_regional"] ?>">
                        <img src="IMG/png/system-search.png"  alt="Icone afficher la fiche du zonage" />
                    </a><br />
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: echo ""; ?>
<?php endif; ?>
<!-- 2.2 Sélection de la région -->
<?php else: ?>
<?php $zonages = getZonagesByIdTypeByRegion($id_type); ?>
<!-- Affiche le nombre de résultats retourne par la requête  -->
<p>
    <strong><?= count($zonages) ?> enregistrement(s)</strong> 
    recens&eacute;(s) sur l'aire g&eacute;ographique choisie.
</p>
<?php if(count($zonages)>0): ?><br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($zonages as $zonage): ?>
        <tr valign="top">
        <?php if ($zonage["id_regional"] != "0"): ?>
            <td><?= $zonage["id_regional"] ?></td>
        <?php endif; ?>
            <td width="99%">&nbsp;<?=$zonage["nom"]?></td>
            <td class="cache">
                <div align="right">
                    <a href="spip.php?page=zonage&id_type=<?= $id_type ?>&amp;id_regional=<?= $zonage["id_regional"] ?>">
                        <img src="IMG/png/system-search.png" alt="Icone" />
                    </a><br />
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: echo ""; ?>
<?php endif; ?>
<?php endif; ?>