<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Dta.class.php';
require_once 'classes/Docob.class.php';
require_once 'classes/Pnr.class.php';
require_once 'classes/Rnn.class.php';
require_once 'classes/Rnr.class.php';
require_once 'classes/SiteClasseInscrit.class.php';
require_once 'classes/StationQualite.class.php';
require_once 'classes/Unesco.class.php';
require_once 'classes/Zonage.class.php';
require_once 'classes/Znieff2G.class.php';
require_once 'classes/Zsc.class.php';

/**
 * Ce fichier sert à afficher les ressources disponibles pour un zonage.
 * @var $id_type Identifiant du type de zonage
 * @var $id_regional Identifiant régional du zonage
 */
$id_type = $_REQUEST["id_type"];
$id_regional = $_REQUEST["id_regional"];
$zonage = new Zonage();
$zonage->getTypeZonageByIdType($id_type);
?>	
<ul>
    <?php if (!empty($zonage->map)): ?>
    <!-- 1. Lien vers un zoom dans la carte CARMEN -->
    <li>
        <a class="document" href="
            <?php 
            echo URL_CARMEN.$zonage->map.".map&object=".$zonage->path.";";
            if ($id_type == "18"):
               echo "id_bien";
            elseif (($id_type == "12") OR ($id_type == "15")):
               echo "id_national";
            else:
               echo "id_regional";
            endif;
            echo ";" . $id_regional
            ?>" target="_blank">
            Consulter la carte interactive du zonage sur CARMEN
        </a>
    </li>
    <?php endif; ?>
        <?php if (!empty($zonage->url_presentation)): ?>
    <!-- 1 bis. Lien vers la présentation du zonage sur le site Internet 
    de la DREAL -->
    <li>
        <a class="document" href="
            <?= $zonage->url_presentation ?>" target="_blank">
            Consulter la présentation du zonage sur le site Internet de la DREAL
        </a>
    </li>
    <?php endif; ?>
    <!-- 2. Fiches descriptives et liens -->
    <li>
        <?php
        switch ($id_type):
            /**
             *  2.1 Cas générique pour les fiches descriptives
             */
            case 1: case 2: case 3: case 4: case 7: case 8: case 9: case 12: case 13: case 14: case 15:case 16: case 29:
                ?>
        <a class="link" 
           href="spip.php?page=fiche&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">Consulter la fiche descriptive</a>
                <?php
                break;
           /**
             *  2.1 bis Affichage uniquement des communes concernées si la
             *  fiche est sur le site de l'INPN ou autre 
             */
            case 34: case 35: case 36: case 37:
                ?>
        <a class="link" 
           href="spip.php?page=fiche&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
            Afficher les communes concern&eacute;es
        </a>
                <?php
                break;
            /**
             * 2.2 ZNIEFF de deuxième génération	
             */
            case 10: case 11:
                ?>
        <a class="link"       
           href="spip.php?page=fiche&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
            Consulter la fiche descriptive (2&egrave;me g&eacute;n&eacute;ration)
        </a>
               <?php
               break;
           /**
            *  2.3 Natura 2000 : Fiches descriptives des ZPS, ZSC, SIC et PSIC
            */
           case 5: case 6: case 21: case 30:
               /**
                 *  2.3.1 Fiches des sites en Pays de la Loire	
                 */
               if (ereg("^FR52", $id_regional)): ?>
        <a class="link" 
           href="spip.php?page=fiche&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
            Consulter la fiche descriptive
        </a>
               <?php
                /**
                 * 2.3.2 Lien vers des sites extérieurs pour les sites 
                 * relevant d'autres DREAL
                 */
               else:
                   $zonage_data = new Zonage();
                   $zonage_data->getZonageDataById($id_type, $id_regional);

                   if (($zonage_data->region == '0') 
                           && (isset($zonage_data->url_fiche))):
                ?>
        <a class="document" href="<?= $zonage_data->url_fiche ?>" 
           target="_blank">
            Consulter la fiche descriptive sur le site de la DREAL 
                        <?= $zonage_data->dreal ?>
        </a>
                    <?php
                    endif;
                endif;
                break;
            /**
             * 2.4 Fiches descriptives des projets de PSIC
             */
            case 20:
                /**
                 * 2.4.1 Fiches des projets de PSIC en PdL au format PDF
                 */
                if (ereg("^FR52", $id_regional)): ?>
        <a class="document" 
           href="data/fiches/ppsic/<?=$id_regional?>.pdf">
            T&eacute;l&eacute;charger la fiche descriptive
        </a>
        <span class="docformat">
            (PDF,&nbsp;<?= @convertFilesize("data/fiches/ppsic/$id_regional.pdf") ?>.")
        </span>
            <?php
                /**
                 * 2.4.2 Lien vers des sites extérieurs pour les sites 
                 * relevant d'autres DREAL
                 */
                else:
                    $zonage_data = new Zonage();
                    $zonage_data->getZonageDataById($id_type,$id_regional);
                    ?>
        <a class="document" 
           href="<?=$zonage_data->url_fiche?>" 
           target="_blank">
            Consulter la fiche descriptive sur le site de la DREAL 
                            <?=$zonage_data->dreal?>
        </a><br />
            <?php
                endif;
                break;
           
            /**
             * 2.6 Liens vers le site du Conseil Régional pour les RNR
             */
            case 33:
                $rnr = new Rnr();
                $rnr->getRnrByIdRegional($id_regional);
                ?>
        <a class="document" href="<?=$rnr->url_site?>" target="_blank">
            Consulter la fiche de pr&eacute;sentation de la r&eacute;serve 
            sur le site du Conseil R&eacute;gional
        </a>          
            <?php
                break;

            /**
             * 2.8 Rubrique DTA sur le site de la Préfecture de région
             */
            case 17:
                $dta = new Dta();
                $dta->getDtaByIdRegional($id_regional);
                ?>
        <a class="document" href="<?= $dta->url_site ?>" target="_blank">
            Consulter la rubrique DTA sur le site de la Pr&eacute;fecture 
            de Loire-Atlantique
        </a> 
                <?php
                break;
    
            /**
             * 2.9 Lien vers le site de l'UNESCO
             */
            case 18:
                $unesco = new Unesco();
                $unesco->getUnescoByIdRegional($id_regional);
                ?>
        <a class="document" href="<?= $unesco->url_site ?>" target="_blank">
            Consulter le site de l'UNESCO
        </a>
                <?php
                break;
            /**
             * 3.0 Lien vers les fiches Résultats par campagne des stations
             * Qualité des eaux (RNB + RCS)
             */
            case 28: case 38:
                ?>
        <a class="document" 
           href="spip.php?page=fiche_station_qualite&amp;id_regional=<?=$id_regional?>">
            Consulter la fiche de résultats par campagne
        </a>
                <?php
                break;
        endswitch; ?>
</li>
<!-- 2 bis. Compléments -->
<?php
switch ($id_type):
     /**
      * Liens vers l'INPN et les sites des PNR
      */
    case 7:
        $pnr = new Pnr();
        $pnr->getPnrByIdRegional($id_regional);
?>
<li>
    <a class="document" 
       href="<?=URL_INPN_ESPACE_PROTEGE?><?=$pnr->id_regional?>" 
       target="_blank">Consulter la fiche descriptive sur le site de l'INPN</a>
</li>
<li>
    <a class="document" 
       href="<?=$pnr->url_site?>" 
       target="_blank">Consulter le site du PNR</a>
</li>
        <?php
        break;
    /**
     *  Fiche PDF et lien INPN pour Ramsar
     */    
    case 15:
        ?>
        <li>
            <a class="document" 
               href="data/fiches/ramsar/<?=$id_regional?>.pdf">
                T&eacute;l&eacute;charger la fiche descriptive</a>
            <span class="docformat"> 
                (PDF,&nbsp;<?=@convertFilesize("data/fiches/ramsar/$id_regional.pdf")?>)
            </span>
        </li>
        <li>
            <a class="document" 
               href="<?= URL_INPN_ESPACE_PROTEGE ?><?= $id_regional ?>" 
               target="_blank">
                Consulter la fiche descriptive sur le site de l'INPN
            </a>
        </li>
        <?php
        break;
    /**
     * Fiche PDF pour les sites INPG préselectionnés et proposés
     */
    case 36: case 37:
        if (file_exists("data/fiches/$zonage->path/$id_regional.pdf")):
        ?>
        <li>
            <a class="document" 
               href="data/fiches/<?=$zonage->path?>/<?=$id_regional?>.pdf">
                T&eacute;l&eacute;charger la fiche descriptive</a>
            <span class="docformat"> 
                (PDF,&nbsp;<?= @convertFilesize("data/fiches/$zonage->path/$id_regional.pdf") ?>)
            </span>
        </li>
        <?php
        endif;
        break;
endswitch;
?>
<!-- 3. Formulaires standards de données pour Natura 2000 -->
<li>
    <?php
    switch ($id_type):
        case 5: case 6: case 30:
            ?>
            <a class="document" 
               href="<?= URL_INPN_NATURA_2000 ?><?=$id_regional?>" 
               target="_blank">
                Consulter le Formulaire Standard des Donn&eacute;es sur le site de l'INPN
            </a>
            <?php
            break;

        case 21:
            if (ereg("^FR25", $id_regional)):
                ?>
                <a class="document" 
                   href="<?= URL_INPN_NATURA_2000 ?><?=$id_regional?>" 
                   target="_blank">
                    Consulter le Formulaire Standard des Donn&eacute;es sur le site de l'INPN
                </a>
                <?php
            endif;
            break;
    endswitch;
    ?>
</li>
<!-- 4. Fiches ZNIEFF de l'inventaire permanent sur le site de l'INPN -->
<li>
<?php
switch ($id_type):
    case 34: case 35:
        $znieff = new Znieff2G();
        $znieff->getZnieff2GByIdRegional($id_regional);
        ?>
            <a class="document" 
               href="<?=URL_INPN_ZNIEFF?><?=$znieff->id_national?>" 
               target="_blank">
                Consulter la fiche ZNIEFF actualis&eacute;e sur le site de l'INPN
            </a>
            <?php
            break;
    endswitch;
    ?>
</li>
<!-- 5. Listes d'espèces pour Natura 2000 et ZNIEFF -->
<li>
    <?php
    switch ($id_type):
        case 5: case 6: case 21: case 30:
            if (ereg("^FR52", $id_regional)):
                ?>
                <a class="link" 
                   href="spip.php?page=liste_especes&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
                    Consulter la liste d'esp&egrave;ces
                </a>
                <?php
            endif;
            break;
        case 10: case 11:
            ?>
            <a class="link" 
               href="spip.php?page=liste_especes&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
                Consulter la liste d'esp&egrave;ces
            </a>
            <?php
            break;
    endswitch;
    ?>
</li>
<!-- 6. Listes d'habitats pour Natura 2000 -->
<li>
    <?php
    switch ($id_type):
        case 6: case 21: case 30:
            if (ereg("^FR52", $id_regional)):
                ?>
                <a class="link" 
                   href="spip.php?page=liste_habitats&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
                    Consulter la liste d'habitats
                </a>
                <?php
            endif;
            break;
    endswitch;
    ?>
</li>
<!-- 7. Décrets -->
<li>
<?php
switch ($id_type):
    case 2:
        $rnn = new Rnn();
        $rnn->getRnnByIdRegional($id_regional);
        ?>
            <a class="document" href="<?=$rnn->url_decret?>" target="_blank">
                Consulter le texte du d&eacute;cret sur L&eacute;gifrance
            </a>	
            <?php
            break;
    case 13:
        $site_classe_inscrit = new SiteClasseInscrit();
        $site_classe_inscrit->getSiteClasseInscritDataByIdRegional($id_regional);
        if (file_exists("data/docs/decrets/" . $zonage->path . "/" . $site_classe_inscrit->id_dpt . $site_classe_inscrit->type_site . $site_classe_inscrit->id_site . $site_classe_inscrit->id_entite . ".pdf")):
            ?>
            <a class="document" 
               href="data/docs/decrets/<?=$zonage->path?>/<?=$site_classe_inscrit->id_dpt?><?=$site_classe_inscrit->type_site?><?=$site_classe_inscrit->id_site?><?=$site_classe_inscrit->id_entite?>.pdf" 
               target="_blank">
                T&eacute;l&eacute;charger le d&eacute;cret
            </a>
            <span class="docformat">
                (PDF,&nbsp;";<?= @convertFilesize("data/docs/decrets/" . $zonage->path . "/" . $site_classe_inscrit->id_dpt . $site_classe_inscrit->type_site . $site_classe_inscrit->id_site . $site_classe_inscrit->id_entite . ".pdf") ?>)
            </span>
        <?php
        elseif (($site_classe_inscrit->url_texte != "") 
                && ($site_classe_inscrit->texte_protection == "Décret")):
        ?>
            <a class="document" 
               href="<?= $site_classe_inscrit->url_texte ?>" 
               target="_blank">
                 Consulter le texte du d&eacute;cret sur L&eacute;gifrance
            </a>
            <?php
        endif;
        break;
endswitch;
?>
</li>
<!-- 8. Arrêtés -->
<li>
<?php if (file_exists("data/docs/arretes/" . $zonage->path . "/" . $id_regional . ".pdf")): ?>
        <a class="document" 
           href="data/docs/arretes/<?= $zonage->path ?>/<?= $id_regional ?>.pdf" 
           target="_blank">
            T&eacute;l&eacute;charger l'arr&ecirc;t&eacute;
        </a>
        <span class="docformat">
            (PDF,&nbsp;<?= @convertFilesize("data/docs/arretes/" . $zonage->path . "/" . $id_regional . ".pdf") ?>)
        </span>
        <?php
    elseif ($id_type == '13'):
        $site_classe_inscrit = new SiteClasseInscrit();
        $site_classe_inscrit->getSiteClasseInscritDataByIdRegional($id_regional);

        if (file_exists("data/docs/arretes/" . $zonage->path . "/" . $site_classe_inscrit->id_dpt . $site_classe_inscrit->type_site . $site_classe_inscrit->id_site . $site_classe_inscrit->id_entite . ".pdf")):
            ?> 
            <a class="document" 
               href="data/docs/arretes/<?= $zonage->path ?>/<?= $site_classe_inscrit->id_dpt ?><?= $site_classe_inscrit->type_site ?><?= $site_classe_inscrit->id_site ?><?= $site_classe_inscrit->id_entite ?>.pdf" target="_blank">
                T&eacute;l&eacute;charger l'arr&ecirc;t&eacute;
            </a>
            <span class="docformat">
                (PDF,&nbsp;";<?= @convertFilesize("data/docs/arretes/" . $zonage->path . "/" . $site_classe_inscrit->id_dpt . $site_classe_inscrit->type_site . $site_classe_inscrit->id_site . $site_classe_inscrit->id_entite . ".pdf") ?>)
            </span>
        <?php elseif (($site_classe_inscrit->url_texte != "") 
                && ($site_classe_inscrit->texte_protection == "Arrêté")): ?>	
            <a class="document" 
               href="<?= $site_classe_inscrit->url_texte ?>" 
               target="_blank">
                Consulter le texte de l'arr&ecirc;&eacute; sur L&eacute;gifrance
            </a>
            <?php
        endif;
    endif;
    ?>
</li>
<!-- 9. Documents d'objectifs pour Natura 2000 sur le portail SIDE-->
<?php
switch ($id_type):
        case 5: case 6: case 21: case 30:
            
$docob = new Docob();
$docob->getDocobByIdRegional($id_regional);
?>
<li>
    <?php if ($docob->id_side !== "0"): ?>
        <a class="document" href="<?= URL_SIDE ?><?= $docob->id_side ?>" 
           target="_blank">
            Consulter la fiche du DOCOB sur le portail documentaire 
            <abbr 
                title="Syst&egrave;me d'Information Documentaire de l'Environnement">
                SIDE
            </abbr>
        </a>
    <?php endif; ?>
</li>
<!-- 10. Arrêtés pour Natura 2000 sur le site Internet de la DREAL-->
<li>
    <?php if ($docob->id_article !== "0"): ?>
        <a class="document" href="<?= URL_DREAL ?><?= $docob->id_article ?>" 
           target="_blank">
            Consulter les arr&ecirc;t&eacute;s sur le site Internet de la DREAL 
        </a>
    <?php endif; ?>
</li>
<?php
break;
endswitch;
?>
<!-- 11. Plans de gestion pour les RNN -->
<li>
    <?php if (file_exists("data/docs/plans_gestion/" . $zonage->path . "/" . $id_regional . ".pdf")): ?>
        <a class="document" 
           href="data/docs/plans_gestion/<?= $zonage->path ?>/<?= $id_regional ?>.pdf" 
           target="_blank">
            T&eacute;l&eacute;charger le plan de gestion
        </a>
        <span class="docformat">
            (PDF,&nbsp;<?= @convertFilesize("data/docs/plans_gestion/" . $zonage->path . "/" . $id_regional . ".pdf") ?>)
        </span>
<?php endif; ?>
</li>
<!-- 12. Cartes PDF et rapports de présentation pour les sites classés -->
<?php if ($id_type == '13'): ?>
    <?php if (file_exists("data/cartes/" . $zonage->path . "/" . $id_regional . ".pdf")): ?>
    <li>
        <a class="document" 
           href="data/cartes/<?= $zonage->path ?>/<?= $id_regional ?>.pdf" 
           target="_blank">
            T&eacute;l&eacute;charger la carte de localisation
        </a>
        <span class="docformat">
            (PDF,&nbsp;<?= @convertFilesize("data/cartes/" . $zonage->path . "/" . $id_regional . ".pdf") ?>)
        </span>
    </li>
    <?php endif; ?>
    <?php 
    $site_classe_inscrit = new SiteClasseInscrit();
    $site_classe_inscrit->getSiteClasseInscritDataByIdRegional($id_regional);
    ?>
    <?php if (!empty($site_classe_inscrit->id_side)): ?>
    <li>
        <a class="document" 
           href="<?=URL_SIDE?><?=$site_classe_inscrit->id_side?>" 
           target="_blank">
            Consulter le rapport de pr&eacute;sentation sur le portail 
            <abbr 
                title="Syst&egrave;me d'Information Documentaire de l'Environnement">
                SIDE
            </abbr>
        </a>
    </li>
    <?php endif; ?>
<?php endif; ?>
<!-- 13. Photographies -->
<li>
    <?php
    switch ($id_type):
        /**
         * 13.1 Photographies pour les ZNIEFF
         */
        case 10: case 11:
            $znieff_photos = getZnieff2GPhotosByIdRegional($id_regional, $id_type);
            if (count($znieff_photos) > 0):
                ?>
                <a class="link" 
                   href="spip.php?page=photos&amp;id_type=<?= $id_type ?>&amp;id_regional=<?= $id_regional ?>">
                    Afficher les photographies
                </a>
                <?php
            endif;
            break;
        /**
         *  13.2 Photographies pour les RNN 
         */
        case 2:
            $rnn_photos = getRnnPhotosByIdRegional($id_regional);
            if (count($rnn_photos) > 0):
                ?>
                <a class="link" 
                   href="spip.php?page=photos&amp;id_type=<?= $id_type ?>&amp;id_regional=<?= $id_regional ?>">
                    Afficher les photographies
                </a>
            <?php
        endif;
        break;
    /**
     *  13.3 Photographies pour les sites classés et inscrits
     */
    case 13:
        $site_classe_inscrit_photos = getSiteClasseInscritPhotosByIdRegional($id_regional, $id_type);
        if (count($site_classe_inscrit_photos) > 0):
            ?>
                <a class="link" 
                   href="spip.php?page=photos&amp;id_type=<?= $id_type ?>&amp;id_regional=<?= $id_regional ?>">
                    Afficher les photographies
                </a>
            <?php
        endif;
        break;
endswitch;
?>
</li>
</ul>