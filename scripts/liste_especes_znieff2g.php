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
$departement->getDepartementByIdRegional($id_regional, $id_type);
?>
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td>
            <strong><?= $znieff->nom ?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant r&eacute;gional&nbsp;:</td>
        <td>
            <strong><?= $znieff->id_regional ?></strong>
        </td>
    </tr>
    <tr>
        <td>Identifiant SPN&nbsp;:</td>
        <td>
            <strong><?= $znieff->id_national ?></strong>
        </td>
    </tr>
    <tr>
        <td>Type de zone&nbsp;:</td>
        <td>
            <strong><?= $znieff->TY_ZONE ?></strong>
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
                <?= $znieff->ALT_MINI ?> - <?= $znieff->ALT_MAXI ?> m
            </strong>
        </td>
    </tr>
    <tr>
        <td>Surface d&eacute;clar&eacute;e&nbsp;:</td>
        <td>
            <strong><?= $znieff->SU_ZN ?> ha</strong>
        </td>
    </tr>
    <tr>
        <td>D&eacute;partement&nbsp;: </td>
        <td>
            <strong>
                <?= $departement->nom_departement ?> (<?= $departement->id_departement ?>)
            </strong>
        </td>
    </tr>
</table>
<br />
<h3 class="spip">Commune(s) concern&eacute;e(s)&nbsp;:</h3>
<?php require_once 'inc/commune.inc.php'; ?>
<h3 class="spip">Esp&egrave;ces d&eacute;terminantes&nbsp;:</h3>
<?php include ("squelettes/nomenclature.html"); ?>
<?php
$especes_determinantes = getEspecesByIdRegionalByFgEsp($id_regional,"D");
?>
<p>
    <strong><?= count($especes_determinantes) ?> esp&egrave;ce(s) 
        d&eacute;terminante(s)</strong> recens&eacute;e(s) dans cette ZNIEFF.
</p><br />
<?php if (count($especes_determinantes) > 0): ?>
    <table class="encadre" width="99%">
        <tr>
            <th>Taxon</th>
            <th>Statut</th>
            <th>Abondance</th>
            <th>Effectif<br />Min.-Max.</th>
            <th>P&eacute;riode d'obs.<br />D&eacute;but-Fin</th>
        </tr>
        <?php
        foreach ($especes_determinantes as $espece_determinante):
            /**
             *  Affichage de l'embranchement, de la classe ou de l'ordre
             */
            $ms_arbo_pere = $espece_determinante["MS_ARBO_PERE"];
            $embranchements = getEmbranchementsEspece($ms_arbo_pere);

            foreach ($embranchements as $embranchement):

                /**
                 *  Affichage du sous-règne, de l'embranchement, 
                 *  du super embranchement, de la classe ou de la super classe
                 */
                $ms_arbo_pere = $embranchement["MS_ARBO_PERE"];
                $sous_regnes = getSousRegnes($ms_arbo_pere);

                /**
                 *  Affichage du nom vernaculaire de l'espèce
                 */
                /*$CD_ESP = $espece_determinante["CD_ESP"];
                $especes_flore = getNomVernaculaireFlore($CD_ESP);

                $CD_ESP = $espece_determinante["CD_ESP"];
                $especes_faune = getNomVernaculaireFaune($CD_ESP);*/
                ?>
                <tr>
                    <td class="left" bgcolor="<?= switchcolor() ?>">
                        <?php foreach ($sous_regnes as $sous_regne): ?>
                            <?php if ($sous_regne["LB_ESP"] != ""): ?>
                                <strong><?= $sous_regne["LB_ESP"] ?> &raquo; </strong>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <strong><?= $embranchement["LB_ESP"] ?> &raquo; </strong><br />
                        <?php
                        /**
                         *  Affichage du nom latin de l'espèce
                         */
                        if (ereg("^(1)", $espece_determinante["MS_ARBO_PERE"])):
                            echo "<em>" . $espece_determinante["LB_ESP"] . "</em> ";
                        elseif (ereg("^(2)", $espece_determinante["MS_ARBO_PERE"])):
                            echo "<em>" . $espece_determinante["LB_ESP"] . "</em> ";
                        elseif (ereg("^(3)", $espece_determinante["MS_ARBO_PERE"])):
                            echo "<em>" . $espece_determinante["LB_ESP"] . "</em> ";
                        elseif (ereg("^(4)", $espece_determinante["MS_ARBO_PERE"])):
                            echo "<em>" . $espece_determinante["LB_ESP"] . "</em> ";
                        elseif (ereg("^(5)", $espece_determinante["MS_ARBO_PERE"])):
                            echo "<em>" . $espece_determinante["LB_ESP"] . "</em> ";
                        endif;
                        ?>
                        <?php
                        /**
                         * Affichage du nom vernaculaire de l'espèce
                         */
                        /*if (ereg("^(4)", $espece_determinante["MS_ARBO_PERE"])):
                            foreach ($especes_faune as $espece_faune):
                                if($espece_faune["NOM_VERNAC"] != ""):
                                    echo "(" . $espece_faune["NOM_VERNAC"] . ")";
                                endif;
                            endforeach;
                        else:
                            foreach ($especes_flore as $espece_flore):
                                if($espece_flore["NOM_VERNAC"] != ""):
                                    echo "(" . $espece_flore["NOM_VERNAC"] . ")";
                                endif;
                            endforeach;
                        endif;*/
                        ?>
                    </td>
                    <td class="align"><?= $espece_determinante["CD_STATUT"] ?>
                    </td>
                    <td class="align"><?= $espece_determinante["CD_ABOND"] ?></td>
                    <td class="align">
                        <?php
                        if ($espece_determinante["NB_I_ABOND"] != "0"):
                            echo $espece_determinante["NB_I_ABOND"];
                        else: echo "?";
                        endif;
                        echo " - ";
                        if ($espece_determinante["NB_S_ABOND"] != "0"):
                            echo $espece_determinante["NB_S_ABOND"];
                        else: echo "?";
                        endif;
                        ?>
                    </td>
                    <td class="align">
                        <?php
                        if ($espece_determinante["AN_I_OBS"] != ""):
                            echo $espece_determinante["AN_I_OBS"];
                        else: echo "?";
                        endif;
                        echo " - ";
                        if ($espece_determinante["AN_S_OBS"] != ""):
                            echo $espece_determinante["AN_S_OBS"];
                        else: echo "?";
                        endif;
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>
        <strong>Aucune esp&egrave;ce d&eacute;terminante</strong> 
        n'est recens&eacute;e dans cette ZNIEFF.
    </p>
