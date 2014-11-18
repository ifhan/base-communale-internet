<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/TaxonsPlans.class.php';

/**
 * @var $type_plan Type de plan
 * @var $type_sp Type d'espèces (Faune/Flore)
 */
$type_plan = $_REQUEST["type_plan"];
$type_sp = $_REQUEST["type_sp"];

$taxons = getTaxons($type_plan,$type_sp);
?>
<?php // Affiche le nombre de résultats retourne par la requête  ?>
<p>
    <strong><?= count($taxons) ?> taxon(s)</strong> 
        recens&eacute;(s) pour le type de plan s&eacute;lectionn&eacute;.
</p>
<?php if (count($taxons) > 0): ?>
<div class="listerub">
    <div class="titresousrub">Liens</div>
    <div id ="menu3">
        <div class="voir_sites">
            <ul>
                <?php
                switch ($type_plan):
                    case "PNA":
                ?>
                <li>
                    <a href="http://www.developpement-durable.gouv.fr/-Especes-menacees-les-plans-.html" target="_blank">
                        Consulter la rubrique de pr&eacute;sentation des plans 
                        nationaux d'action sur le site du Minist&egrave;re</a>.
                </li><br />
                <?php
                        break;
                    case "PCR":
                ?>
                <li>
                    <a href="http://www.cbnbrest.fr/site/html/regions/strategie_conservation.html" target="_blank">
                        Consulter la strat&eacute;gie de conservation sur le site 
                        du <abbr  title="Conservatoire Botanique National de Brest">CBNB</abbr></a>.
                </li>
                <li>
                    <a href="http://www.cbnbrest.fr/site/html/regions/strategie_conservation_pdl.html#pla" target="_blank">
                        Consulter les plans de conservations sur le site 
                        du <abbr  title="Conservatoire Botanique National de Brest">CBNB</abbr></a>.
                </li> 
                <li>
                    <a href="data/docs/rapports/flore/RAPPORT_CBNB_ suivi des PCR _PDL_2013 tr.pdf" target="_blank">
                    T&eacute;l&eacute;charger le rapport <abbr  title="Conservatoire Botanique National de Brest">CBNB</abbr>
                    de suivi 2013 des Plans de Conservations R&eacute;gionaux</a> 
                    (format PDF,&nbsp;<?= @convertFilesize("data/docs/rapports/flore/RAPPORT_CBNB_ suivi des PCR _PDL_2013 tr.pdf") ?>).
                </li><br />                
                <?php
                        break;
                    case "PCL":
                ?>
                <li>
                    <a href="http://www.pays-de-la-loire.developpement-durable.gouv.fr/plans-de-conservation-issus-de-r642.html" target="_blank">
                        Consulter la présentation sur le site Internet de la DREAL</a>.
                </li><br />
                <?php
                        break;
                    case "PRA":
                ?>
                <li>
                    <a href="http://paysdelaloire.lpo.fr/actions/conservation-des-especes-et-des-espaces/50-plan-d-actions-pour-les-especes" target="_blank">
                        Consulter la présentation sur le site Internet de la <abbr  title="Ligue pour la Protection des Oiseaux">LPO</abbr> Pays de la Loire</a>.
                </li><br />
                <?php
                        break;
                endswitch;
                ?>

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
            <th>
            <?php if($type_plan == ("PNA" || "PRA")): ?>Plan d'actions<?php endif; ?>
            <?php if($type_plan == "PCR"): ?>Plan de conservation<?php endif; ?>
            <?php if($type_plan == "PCL"): ?>&Eacute;tat des lieux et/ou Plan de conservation<?php endif; ?>
            </th>
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
            <?php if(!empty($taxon["URL"])): ?>
                <a href="<?=$taxon["URL"]?>" target="_blank">
                    <img src="IMG/png/gnome-globe.png" style="border:none"  alt="T&eacute;l&eacute;charger" />               
                    <?php if($type_plan == "PNA"): ?>
                        <strong>Consulter le plan d'actions</strong>
                        <br /> sur le site du Minist&egrave;re</a>.
                    <?php endif; ?>
                    <?php if($type_plan == "PCR"): ?>
                        <strong>Consulter le plan de conservation</strong>
                        <br /> sur le site du <abbr  title="Conservatoire Botanique National de Brest">CBNB</abbr></a>.
                    <?php endif; ?>
                    <?php if($type_plan == "PCL"): ?>
                        <strong>Consulter le document</strong></a>.                 
                    <?php endif; ?>
                    <?php if($type_plan == "PRA"): ?>
                        <strong>Consulter le plan d'actions</strong></a>.                 
                    <?php endif; ?>
            <?php endif; ?>
            </td>
            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>