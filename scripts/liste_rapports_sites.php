<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/SiteClasseInscrit.class.php';

$sites_classes_inscrits = getSitesClassesInscrits();
define('URL_SIDE', 
        'http://www.side.developpement-durable.gouv.fr/clientBookline/service/reference.asp?INSTANCE=exploitation&OUTPUT=PORTAL&DOCBASE=IFD_SIDE&DOCID=');
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
        <tr valign="top">
            <td><?=$site_classe_inscrit["id_regional"]?></td>
            <td>&nbsp;<?=$site_classe_inscrit["nom"]?></td>
            <td class="cache">
                <?php if (!empty($site_classe_inscrit["id_side"])): ?>
                <div align="center">
                    <a href="<?=URL_SIDE?><?=$site_classe_inscrit["id_side"]?>" 
                       target="_blank"><img 
                            src="IMG/png/gnome-globe.png" 
                            style="border:none" 
                            alt="T&eacute;l&eacute;charger" /><br />
                        <strong>Consulter le rapport de 
                            pr&eacute;sentation</strong> sur le portail 
                        <abbr 
                            title="Syst&egrave;me d'Information Documentaire de l'Environnement">
                            SIDE
                        </abbr>
                    </a>
                    <br />
                    <?php else: ?>
                    <p>Document non disponible</p>
                <?php endif; ?>
            </td>    
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>