<?php endif; ?>
<?php
/**
 *  Sources Espèces déterminantes
 */
$sources_especes = getSourcesEspeces($id_regional, "D");
?>
<?php if (count($sources_especes) > 0): ?>
    <h3 class="spip">Sources&nbsp;:</h3>
    <?php endif ?>
<ul class="spip">
    <?php foreach ($sources_especes as $source_espece): ?>
        <li><?= $source_espece["LB_SOURCE"] ?></li>
<?php endforeach; ?>
</ul>
<?php include ("squelettes/haut-page.html"); ?>
<h3 class="spip">Esp&egrave;ces confidentielles&nbsp;:</h3>
<?php $especes_confidentielles = getEspecesByIdRegionalByFgEsp($id_regional,"C"); ?>
<?php if (count($especes_confidentielles) > 0): ?>
    <p>
        <strong><?= count($especes_confidentielles) ?> esp&egrave;ce(s) confidentielle(s)</strong> 
        sont recens&eacute;es dans cette ZNIEFF.
    </p>
<?php else: ?>
    <p>
        <strong>Aucune esp&egrave;ce confidentielle</strong> 
        n'est recens&eacute;e dans cette ZNIEFF.
    </p>
<?php endif; ?>
<?php include ("squelettes/haut-page.html"); ?>
<h3 class="spip">Autres esp&egrave;ces&nbsp;:</h3>
<?php include ("squelettes/nomenclature.html"); ?>
<?php
$autres_especes = getEspecesByIdRegionalByFgEsp($id_regional, "A");
?>
<p>
    <strong><?=count($autres_especes)?> autre(s) esp&egrave;ce(s)</strong> 
    recens&eacute;e(s) dans cette ZNIEFF.
