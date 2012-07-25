<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/SiteNatura.class.php';	

/**
 * @var $categorie string Catégorie de site Natura 2000
 * @var $id_type int Identifiant du type de zonage 
 */
$categorie = $_REQUEST["categorie"];
$id_type = $_REQUEST["id_type"];

$sites_natura = getSitesNaturaByCategorie($id_type, $categorie);
?>
<p>
    <strong><?=count($sites_natura)?> site(s) <?=$categorie?>(s)</strong> 
    recens&eacute;(s) sur la r&eacute;gion.
</p>
<br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>          
<?php foreach($sites_natura as $site_natura): ?>
        <tr valign="top">
            <?php if ($site_natura["id_regional"]!="0"):?>
            <td><?=$site_natura["id_regional"]?></td>
            <?php endif; ?>
            <td width="100%">&nbsp; <?=$site_natura["nom"]?></td>
            <td class=cache>
                <div align=right>
                    <a href="spip.php?page=zonage&id_type=<?=$site_natura["id_type"]?>&amp;id_regional=<?=$site_natura["id_regional"]?>"><img src="IMG/png/system-search.png" alt="Icone Afficher" /></a>
                    <br />
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>