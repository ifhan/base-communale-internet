<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/TaxonsPC.class.php';

$taxons = getTaxonsPNA();
?>
<div class="listerub">
    <div class="titresousrub">Liens</div>
    <div id ="menu3">
        <div class="voir_sites">
            <ul>
                <li>
                    <a href="http://www.developpement-durable.gouv.fr/-Especes-menacees-les-plans-.html" target="_blank">
                        Consulter la rubrique de pr&eacute;sentation des plans 
                        nationaux d'action sur le site du Minist&egrave;re</a>.
                </li>
                <li>
                    <a href="http://www.developpement-durable.gouv.fr/Plan-national-d-actions-2012-2016.html" target="_blank">
                        Consulter les plans nationaux d'action sur le site 
                        du Minist&egrave;re</a>.
                </li><br />
            </ul>
        </div>
    </div>
</div><!-- listerub --><br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant TAXREF</th>
            <th>Nom scientifique</th>
            <th>Nom vernaculaire</th>
            <th>Fiche INPN</th>
    </thead>
    <tbody>
        <?php foreach ($taxons as $taxons): ?>
        <tr>
            <td><?=$taxons["id_regional"]?></td>
            <td><em><?=$taxons["nom"]?></em></td>
            <td><?=$taxons["NOM_VERNAC"]?></td>
            <?php if ($taxons["id_regional"]!=""): ?>
            <td class="cache">
                <div align="center">
                    <a href="<?=URL_INPN_ESPECE?><?=$taxons["id_regional"]?>" target="_blank">
                        <img src="IMG/png/gnome-globe.png" style="border:none"  alt="T&eacute;l&eacute;charger" />
                        <strong>Consulter la fiche de l'esp&egrave;ce</strong><br /> sur le site 
                        de l'<abbr  title="Inventaire National du Patrimoine Naturel">INPN</abbr></a>.
                </div>
            </td>
            <?php  else: ?>
            <td></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>