</p><br />
<?php if(count($autres_especes) > 0): ?>
    <table class="encadre" width="99%">
        <tr>
            <th>Taxon</th>
            <th>Statut</th>
            <th>Abondance</th>
            <th>Effectif<br />Min.-Max.</th>
            <th>P&eacute;riode d'obs.<br />D&eacute;but-Fin</th>
        </tr>
        <?php
        foreach ($autres_especes as $autre_espece):
            /**
             *  Affichage de l'embranchement, de la classe ou de l'ordre
             */
            $ms_arbo_pere = $autre_espece["MS_ARBO_PERE"];
            $embranchements = getEmbranchementsEspece($ms_arbo_pere);

            foreach ($embranchements as $embranchement):

                /**
                 *  Affichage du sous-règne, de l'embranchement, 
                 *  du super embranchement, de la classe ou de la super classe
                 */
                $ms_arbo_pere = $embranchement["MS_ARBO_PERE"];
                $sous_regnes = getSousRegnes($ms_arbo_pere);

                /**
                 *  Affichage du nom vernaculaire de l'espèce
                 */
                /*$CD_ESP = $autre_espece["CD_ESP"];
                $especes_flore = getNomVernaculaireFlore($CD_ESP);

                $CD_ESP = $autre_espece["CD_ESP"];
                $especes_faune = getNomVernaculaireFaune($CD_ESP);*/
                ?>
                <tr>
                    <td class="left" bgcolor="<?= switchcolor() ?>">
                        <?php foreach ($sous_regnes as $sous_regne): ?>
                            <?php if ($sous_regne["LB_ESP"] != ""): ?>
                                <strong><?= $sous_regne["LB_ESP"] ?> &raquo; </strong>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <strong><?= $embranchement["LB_ESP"] ?> &raquo; </strong><br />
                        <?php
                        /**
                         *  Affichage du nom latin de l'espèce
                         */
                        if (ereg("^(1)", $autre_espece["MS_ARBO_PERE"])):
                            echo "<em>" . $autre_espece["LB_ESP"] . "</em> ";
                        elseif (ereg("^(2)", $autre_espece["MS_ARBO_PERE"])):
                            echo "<em>" . $autre_espece["LB_ESP"] . "</em> ";
                        elseif (ereg("^(3)", $autre_espece["MS_ARBO_PERE"])):
                            echo "<em>" . $autre_espece["LB_ESP"] . "</em> ";
                        elseif (ereg("^(4)", $autre_espece["MS_ARBO_PERE"])):
                            echo "<em>" . $autre_espece["LB_ESP"] . "</em> ";
                        elseif (ereg("^(5)", $autre_espece["MS_ARBO_PERE"])):
                            echo "<em>" . $autre_espece["LB_ESP"] . "</em> ";
                        endif;
                        ?>
                        <?php
                        /**
                         * Affichage du nom vernaculaire de l'espèce
                         */
                        /*if (ereg("^(4)", $autre_espece["MS_ARBO_PERE"])):
                            foreach ($especes_faune as $espece_faune):
                                if($espece_faune["NOM_VERNAC"] != ""):
                                    echo "(" . $espece_faune["NOM_VERNAC"] . ")";
                                endif;
                            endforeach;
                        else:
                            foreach ($especes_flore as $espece_flore):
                                if($espece_flore["NOM_VERNAC"] != ""):
                                    echo "(" . $espece_flore["NOM_VERNAC"] . ")";
                                endif;
                            endforeach;
                        endif;*/
                        ?>
                    </td>
                    <td class="align"><?= $autre_espece["CD_STATUT"] ?>
                    </td>
                    <td class="align"><?= $autre_espece["CD_ABOND"] ?></td>
                    <td class="align">
                        <?php
                        if ($autre_espece["NB_I_ABOND"] != "0"):
                            echo $autre_espece["NB_I_ABOND"];
                        else: echo "?";
                        endif;
                        echo " - ";
                        if ($autre_espece["NB_S_ABOND"] != "0"):
                            echo $autre_espece["NB_S_ABOND"];
                        else: echo "?";
                        endif;
                        ?>
                    </td>
                    <td class="align">
                        <?php
                        if ($autre_espece["AN_I_OBS"] != ""):
                            echo $autre_espece["AN_I_OBS"];
                        else: echo "?";
                        endif;
                        echo " - ";
                        if ($autre_espece["AN_S_OBS"] != ""):
                            echo $autre_espece["AN_S_OBS"];
                        else: echo "?";
                        endif;
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>
        <strong>Aucune autre esp&egrave;ce</strong> 
        n'est recens&eacute;e dans cette ZNIEFF.
    </p>
<?php endif; ?>
<?php
/**
 *  Sources Autres Espèces
 */
$sources_especes = getSourcesEspeces($id_regional, "A");
?>
    <?php if (count($sources_especes) > 0): ?>
    <h3 class="spip">Sources&nbsp;:</h3>
    <?php endif ?>
<ul class="spip">
<?php foreach ($sources_especes as $source_espece): ?>
        <li><?= $source_espece["LB_SOURCE"] ?></li>
<?php endforeach; ?>
</ul>