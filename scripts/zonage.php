<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/AvisAe.class.php';
require_once 'classes/Basias.class.php';
require_once 'classes/Basol.class.php';
require_once 'classes/DecisionAe.class.php';
require_once 'classes/Dta.class.php';
require_once 'classes/Docob.class.php';
require_once 'classes/IcpeDreal.class.php';
require_once 'classes/Pnr.class.php';
require_once 'classes/Pprm.class.php';
require_once 'classes/Pprt.class.php';
require_once 'classes/Rnn.class.php';
require_once 'classes/Rnr.class.php';
require_once 'classes/Sage.class.php';
require_once 'classes/Scot.class.php';
require_once 'classes/SiteClasseInscrit.class.php';
require_once 'classes/StationQualite.class.php';
require_once 'classes/Unesco.class.php';
require_once 'classes/Zonage.class.php';
require_once 'classes/ZnieffIp.class.php';
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
    <!-- 1. Liens vers des cartes interactives -->
    <?php if (!empty($zonage->map_carmen)): ?>
    <!-- 1.1 Lien vers un zoom dans une carte CARMEN -->
    <li>
        <a class="document" 
           href="
            <?php 
            echo URL_CARMEN.$zonage->map_carmen.".map&object=".$zonage->path.";".$zonage->primary_key.";" . $id_regional?>" 
            target="_blank">
            Consulter la carte interactive du zonage sur CARMEN
        </a>
    </li>
    <?php endif; ?>
    <?php if (!empty($zonage->map_sigloire)): ?>
    <!-- 1.2 Lien vers un zoom dans une carte SIGLOIRE -->
    <li>
        <a class="document" 
           href="
            <?php 
            echo URL_SIGLOIRE.$zonage->map_sigloire.".map&object=".$zonage->path.";".$zonage->primary_key.";".$id_regional;
            if(!empty($zonage->layer)):
                echo "&layer=".$zonage->layer;
            endif; ?>"
            target="_blank">
            Consulter la carte interactive du zonage sur SIGLOIRE
        </a>
    </li>    
    <?php endif; ?>
    <!-- 2. Présentation du zonage sur un site Internet DREAL ou Ministère -->
    <?php if (!empty($zonage->url_presentation)): ?>
    <li>
        <a class="document" 
           href="<?= $zonage->url_presentation ?>" target="_blank">
            Consulter la rubrique sur le site Internet de la DREAL ou du Ministère</a>
    </li>
    <?php endif; ?>
    <!-- 3. Fiches descriptives génériques et listes de communes -->
    <li>
        <!--  3.1 Affichage d'une fiche descriptive  -->
        <?php if($zonage->fact_sheet=="1"): ?>
            <a class="link" 
                href="spip.php?page=fiche&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
                Consulter la fiche descriptive
            </a>
        <!--  3.2 Affichage de la liste des communes concernées -->
        <?php elseif($zonage->fact_sheet=="2"): ?>
            <a class="link" 
                href="spip.php?page=fiche&amp;id_type=<?=$id_type?>&amp;id_regional=<?=$id_regional?>">
                Afficher la ou les commune(s) concern&eacute;e(s)
            </a>
        <?php endif; ?>
    </li>
    <!-- 4. Fiches descriptives spécifiques -->
    <li>
        <?php
        switch ($id_type):
            /**
             * 4.1 Fiches descriptives des projets de PSIC
             */
            case 20:
                /**
                 * 4.1.1 Fiches des projets de PSIC en PdL au format PDF
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
                 * 4.1.2 Lien vers des sites extérieurs pour les sites 
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
             * 4.2 Liens vers le site du Conseil Régional pour les RNR
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
             * 4.3 Lien vers les fiches Résultats par campagne des stations
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
            /**
             * 4.4 Lien vers SUDOCUH pour les SCoT
             */
            case 63:
                $scot = new Scot();
                $scot->getScotByIdRegional($id_regional);
                ?>
        <a class="document" 
           href="<?= URL_SUDOCUH ?><?=$scot->ID_SCHEMA?>">
            Consulter la fiche du SCoT sur l'application SUDOCUH 
        </a>
                <?php
                break;
            /**
             * 4.5 Lien vers Gest'Eau pour les SAGE
             */            
            case 16:
                $sage = new Sage();
                $sage->getSageByIdRegional($id_regional);
                ?>
        <a class="document" 
           href="<?= URL_GESTEAU ?><?=$sage->url_gesteau?>">
            Consulter la fiche du SAGE sur Gest'Eau
        </a>
                <?php
                break;

            /**
             * 4.6 Lien vers le site web du PPRM
             */            
            case 65:
                $pprm = new Pprm();
                $pprm->getPprmByIdRegional($id_regional);
                ?>
        <a class="document" 
           href="<?=$pprm->SITE_WEB?>">
            Consulter la présentation du PPRM sur le site de la Préfecture
        </a>
                <?php
                break;    
            
        endswitch; ?>
