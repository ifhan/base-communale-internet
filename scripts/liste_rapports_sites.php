<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/SiteClasseInscrit.class.php';

$sites_classes_inscrits = getSitesClassesInscrits();
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Rapport</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($sites_classes_inscrits as $site_classe_inscrit): ?>
        <tr bgcolor="<?=switchcolor()?>" valign="top">
            <td><?=$site_classe_inscrit["id_regional"]?></td>
            <td>&nbsp;<?=$site_classe_inscrit["nom"]?></td>
            <td class="cache">
                <div align="right">
                    <?php if (file_exists("data/docs/rapports/sites/".$site_classe_inscrit["id_regional"].".pdf")): ?>
                    <div align="center">
                        <a href="data/docs/rapports/sites/<?=$site_classe_inscrit["id_regional"]?>.pdf" target="_blank"><img src="IMG/png/filesave.png" style="border:none" alt="T&eacute;l&eacute;charger" /><br />
                            <strong>T&eacute;l&eacute;charger le rapport de pr&eacute;sentation</strong></a>
                        <br />
                        <em>(PDF,&nbsp;<?=@ConvertirTaille("data/docs/rapports/sites/".$site_classe_inscrit["id_regional"].".pdf")?></em>
                    <?php else: ?>
                        <div class=align valign=top>Document non disponible</div>
                    <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>