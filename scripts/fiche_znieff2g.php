<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';	

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Departement.class.php';
require_once 'classes/Znieff2G.class.php';

/**
 * Ce fichier sert à afficher la fiche descriptive d'une ZNIEFF
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];

$znieff = new Znieff2G();
$znieff->getZnieff2GByIdRegional($id_regional);

$departement = new Departement();
$departement->getDepartementByIdRegional($id_regional,$id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td>
            <strong><?=$znieff->nom?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td>
            <strong><?=$znieff->id_regional?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td>
            <strong><?=$znieff->id_national?></strong>
        </td>
    </tr>
    <tr>
        <td>Type de zone&nbsp;:</td>
        <td>
            <strong><?=$znieff->TY_ZONE?></strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de 1&egrave;re description&nbsp;:</td>
        <td>
            <strong> 
                <?php
                $date = $znieff->AN_DESCRIP;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
		?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de mise &agrave; jour&nbsp;:</td>
        <td>
            <strong>
                <?php
                $date = $znieff->AN_MAJ;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
		?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Ann&eacute;e de validation MNHN&nbsp;:</td>
        <td>
            <strong>
                <?php
                $date = $znieff->AN_SFF;
                list($day, $month, $year) = split('[/.-]', $date);
                echo "$year";
                ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Altitude&nbsp;:</td>
        <td>
            <strong>
                <?=$znieff->ALT_MINI?> - <?=$znieff->ALT_MAXI?> m
            </strong>
        </td>
    </tr>
    <tr>
        <td>Surface d&eacute;clar&eacute;e&nbsp;:</td>
        <td>
            <strong><?=$znieff->SU_ZN?> ha</strong>
        </td>
    </tr>
    <tr>
        <td>D&eacute;partement&nbsp;: </td>
        <td>
            <strong>
                <?=$departement->nom_departement?> (<?=$departement->id_departement?>)
            </strong>
        </td>
    </tr>
</table>
<br />
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>
<h3 class="spip">Typologie des milieux&nbsp;:</h3>
<?php
/**
 * Sélection et affichage conditionnel des milieux déterminants
 */
$fg_typo = "D"; 
$milieux_znieff = getMilieuxZnieff($id_regional,$fg_typo);
?>
<?php if(count($milieux_znieff) > 0): ?>
<br />
<p>
    <strong>a) Milieux d&eacute;terminants&nbsp;:</strong>