</li>
<!-- 5. Liens vers un site générique -->
<li>
<?php
    switch ($id_type):

            /**
             * 5.1 Rubrique DTA sur le site de la Préfecture de région
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
             * 5.2 Lien vers le site de l'UNESCO
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
        endswitch; ?>
</li>
<!-- 6. Compléments -->
<!-- 6.1 Liens vers l'INPN et les sites des PNR -->
<?php
    if($id_type==7):
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
<?php endif; ?>
<?php
switch ($id_type):
    /**
     *  6.2 Fiche PDF et lien INPN pour Ramsar
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
     * 6.3 Fiche PDF pour les sites INPG préselectionnés et proposés
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
     /**
      * 6.4 Liens pour les Plans de conservation
      */
     case 41:
     ?>
        <li>
            <a class="document"
               href="http://www.cbnbrest.fr/site/html/regions/strategie_conservation.html"
               target="_blank">
                Consulter la strat&eacute;gie de conservation sur le site 
                du <abbr  title="Conservatoire Botanique National de Brest">CBNB</abbr></a>
        </li>
        <li>
            <a class="document" 
               href="http://www.cbnbrest.fr/site/html/regions/strategie_conservation_pdl.html#pla" 
               target="_blank">
                Consulter les plans de conservations sur le site 
                du <abbr  title="Conservatoire Botanique National de Brest">CBNB</abbr></a>
        </li>
        <?php
        break;
      /**
       * 6.5 Liens pour les Plans nationaux d'action
       */
      case 42:
            ?>
        <li>
            <a class="document"
               href="http://www.developpement-durable.gouv.fr/-Especes-menacees-les-plans-.html" 
               target="_blank">
                Consulter la rubrique de pr&eacute;sentation des plans 
                nationaux d'action sur le site du Minist&egrave;re</a>
        </li>
        <li>
            <a class="document"
               href="http://www.developpement-durable.gouv.fr/Plan-national-d-actions-2012-2016.html" 
               target="_blank">
                Consulter les plans nationaux d'action sur le site 
                du Minist&egrave;re</a>
        </li>
        <?php
        break;
       /**
        * 6.6 Liens pour les Plans de conservation locaux
       */
       case 43:
            if($id_regional == "82715"):
            ?>
        <li>
            <a class="document"
               href="http://www.nantesmetropole.fr/html/biodiversite/" 
               target="_blank">
                Consulter la rubrique de pr&eacute;sentation sur le site de Nantes M&eacute;tropole</a>
        </li>
        <?php
            endif;
        break;
        /**
         * 6.7 Liens pour les PAC SUP Canalisations
         */
        case 45:
            ?>
            <li><a class="document"
               href="data/docs/pac/canalisations/Lettre_transport_canalisation001.pdf" 
               target="_blank">
                Télécharger le courrier du Pr&eacute;fet</a>
                <span class="docformat"> 
                (PDF,&nbsp;<?= @convertFilesize("data/docs/pac/canalisations/Lettre_transport_canalisation001.pdf") ?>)
            </span>
            </li>
            <li><a class="document"
               href="data/docs/pac/canalisations/annexes/<?=$id_regional?>_a001.pdf" 
               target="_blank">
                T&eacute;l&eacute;charger l'annexe</a>
                <span class="docformat"> 
                (PDF,&nbsp;<?= @convertFilesize("data/docs/pac/canalisations/annexes/".$id_regional."_a001.pdf") ?>)
            </span>
            </li>
            <li><a class="document"
               href="data/docs/pac/canalisations/cartes/<?=$id_regional?>_c001.pdf"
               target="_blank">
                T&eacute;l&eacute;charger la carte</a>
                <span class="docformat"> 
                (PDF,&nbsp;<?= @convertFilesize("data/docs/pac/canalisations/cartes/".$id_regional."_c001.pdf") ?>)
            </span>
            </li>
            <?php if(file_exists("data/docs/pac/canalisations/cartes/".$id_regional."_c002.pdf")): ?>
            <li><a class="document"
               href="data/docs/pac/canalisations/cartes/<?=$id_regional?>_c002.pdf"
               target="_blank">
                T&eacute;l&eacute;charger la carte n°2</a>
                <span class="docformat"> 
                (PDF,&nbsp;<?= @convertFilesize("data/docs/pac/canalisations/cartes/".$id_regional."_c002.pdf") ?>)
            </span>
            </li>
            <?php endif; ?>
            <?php if(file_exists("data/docs/pac/canalisations/cartes/".$id_regional."_c003.pdf")): ?>            
            <li><a class="document"
               href="data/docs/pac/canalisations/cartes/<?=$id_regional?>_c003.pdf"
               target="_blank">
                T&eacute;l&eacute;charger la carte n°3</a>
                <span class="docformat"> 
                (PDF,&nbsp;<?= @convertFilesize("data/docs/pac/canalisations/cartes/".$id_regional."_c003.pdf") ?>)
            </span>
            </li>
            <?php endif; ?>            
        <?php
            break;
            /**
             * 6.8 Liens vers les bases nationales pour les sites BASOL et BASIAS
             */
            case 47:
                $basol = new Basol();
                $basol->getBasolByIdRegional($id_regional);
                ?>
            <li>
                <a class="document" href="<?=$basol->url_basol?>" target="_blank">
                Consulter la fiche du site sur BASOL
                </a>
            </li>
                <?php
                break;   
            case 48:
                $basias = new Basias();
                $basias->getBasiasByIdRegional($id_regional);
                ?>
            <li>
                <a class="document" href="<?=$basias->url_basias?>" target="_blank">
                    Consulter la fiche du site sur BASIAS
                </a>
            </li>
        <?php
            break;
            /**
             * 6.9.1 Lien vers le site de la DREAL pour les PPRT
             */
            case 54:
                $pprt = new Pprt();
                $pprt->getPprtByIdRegional($id_regional);
                ?>
            <li>
                <a class="document" href="<?=$pprt->url?>" target="blank">
                    Consulter l'article du PPRT sur le site Internet de la DREAL
                </a>
            </li>    
        <?php
            break;
            /**
             * 6.9.2 Lien vers GARANCE et le site Internet DREAL pour 
             * les avis de l'AE
             */
            case 26:
                $avis_ae = new AvisAe();
                $avis_ae->getAvisAeByIdRegional($id_regional);
                ?>
            <?php if($_SERVER["HTTP_HOST"] == "base-communale.dreal-pays-de-la-loire.i2"): ?>
            <?php if(!empty($avis_ae->url_garance)): ?>
                <li>
                    <a class="document" href="<?=$avis_ae->url_garance?>" 
                       target="blank">
                        Consulter la fiche du dossier d'opération sur GARANCE
                    </a>
                </li>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(!empty($avis_ae->url_resume)): ?>
            <li>
                <a class="document" href="<?=$avis_ae->url_resume?>" 
                   target="blank">
                    Consulter le résumé non-technique
                </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($avis_ae->url_lien_pub)): ?>
            <li>
                <a class="document" href="<?=$avis_ae->url_lien_pub?>" 
                   target="blank">
                    Consulter l'avis publié sur le site Internet de la DREAL
                </a>
            </li>
            <?php endif; ?>
        <?php
            break;
            /**
             * 6.9.3 Lien vers GARANCE et le site Internet DREAL pour 
             * les décisions au cas par cas
             */
            case 64:
                $decision_ae = new DecisionAe();
                $decision_ae->getDecisionAeByIdRegional($id_regional);
                ?>
            <?php if($_SERVER["HTTP_HOST"] == "base-communale.dreal-pays-de-la-loire.i2"): ?>
            <?php if(!empty($decision_ae->url_garance)): ?>
                <li>
                    <a class="document" href="<?=$decision_ae->url_garance?>" 
                       target="blank">
                        Consulter la fiche du dossier d'opération sur GARANCE
                    </a>
                </li>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(!empty($decision_ae->url_formulaire)): ?>
            <li>
                <a class="document" href="<?=$decision_ae->url_formulaire?>" 
                   target="blank">
                    Consulter le formulaire sur le site Internet de la DREAL
                </a>
            </li>
            <?php endif; ?>
        <?php
            break;
            /**
             * 6.9.4 Lien vers la Base des installations classées pour les ICPE
             * A,E,S de la DREAL
             */
            case 71:
                $icpe_dreal = new IcpeDreal();
                $icpe_dreal->getIcpeDrealByIdRegional($id_regional);
                ?>
            <li>
                <a class="document" href="<?=$icpe_dreal->url_cedric?>" target="blank">
                    Consulter la fiche de l'établissement dans la Base des installations classées
                </a>
            </li>
        <?php
            break;            
    endswitch; ?>
