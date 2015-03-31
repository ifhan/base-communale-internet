<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/TaxonsPlans.class.php';

/**
 * @var $type_sp Type d'espèces (Faune/Flore)
 */
$type_sp = $_REQUEST["type_sp"];

$taxons = getTaxonsPNA($type_sp);
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
            <th>Plan d'action</th>
    </thead>
    <tbody>
        <?php foreach ($taxons as $taxon): ?>
        <tr>
            <td><?=$taxon["id_regional"]?></td>
            <td><em><?=$taxon["nom"]?></em></td>
            <td><?=$taxon["NOM_VERNAC"]?></td>
            <?php if ($taxon["id_regional"]!=""): ?>
            <td class="cache">
                <div align="center">
                    <?php switch($taxon["RANG"]): 
                        case 'OR':
                    ?>
                    <a href="<?=URL_INPN_TAXO_TREE?><?=$taxon["id_regional"]?>" 
                       target="_blank">
                        <img src="IMG/png/gnome-globe.png" style="border:none"  alt="T&eacute;l&eacute;charger" />
                        <strong>Voir l'ordre dans l'arbre taxononmique</strong><br /> sur le site 
                        de l'<abbr  title="Inventaire National du Patrimoine Naturel">INPN</abbr></a>.
                    <?php        
                            break;
                        case 'GN':
                    ?>
                    <a href="<?=URL_INPN_TAXO_TREE?><?=$taxon["id_regional"]?>" 
                       target="_blank">
                        <img src="IMG/png/gnome-globe.png" style="border:none"  alt="T&eacute;l&eacute;charger" />
                        <strong>Voir le genre dans l'arbre taxononmique</strong><br /> sur le site 
                        de l'<abbr  title="Inventaire National du Patrimoine Naturel">INPN</abbr></a>.                    
                    <?php
                            break;
                        case 'ES':
                    ?>
                    <a href="<?=URL_INPN_ESPECE?><?=$taxon["id_regional"]?>" 
                       target="_blank">
                        <img src="IMG/png/gnome-globe.png" style="border:none"  alt="T&eacute;l&eacute;charger" />
                        <strong>Consulter la fiche de l'esp&egrave;ce</strong><br /> sur le site 
                        de l'<abbr  title="Inventaire National du Patrimoine Naturel">INPN</abbr></a>.    
                    <?php
                            break;
                        
                    endswitch;
                    ?>
                </div>
            </td>
            <?php  else: ?>
            <td></td>
            <?php endif; ?>
            <td>
                <a href="<?=$taxon["URL"]?>" target="_blank">
                    <img src="IMG/png/gnome-globe.png" style="border:none"  alt="T&eacute;l&eacute;charger" />
                    <strong>Consulter le plan d'actions</strong><br /> sur le 
                    site du Minist&egrave;re</a>.
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>