</p>
<br />
<table>
    <?php  foreach($milieux_znieff as $milieu_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$milieu_znieff["CD_TYPO"]?> <?=$milieu_znieff["LB_TYPO"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php
/**
 * Sélection et affichage conditionnel des autres milieux
 */
$fg_typo = "A"; 
$milieux_znieff = getMilieuxZnieff($id_regional,$fg_typo);
?>
<?php if(count($milieux_znieff) > 0): ?>
<br />
<p>
    <strong>b) Autres milieux&nbsp;:</strong>
</p>
<br />
<table>
    <?php  foreach($milieux_znieff as $milieu_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$milieu_znieff["CD_TYPO"]?> <?=$milieu_znieff["LB_TYPO"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php
/**
 * Sélection et affichage conditionnel des milieux périphériques
 */
$fg_typo = "P"; 
$milieux_znieff = getMilieuxZnieff($id_regional,$fg_typo);
?>
<?php if(count($milieux_znieff) > 0): ?>
<br />
<p>
    <strong>c) P&eacute;riph&eacute;rie&nbsp;:</strong>
</p>
<br />
<table>
    <?php  foreach($milieux_znieff as $milieu_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$milieu_znieff["CD_TYPO"]?> <?=$milieu_znieff["LB_TYPO"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php if($znieff->TX_TYPO!=""): ?>
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$znieff->TX_TYPO?>
</p>
<?php endif; ?>
<h3 class="spip">Compl&eacute;ments descriptifs&nbsp;:</h3>
<?php 
/**
 * Sélection et affichage conditionnel de la géomorphologie			
 */
$geomorphologies_znieff = getGeomorphologieZnieff($id_regional);
?>
<?php if(count($geomorphologies_znieff) > 0): ?>
<br />
<p>
    <strong>a) G&eacute;omorphologie&nbsp;:</strong>
</p>
<br />
<table>
    <?php foreach ($geomorphologies_znieff as $geomorphologie_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$geomorphologie_znieff["CD_GEO"]?> <?=$geomorphologie_znieff["LB_GEO"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php if($znieff->TX_GEO!=""): ?>
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$znieff->TX_GEO?>
</p> 
<?php endif; ?>
<?php      
/**
 * Sélection et affichage conditionnel des activités humaines
 */
$activites_humaines_znieff = getActivitesHumainesZnieff($id_regional); ?>
<?php if(count($activites_humaines_znieff) > 0): ?>
<br />
<p>
    <strong>b) Activit&eacute;s humaines&nbsp;:</strong>
</p>
<br />
<table>
    <?php foreach ($activites_humaines_znieff as $activite_humaine_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$activite_humaine_znieff["CD_ACTH"]?> <?=$activite_humaine_znieff["LB_ACTH"]?>
        </td>
    </tr> 
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php if($znieff->TX_ACTH!=""): ?>
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$znieff->TX_ACTH?>
</p> 
<?php endif; ?>
<?php
/** 
 * Sélection et affichage conditionnel des statuts de propriété
 */
$statuts_propriete_znieff = getStatutsProprieteZnieff($id_regional);
?>
<?php if(count($statuts_propriete_znieff) > 0): ?>
<br />
<p>
    <strong>c) Statuts de propri&eacute;t&eacute;&nbsp;:</strong>
</p>
<br />
<table>
    <?php foreach($statuts_propriete_znieff as $statut_propriete_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$statut_propriete_znieff["CD_STPRO"]?> <?=$statut_propriete_znieff["LB_STPRO"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php if($znieff->TX_STPRO!=""): ?>
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$znieff->TX_STPRO?>
</p> 
<?php endif; ?>
<?php
/**
 *  Sélection et affichage conditionnel des mesures de protection
 */
$mesures_protection_znieff = getMesuresProtectionZnieff($id_regional);
 ?>
<?php if(count($mesures_protection_znieff) > 0): ?>
<br />
<p>
    <strong>d) Mesures de protection&nbsp;:</strong>
</p>
<br />
<table>
    <?php foreach($mesures_protection_znieff as $mesure_protection_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
        <?=$mesure_protection_znieff["CD_MPRO"]?> <?=$mesure_protection_znieff["LB_MPRO"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php if($znieff->TX_MESPRO!=""): ?> 
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$znieff->TX_MESPRO?>
</p>
<?php endif; ?>
<br />
<p>
    <strong>e) Autres inventaires&nbsp;:</strong>
</p>
<br />
<p>
    <?php
    if($znieff->FG_HABITAT!='O') { echo "Pas de Directive Habitats / "; }
    else { echo "Directive Habitats / "; }
    if($znieff->FG_OISEAUX!='O') { echo "Pas de Directive Oiseaux";}
    else { echo "Directive Oiseaux"; }
    ?>
</p>
<h3 class="spip">
    Facteurs influen&ccedil;ant l'&eacute;volution de la zone&nbsp;:
</h3>
<?php $facteurs_evolution_znieff = getFacteursEvolutionZnieff($id_regional); ?>
<table>
    <?php foreach($facteurs_evolution_znieff as $facteur_evolution_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$facteur_evolution_znieff["CD_FACT"]?> <?=$facteur_evolution_znieff["LB_FACT"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php if($znieff->TX_FACT!=""): ?> 
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$znieff->TX_FACT?>
</p>
<?php endif; ?>
<?php $criteres_interet_znieff = getCriteresInteretZnieff($criteres_interet_znieff); ?>
<?php if(count($criteres_interet_znieff) > 0): ?>
<h3 class="spip">Crit&egrave;res d'int&eacute;r&ecirc;t&nbsp;:</h3>
    <?php
    /**
     * Sélection et affichage conditionnel des critères d'intérêt patrimonial
     * d'une ZNIEFF 
     */
    $criteres_patrimoniaux_znieff = getCriteresPatrimoniauxZnieff($id_regional);
    ?>
    <?php if(count($criteres_patrimoniaux_znieff) > 0): ?>
<br />
<p>
    <strong>a) Patrimoniaux&nbsp;:</strong>
</p>
<br />
<table>
    <?php foreach($criteres_patrimoniaux_znieff as $critere_patrimonial_znieff): ?> 
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$critere_patrimonial_znieff["CD_INTER"]?> <?=$critere_patrimonial_znieff["LB_INTER"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
    <?php endif; ?>
    <?php 
    /**
     * Sélection et affichage conditionnel des critères d'intérêt fonctionnel
     * d'une ZNIEFF 
     */
    $criteres_fonctionnels_znieff = getCriteresFonctionnelsZnieff($id_regional);
    ?>
    <?php if(count($criteres_fonctionnels_znieff) > 0): ?>
<br />
<p>
    <strong>b) Fonctionnels&nbsp;:</strong>
</p>
<br />
<table>
    <?php foreach($criteres_fonctionnels_znieff as $critere_fonctionnel_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$critere_fonctionnel_znieff["CD_INTER"]?> <?=$critere_fonctionnel_znieff["LB_INTER"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
    <?php endif; ?>
    <?php
    /**
     * Sélection et affichage conditionnel des critères d'intérêt complémentaire
     * d'une ZNIEFF 
     */
    $criteres_complementaires_znieff = getCriteresComplementairesZnieff($id_regional);
    ?>
    <?php if(count($criteres_complementaires_znieff) > 0): ?>
<br />
<p>
    <strong>c) Compl&eacute;mentaires&nbsp;:</strong>
</p>
<br />
<table>
    <?php foreach($criteres_complementaires_znieff as $critere_complementaire_znieff): ?> 
    <tr>
        <td bgcolor="<?=switchColor()?>">
            <?=$critere_complementaire_znieff["CD_INTER"]?> <?=$critere_complementaire_znieff["LB_INTER"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
    <?php endif; ?>
<?php endif; ?>
<h3 class="spip">Bilan des connaissances concernant les esp&egrave;ces&nbsp;:</h3>
<br />
<p>
    <strong>a) Faune&nbsp;:</strong>
</p>
<br />
<table class="encadre">
    <tr>
        <th></th>
        <th>Mamm.</th>
        <th>Oiseaux</th>
        <th>Reptiles</th>
        <th>Amphib.</th>
        <th>Poissons</th>
        <th>Insectes</th>
        <th>Autr. Inv.</th>
    </tr>
    <tr>
        <?php 
        $prospection = new Znieff2G();
        $prospection->getProspectionZnieff($id_regional);
        ?>
        <td>Prospection</td>
        <td><?=$prospection->NB_PR_MAM?></td>
        <td><?=$prospection->NB_PR_OIS?></td>
        <td><?=$prospection->NB_PR_REP?></td>
        <td><?=$prospection->NB_PR_AMP?></td>
        <td><?=$prospection->NB_PR_POI?></td>
        <td><?=$prospection->NB_PR_INS?></td>
        <td><?=$prospection->NB_PR_AUT?></td>
    </tr>
    <tr>
        <td>Nb. Esp&egrave;ces<br />cit&eacute;es</td>
        <td>
            <?php 
            $cd_esp = "75%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "74%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "73%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "72%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "71%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "57%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $nb_autres_especes_citees = getNbAutresEspecesFauneCitees($id_regional,$cd_esp);
            echo count($nb_autres_especes_citees);
            ?>
        </td>
    </tr>
    <tr>
        <td>Nb. Esp&egrave;ces prot&eacute;g&eacute;es</td>
        <td><?=$prospection->NB_EP_MAM?></td>
        <td><?=$prospection->NB_EP_OIS?></td>
        <td><?=$prospection->NB_EP_REP?></td>
        <td><?=$prospection->NB_EP_AMP?></td>
        <td><?=$prospection->NB_EP_POI?></td>
        <td><?=$prospection->NB_EP_INS?></td>
        <td><?=$prospection->NB_EP_AUT?></td>
    </tr>
    <tr>
        <td>Nb. sp. rares ou menac&eacute;es</td>
        <td><?=$prospection->NB_RM_MAM?></td>
        <td><?=$prospection->NB_RM_OIS?></td>
        <td><?=$prospection->NB_RM_REP?></td>
        <td><?=$prospection->NB_RM_AMP?></td>
        <td><?=$prospection->NB_RM_POI?></td>
        <td><?=$prospection->NB_RM_INS?></td>
        <td><?=$prospection->NB_RM_AUT?></td>
    </tr>
    <tr>
        <td>Nb. Esp&egrave;ces end&eacute;miques</td>
        <td><?=$prospection->NB_EE_MAM?></td>
        <td><?=$prospection->NB_EE_OIS?></td>
        <td><?=$prospection->NB_EE_REP?></td>
        <td><?=$prospection->NB_EE_AMP?></td>
        <td><?=$prospection->NB_EE_POI?></td>
        <td><?=$prospection->NB_EE_INS?></td>
        <td><?=$prospection->NB_EE_AUT?></td>
    </tr>
    <tr>
        <td>Nb. sp. &agrave; aire disjointe</td>
        <td><?=$prospection->NB_AD_MAM?></td>
        <td><?=$prospection->NB_AD_OIS?></td>
        <td><?=$prospection->NB_AD_REP?></td>
        <td><?=$prospection->NB_AD_AMP?></td>
        <td><?=$prospection->NB_AD_POI?></td>
        <td><?=$prospection->NB_AD_INS?></td>
        <td><?=$prospection->NB_AD_AUT?></td>
    </tr>
    <tr>
        <td>Nb. sp. en limite d'aire</td>
        <td><?=$prospection->NB_LA_MAM?></td>
        <td><?=$prospection->NB_LA_OIS?></td>
        <td><?=$prospection->NB_LA_REP?></td>
        <td><?=$prospection->NB_LA_AMP?></td>
        <td><?=$prospection->NB_LA_POI?></td>
        <td><?=$prospection->NB_LA_INS?></td>
        <td><?=$prospection->NB_LA_AUT?></td>
    </tr>
    <tr>
        <td>Nb. sp. margin. &eacute;cologique</td>
        <td><?=$prospection->NB_ME_MAM?></td>
        <td><?=$prospection->NB_ME_OIS?></td>
        <td><?=$prospection->NB_ME_REP?></td>
        <td><?=$prospection->NB_ME_AMP?></td>
        <td><?=$prospection->NB_ME_POI?></td>
        <td><?=$prospection->NB_ME_INS?></td>
        <td><?=$prospection->NB_ME_AUT?></td>
    </tr>
</table>
<br />
<p>
    <strong>b) Flore&nbsp;:</strong>
</p>
<br />
<table class="encadre">
    <tr>
        <th></th>
        <th>Phan&eacute;ro.</th>
        <th>Pt&eacute;ridop.</th>
        <th>Bryophy.</th>
        <th>Lichens</th>
        <th>Champ.</th>
        <th>Algues</th>
    </tr>
    <tr>
        <td>Prospection</td>
        <td><?=$prospection->NB_PR_PHA?></td>
        <td><?=$prospection->NB_PR_PTE?></td>
        <td><?=$prospection->NB_PR_BRY?></td>
        <td><?=$prospection->NB_PR_LIC?></td>
        <td><?=$prospection->NB_PR_CHA?></td>
        <td><?=$prospection->NB_PR_ALG?></td>
    </tr>
    <tr>
        <td>Nb. Esp&egrave;ces<br />cit&eacute;es</td>
        <td>
            <?php 
            $nb_especes_phanero_citees = getNbEspecesPhaneroCitees($id_regional);
            echo count($nb_especes_phanero_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "81%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "80%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "21%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php 
            $cd_esp = "20%";
            $nb_especes_citees = getNbEspecesCitees($id_regional,$cd_esp);
            echo count($nb_especes_citees);
            ?>
        </td>
        <td>
            <?php
            $nb_algues_citees = getNbAlguesCitees($id_regional);
            echo count($nb_algues_citees);
            ?>
        </td>
    </tr>
    <tr>
        <td>Nb. Esp&egrave;ces prot&eacute;g&eacute;es</td>
        <td><?=$prospection->NB_EP_PHA?></td>
        <td><?=$prospection->NB_EP_PTE?></td>
        <td><?=$prospection->NB_EP_BRY?></td>
        <td><?=$prospection->NB_EP_LIC?></td>
        <td><?=$prospection->NB_EP_CHA?></td>
        <td><?=$prospection->NB_EP_ALG?></td>
    </tr>
    <tr>
        <td>Nb. sp. rares ou menac&eacute;es</td>
        <td><?=$prospection->NB_RM_PHA?></td>
        <td><?=$prospection->NB_RM_PTE?></td>
        <td><?=$prospection->NB_RM_BRY?></td>
        <td><?=$prospection->NB_RM_LIC?></td>
        <td><?=$prospection->NB_RM_CHA?></td>
        <td><?=$prospection->NB_RM_ALG?></td>
    </tr>
    <tr>
        <td>Nb. Esp&egrave;ces end&eacute;miques</td>
        <td><?=$prospection->NB_EE_PHA?></td>
        <td><?=$prospection->NB_EE_PTE?></td>
        <td><?=$prospection->NB_EE_BRY?></td>
        <td><?=$prospection->NB_EE_LIC?></td>
        <td><?=$prospection->NB_EE_CHA?></td>
        <td><?=$prospection->NB_EE_ALG?></td>
    </tr>
    <tr>
        <td>Nb. sp. &agrave; aire disjointe</td>
        <td><?=$prospection->NB_AD_PHA?></td>
        <td><?=$prospection->NB_AD_PTE?></td>
        <td><?=$prospection->NB_AD_BRY?></td>
        <td><?=$prospection->NB_AD_LIC?></td>
        <td><?=$prospection->NB_AD_CHA?></td>
        <td><?=$prospection->NB_AD_ALG?></td>
    </tr>
    <tr>
        <td>Nb. sp. en limite d'aire</td>
        <td><?=$prospection->NB_LA_PHA?></td>
        <td><?=$prospection->NB_LA_PTE?></td>
        <td><?=$prospection->NB_LA_BRY?></td>
        <td><?=$prospection->NB_LA_LIC?></td>
        <td><?=$prospection->NB_LA_CHA?></td>
        <td><?=$prospection->NB_LA_ALG?></td>
    </tr>
    <tr>
        <td>Nb. sp. margin.&eacute;cologique</td>
        <td><?=$prospection->NB_ME_PHA?></td>
        <td><?=$prospection->NB_ME_PTE?></td>
        <td><?=$prospection->NB_ME_BRY?></td>
        <td><?=$prospection->NB_ME_LIC?></td>
        <td><?=$prospection->NB_ME_CHA?></td>
        <td><?=$prospection->NB_ME_ALG?></td>
    </tr>
</table>
<?php
/**
 * Sélection et affichage conditionnel des critères de délimitation de la ZNIEFF
 */
$criteres_delim_znieff = getCriteresDelimitationZnieff($id_regional);
 ?>
<?php if (count($criteres_delim_znieff) > 0): ?>
<h3 class="spip">Crit&egrave;res de d&eacute;limitation de la zone&nbsp;:</h3>
<table>
    <?php foreach($criteres_delim_znieff as $critere_delim_znieff): ?>
    <tr>
        <td bgcolor="<?=switchColor()?>">
        <?=$critere_delim_znieff["CD_DELIM"]?> <?=$critere_delim_znieff["LB_DELIM"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
/**
 * Affichage conditionnel du commentaire sur les critères de délimitation 
 * de la ZNIEFF
 */
$comment_znieff = new Znieff2G();
$comment_znieff->getCommentCriteresDelimitationZnieff($id_regional);
?>
    <?php if ($comment_znieff->CM_DELIM!=""): ?>
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$comment_znieff->CM_DELIM?>
</p>
    <?php endif; ?>
<?php else: ?>
    <?php if ($val_3["CM_DELIM"] != ""): ?>
<h3 class="spip">Crit&egrave;res de d&eacute;limitation de la zone</h3>
<br />
<p>
    <strong>Commentaires&nbsp;:</strong>&nbsp;<?=$val_3["CM_DELIM"]?>
</p>
    <?php endif; ?>
<?php endif; ?>	
<h3 class="spip">Commentaire g&eacute;n&eacute;ral&nbsp;:</h3>
<p><?=$znieff->CM_GENE?></p>
<?php
/**
 * Sélection et affichage conditionnel des liens avec d'autres ZNIEFF 
 */
$liens_autres_znieff = getLiensAutresZnieff($id_regional);
?>
<?php if (count($liens_autres_znieff) > 0): ?>
<h3 class="spip">Liens avec d'autres ZNIEFF</h3>
<table>
    <?php foreach($liens_autres_znieff as $lien_autres_znieff): ?>
    <tr>
        <td bgcolor="<?=switcholor()?>">
            <?=$lien_autres_znieff["NM_SFF2"]?> <?=$lien_autres_znieff["LB_ZN2"]?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<h3 class="spip">Sources&nbsp;:</h3>
<?php 
/**
 * Sélection et affichage conditionnel des informateurs d'une ZNIEFF
 */
$ty_source = "I";
$sources_znieff = getSourcesZnieff($id_regional,$ty_source);
?>
<?php if (count($sources_znieff) > 0): ?>
<br />
<p>
    <strong>Informateurs :</strong>
</p>
<br />
<ul class="spip">
    <?php foreach ($sources_znieff as $informateur_znieff): ?>
    <li><?=$informateur_znieff["LB_SOURCE"]?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<?php
/**
 * Sélection et affichage conditionnel de la bibliographie d'une ZNIEFF
 */
$ty_source = "B";
$sources_znieff = getSourcesZnieff($id_regional,$ty_source);
 ?>
<?php if (count($sources_znieff) > 0): ?>
<br />
<p>
    <strong>Bibliographies :</strong>
</p>
<br />
<ul class="spip">
    <?php foreach ($sources_znieff as $bibliographie_znieff): ?>
    <li><?=$bibliographie_znieff["LB_SOURCE"]?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>