<!-- 7. Formulaires standards de données pour Natura 2000 sur le site de l'INPN -->
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
<!-- 8. Lien vers la fiche ZNIEFF sur le site de l'INPN -->
<li>
<?php
    if(($id_type==10)||($id_type==11)):
        $znieff_ip = new ZnieffIp();
        $znieff_ip->getZnieffIpByIdRegional($id_regional, $id_type);
?>
    <a class="document" 
       href="<?=URL_INPN_ZNIEFF?><?=$znieff_ip->id_national?>" target="_blank">
        Consulter la fiche ZNIEFF actualis&eacute;e sur le site de l'INPN
    </a>
<?php endif; ?>
</li>
<!-- 9. Décrets -->
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
<!-- 10. Arrêtés -->
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
<!-- 11. Documents d'objectifs pour Natura 2000 sur le portail SIDE-->
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
<!-- 12. Arrêtés pour Natura 2000 sur le site Internet de la DREAL-->
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
<!-- 13. Plans de gestion pour les RNN -->
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
<!-- 14. Rapports de présentation pour les sites classés -->
<?php
    if($id_type==13):
    $site_classe_inscrit = new SiteClasseInscrit();
    $site_classe_inscrit->getSiteClasseInscritDataByIdRegional($id_regional);
?>
    <?php if($site_classe_inscrit->id_side != ""): ?>
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
<!-- 15. Photographies -->
<li>
    <!-- 15.1 Photographies pour les ZNIEFF -->
    <?php if(($id_type==10)||($id_type==11)): ?>
        <?php $znieff_photos = getZnieffIpPhotosByIdRegional($id_regional, $id_type); ?>
    <?php endif; ?>
    <?php if(count($znieff_photos) > 0): ?>
    <a class="link" 
       href="spip.php?page=photos&amp;id_type=<?= $id_type ?>&amp;id_regional=<?= $id_regional ?>">
        Afficher les photographies
    </a>
    <?php endif; ?>    
    <!-- 15.2 Photographies  pour les RNN -->
    <?php if($id_type==2): ?>
        <?php $rnn_photos = getRnnPhotosByIdRegional($id_regional); ?>
    <?php endif; ?>
    <?php if(count($rnn_photos) > 0): ?>
    <a class="link" 
       href="spip.php?page=photos&amp;id_type=<?= $id_type ?>&amp;id_regional=<?= $id_regional ?>">
        Afficher les photographies
    </a>
    <?php endif; ?>
    <!-- 15.3 Photographies pour les sites classés et inscrits -->
    <?php if($id_type==13): ?>
        <?php $site_classe_inscrit_photos = getSiteClasseInscritPhotosByIdRegional($id_regional, $id_type); ?>
    <?php endif; ?>
    <?php if(count($site_classe_inscrit_photos) > 0): ?>
    <a class="link" 
       href="spip.php?page=photos&amp;id_type=<?= $id_type ?>&amp;id_regional=<?= $id_regional ?>">
        Afficher les photographies
    </a>
    <?php endif; ?>
</li>
</ul>