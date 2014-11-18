<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Docob.class.php';
require_once 'classes/Zonage.class.php';

$docobs = getDocob();
define('URL_SIDE', 
        'http://www.side.developpement-durable.gouv.fr/clientBookline/service/reference.asp?INSTANCE=exploitation&OUTPUT=PORTAL&DOCBASE=IFD_SIDE&DOCID=');
define('URL_DREAL', 
        'http://www.pays-de-la-loire.developpement-durable.gouv.fr/article.php3?id_article=');
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Type</th>
            <th>DOCOB</th>
            <th>Arr&ecirc;t&eacute;s</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($docobs as $docob): ?>
        <tr valign="top">
            <td><?=$docob["id_regional"]?></td><td><?=$docob["nom"]?></td>
            <td>
                <?php
                switch($docob["id_type"]):
                    case 5:
                        echo "ZPS";
                        break;
                    case 6:
                        echo "SIC";
                        break;
                    case 30;
                        echo "ZSC";
                        break; 
                endswitch; 
                ?>
            </td>
            <td>
                <?php if ($docob["id_side"] !== "0"): ?>
                <div align="center">
                    <a href="<?=URL_SIDE?><?=$docob["id_side"]?>" 
                       target="_blank"><img 
                            src="IMG/png/gnome-globe.png" 
                            style="border:none" 
                            alt="T&eacute;l&eacute;charger" /><br />
                        <strong>Consulter le DOCOB</strong> sur le portail 
                        <abbr 
                            title="Syst&egrave;me d'Information Documentaire de l'Environnement">
                            SIDE
                        </abbr>
                    </a>
                    <br />
                <?php endif; ?>
            </td>
            <td>
                <?php if ($docob["id_article"] !== "0"): ?>
                <div align="center">
                    <a href="<?=URL_DREAL?><?=$docob["id_article"]?>" 
                       target="_blank"><img 
                            src="IMG/png/gnome-globe.png" 
                            style="border:none" 
                            alt="T&eacute;l&eacute;charger" /><br />
                        <strong>Consulter les arr&ecirc;t&eacute;s</strong> 
                        sur le site Internet de la DREAL 
                    </a>
                    <br />
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>