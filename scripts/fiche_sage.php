<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Sage.class.php';

/**
 * @var $id_regional Identifiant régional du zonage
 */
$id_regional = $_REQUEST["id_regional"];

$sage = new Sage();
$sage->getSageByIdRegional($id_regional);

/**
 * @var $id_situation Identifiant de la situation du SAGE
 */
$id_situation = $sage->avancement;

$sage_situation = new Sage();
$sage_situation->getSageSituationByIdSituation($id_situation);
?>
<div align="right">
    <font size="4" color="<?=$sage_situation->code_couleur?>">
    <strong>
        <?=$sage_situation->nom_situation?>
    </strong>
    </font>
</div>
<br />
<table class="cadre_plein">
    <tr>
        <td>Nom&nbsp;:</td>
        <td><strong><?=$sage->nom?></strong></td>
    </tr>
    <tr>
        <td>R&eacute;f&eacute;rent DREAL/SRNP/DERM&nbsp;:</td>
        <td><strong><?=$sage->referent_sema?></strong></td>
    </tr>
    <?php if(!empty($sage->maitre_ouvrage)):?>
    <tr>
        <td>Ma&icirc;tre d'ouvrage&nbsp;:</td>
        <td><strong><?=$sage->maitre_ouvrage?></strong></td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->president)):?>
    <tr>
        <td>Pr&eacute;sident&nbsp;:</td>
        <td><strong><?=$sage->president?></strong></td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->animateur)):?>
    <tr>
        <td>Animateur&nbsp;:</td>
        <td><strong><?=$sage->animateur?></strong></td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->adresse)):?>
    <tr>
        <td>Adresse&nbsp;:</td>
        <td><strong><?=$sage->adresse?></strong></td>
    </tr>
    <?php endif; ?>
    <?php if( (!empty($sage->tel)) OR (!empty($sage->fax)) ):?>
    <tr>
        <td>T&eacute;l&eacute;phone / T&eacute;l&eacute;copie&nbsp;:</td>
        <td><strong><?=$sage->tel?> / <?=$sage->fax?></strong></td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->courriel)):?>
    <tr>
        <td>Courriel&nbsp;:</td>
        <td>
            <strong>
                <a href="mailto:<?=$sage->courriel?>">
                    <?=$sage->courriel?>
                </a>
            </strong>
        </td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->enjeux)):?>
    <tr>
        <td valign="top">Enjeux&nbsp;:</td>
        <td><strong><?=$sage->enjeux?></strong></td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->sdage)):?>
    <tr>
        <td valign="top">Pr&eacute;conisations&nbsp;du&nbsp;SDAGE&nbsp;:</td>
        <td><strong><?=$sage->sdage?></strong></td>
    </tr>
    <?php endif; ?>
</table>
<br />
<?php if( (!empty($sage->bassin_versant)) OR (!empty($sage->rivieres)) ):?>
<h3 class="spip">Caract&eacute;ristiques physiques&nbsp;:</h3>
<ul class="spip">
    <?php if(!empty($sage->bassin_versant)):?>
    <li>
        <strong>Bassin versant&nbsp;:</strong> <?=$sage->bassin_versant?> km2
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->rivieres)):?>
    <li>
        <strong>Rivi&egrave;res&nbsp;:</strong> <?=$sage->rivieres?>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
<?php if( (!empty($sage->nombre_departements)) 
        OR (!empty($sage->nombre_communes))
        OR (!empty($sage->population))):?>
<h3 class="spip">Situation administrative&nbsp;:</h3>
<ul class="spip">
    <?php if(!empty($sage->nombre_departements)):?>
    <li>
        <strong>Nombre de d&eacute;partements&nbsp;:</strong>
            <?=$sage->nombre_departements?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->nombre_communes)):?>
    <li>
        <strong>Nombre de communes&nbsp;:</strong> <?=$sage->nombre_communes?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->population)):?>
    <li>
        <strong>Population concern&eacute;e&nbsp;:</strong> 
            <?=$sage->population?>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
