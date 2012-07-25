<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Sic.class.php';
require_once 'classes/Znieff2G.class.php';
require_once 'classes/Zonage.class.php';

/**
 * @var $id_eur15 Identifiant de l'habitat de la nomenclature EUR15
 * @var $id_corine Identifiant de l'habitat de la nomenclature CORINE
 * @var $id_dpt Identifiant du département 
 * @var $id_type Identifiant du type de zonage 
 */
$id_eur15 = $_REQUEST["id_eur15"];
$id_corine = $_REQUEST["id_corine"];
$id_dpt = $_REQUEST["id_dpt"];
$id_type = $_REQUEST["id_type"];
?>
<?php if(isset($id_eur15)): 
    /**
    * I. Affiche les sites Natura 2000 par habitat de la nomenclature EUR15 
    * Seule la Directive Habitats est concernee : lien vers les SIC 
    * @todo prévoir un lien vers les ZSC 
    */
    $array_sic = getSicByIdEur15($id_eur15);
?>
    <?php if(count($array_sic) > 0): ?>
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
        <?php foreach ($array_sic as $sic): ?>
        <tr valign="top">
            <?php if (isset($sic["id_regional"])): ?>
            <td><?=$sic["id_regional"];?></td>
            <?php endif; ?>
            <td width="100%"><?=$sic["nom"];?></td>
            <td class="cache">
                <div align="right">
                    <a href="spip.php?page=zonage&id_type=<?=$sic["id_type"];?>&amp;id_regional=<?=$sic["id_regional"];?>"><img src="IMG/png/system-search.png" alt="Icone Afficher" /></a>
                    <br />
                </div>
            </td>
        </tr>
        <?php  endforeach; ?>
</table>
    <?php  else: ?>
<p>Cet habitat n'a pas &eacute;t&eacute; recens&eacute; en Pays de la Loire.</p>
<?php endif; ?>
<?php elseif(isset($id_corine)):
    /**
     * II. Affiche les ZNIEFF par habitat de la nomenclature CORINE 
     */
    $array_znieff = getZnieffByIdCorine($id_corine);
?>    
<?php if(count($array_znieff) > 0): ?>
<br />
<table class="encadre">
    <?php foreach ($array_znieff as $znieff): ?>
    <tr bgcolor="<?=switchcolor()?>" valign=""top>
        <?php if ($znieff["NM_REGZN"]!="0"): ?>
        <td>
            <strong><?=$znieff["NM_REGZN"]?></strong>
        </td>
        <?php endif; ?>
        <td width="99%">&nbsp;<?=$znieff["LB_ZN"]; ?></td>
        <td class="cache">
            <div align="right">
                <?php 
                // Sélection du type de zonage pour le lien hypertexte
                if ($znieff["TY_ZONE"] == "1"):
                    $id_type = "10";
                elseif ($znieff["TY_ZONE"] == "2"):
                    $id_type = "11";
                endif;
                ?>
                <a href="spip.php?page=zonage&id_type=<?=$id_type;?>&amp;id_regional=<?=$znieff["NM_REGZN"]?>"><img src="IMG/png/system-search.png" alt="Icone Afficher" /></a><br />
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>Cet habitat n'a pas &eacute;t&eacute; recens&eacute; en Pays de la Loire.</p>
<?php endif; ?>
<?php elseif($id_dpt!="0"):

    /**
     * III. Affichage du type de zonage sélectionné dans le formulaire 
     * pour le département requis ou la région	
     */

    /**
     * Lien vers les listes CSRPN au format .PDF 
     * pour les ZNIEFF de deuxième génération
     * @todo à supprimer ?
     */
?>
<?php if($id_type==10): ?>
<p>
    <a href="data/listes/<?=$id_dpt?>.pdf">
        T&eacute;l&eacute;charger la liste officielle des
        ZNIEFF valid&eacute;es par le CSRPN (format PDF)
    </a>
</p>
<?php elseif($id_type==11): ?>
<p>
    <a href="data/listes/<?=$id_dpt?>.pdf">
        T&eacute;l&eacute;charger la liste officielle des 
        ZNIEFF valid&eacute;es par le CSRPN (format PDF)
    </a>
</p>
<?php endif; ?>
<?php $zonages = getZonagesByIdTypeByIdDpt($id_type,$id_dpt); ?>
<?php // Affiche le nombre de résultats retourne par la requête ?>
<p>
    <strong><?=count($zonages)?> zonage(s)</strong> 
    recens&eacute;(s) sur l'aire g&eacute;ographique choisie.
</p>
    <?php if(count($zonages) > 0): ?>
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
        <?php foreach($zonages as $zonage): ?>
        <tr valign="top">
            <?php if ($zonage["id_regional"]!="0") : ?>
            <td><?=$zonage["id_regional"]?> </td>
            <?php endif; ?>
            <td width="100%">&nbsp;<?=$zonage["nom"]?></td>
            <td class="cache">
                <div align="right">
                    <a href="spip.php?page=zonage&id_type=<?=$id_type?>&amp;id_regional=<?=$zonage["id_regional"]?>"><img src="IMG/png/system-search.png"  alt="Icone afficher la fiche du zonage" /></a><br />
                </div>
            </td>
        </tr>
        <?php endforeach; ?>		
    </tbody>
</table>
<?php else: echo ""; ?>
<?php endif; ?>
<?php else:
    /** 
     * III. B. Sélection de la region
     */
?>
<?php $zonages = getZonagesByIdTypeByRegion($id_type); ?>
<?php // Affiche le nombre de résultats retourne par la requête ?>
<p>
    <strong><?=count($zonages)?> zonage(s)</strong> 
    recens&eacute;(s) sur l'aire g&eacute;ographique choisie.
</p>
    <?php if(count($zonages) > 0): ?>
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
        <?php foreach ($zonages as $zonage): ?>
        <tr valign="top">
            <?php if ($zonage["id_regional"]!="0"): ?>
            <td><?=$zonage["id_regional"]?></td>
            <?php endif; ?>
            <td width="99%">&nbsp;<?=$zonage["nom"]?></td>
            <td class="cache">
                <div align="right">
                    <a href="spip.php?page=zonage&id_type=<?=$id_type?>;&amp;id_regional=<?=$zonage["id_regional"]?>"><img src="IMG/png/system-search.png" alt="Icone" /></a><br />
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <?php else: echo "";?>
    <?php endif; ?>
<?php endif; ?>