<?php if( (!empty($sage->demandeur)) 
        OR (!empty($sage->comite_bassin)) 
        OR (!empty($sage->prefecture_pilote)) 
        OR (!empty($sage->arrete_perimetre)) 
        OR (!empty($sage->arrete_cle)) ):?>
<h3 class="spip">Phase pr&eacute;liminaire&nbsp;:</h3>
<ul class="spip">
    <?php if(!empty($sage->demandeur)):?>
    <li>
        <strong>Demandeur&nbsp;:</strong> <?=$sage->demandeur?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->comite_bassin)):?>
    <li>
        <strong>Comit&eacute; de bassin&nbsp;:</strong> 
            <?=$sage->comite_bassin?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->prefecture_pilote)):?>
    <li>
        <strong>Pr&eacute;fecture pilote&nbsp;:</strong> 
            <?=$sage->prefecture_pilote?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->arrete_perimetre)):?>
    <li>
        <strong>Arr&ecirc;t&eacute; de p&eacute;rim&egrave;tre&nbsp;:</strong> 
            <?=$sage->arrete_perimetre?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->arrete_cle)):?>
    <li>
        <strong>Arr&ecirc;t&eacute; CLE&nbsp;:</strong> 
            <?=$sage->arrete_cle?>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
<?php if( (!empty($sage->installation_cle)) 
        OR (!empty($sage->diagnostic))
        OR (!empty($sage->enjeux_retenus))
        OR (!empty($sage->strategie))
        OR (!empty($sage->validation)) ):?>
<h3 class="spip">Avancement&nbsp;:</h3>
<ul class="spip">
    <?php if(!empty($sage->installation_cle)):?>
    <li>
        <strong>Installation de la CLE&nbsp;:</strong> 
            <?=$sage->installation_cle?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->diagnostic)):?>
    <li>
        <strong>Diagnostic global&nbsp;:</strong> <?=$sage->diagnostic?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->enjeux_retenus)):?>
    <li>
        <strong>Enjeux retenus&nbsp;:</strong> <?=$sage->enjeux_retenus?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->strategie)):?>
    <li>
        <strong>Choix de la strat&eacute;gie&nbsp;:</strong> 
            <?=$sage->strategie?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->validation)):?>
    <li>
        <strong>Validation finale&nbsp;:</strong> <?=$sage->validation?>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
<?php if( (!empty($sage->consultation)) 
        OR (!empty($sage->date_comite_bassin))
        OR (!empty($sage->arrete_sage)) ):?>
<h3 class="spip">Validation&nbsp;:</h3>
<ul class="spip">
    <?php if(!empty($sage->consultation)):?>    
    <li>
        <strong>Consultation&nbsp;:</strong> <?=$sage->consultation?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->date_comite_bassin)):?>    
    <li>
        <strong>Comit&eacute; de bassin&nbsp;:</strong> 
            <?=$sage->date_comite_bassin?>
    </li>
    <?php endif; ?>
    <?php if(!empty($sage->arrete_sage)):?>
    <li>
        <strong>Arr&ecirc;t&eacute; de SAGE&nbsp;:</strong> 
            <?=$sage->arrete_sage?>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
<br />
<table class="cadre_plein">
    <?php if(!empty($sage->url_site_web)):?>
    <tr>
        <td valign="top">
            <strong>Site Internet&nbsp;:</strong>
        </td>
        <td>
            <a href="<?=$sage->url_site_web?>" target="_blank">
            <?=$sage->url_site_web?>
            </a>
        </td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->documents)):?>    
    <tr>
        <td valign="top">
            <strong>Documents t&eacute;l&eacute;chargeables&nbsp;:</strong>
        </td>
        <td><?=$sage->documents?></td>
    </tr>
    <?php endif; ?>
    <?php if(!empty($sage->priorites)):?>    
    <tr>
        <td valign="top">
            <strong>Principales priorit&eacute;s du SAGE&nbsp;:</strong>
        </td>
        <td><?=$sage->priorites?></td>
    </tr>
    <?php endif; ?>
</table>