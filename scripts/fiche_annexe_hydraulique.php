<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/AnnexeHydraulique.class.php';
require_once 'classes/Zonage.class.php';

/**
 * Ce fichier sert à afficher l'ensemble des informations concernant l'annexe
 * @var $id_commun Identifiant de l'annexe
 */
$id_commun = $_REQUEST["id_commun"];

$annexe_hydraulique = new AnnexeHydraulique();
$annexe_hydraulique->getAnnexeHydrauliqueByIdCommun($id_commun);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType("40");
?>
<h3 class="spip">Identification de l'annexe :</h3>
<table class="spip">
        <tr>
            <th class="cell_first">Identifiant :</th>
            <td><?=$id_commun?></th>
        </tr>
        <tr>
            <th class="cell_first">Nom principal :</th>
            <td><?=$annexe_hydraulique->nom_principal?></td>
        </tr>
        <tr>
            <th class="cell_first">Autres noms :</th>
            <td><?=$annexe_hydraulique->autres_noms?></td>
        </tr>
        <tr>
            <th class="cell_first">Description :</th>
            <td><?=$annexe_hydraulique->description?></td>
        </tr>
</table>
<h3 class="spip">Typologie :</h3>
<ul class="spip">
    <li><strong>Typologie SDAGE :</strong> <?=$annexe_hydraulique->SDAGE?></li>
    <li><strong>Linéaire/surfacique :</strong> <?=$annexe_hydraulique->lineaire_surfacique?></li>
    <li><strong>Type d'annexe :</strong> <?=$annexe_hydraulique->annexes_2004?></li>
    <li><strong>Type hydraulique dominant :</strong> <?=$annexe_hydraulique->type_hydraulique_dominant?></li>
</ul>
<h3 class="spip">Statut foncier :</h3>
<ul class="spip">
    <li><strong>Privé/public/mixte :</strong> <?=$annexe_hydraulique->statut_foncier?></li>
    <li><strong>Détail :</strong> <?=$annexe_hydraulique->detail?></li>
</ul>
<h3 class="spip">Localisation :</h3>
<div text="top">
    <table>
        <tr>
            <td style="vertical-align:bottom;">
                <img src="IMG/png/gnome-globe.png" 
                     style="border:none" 
                     alt="Icone web" />
            </td>
            <td>
                <a href="<?=URL_CARMEN?><?=$zonage->map?>.map&object=stations_temperature_rcs;id_commun;<?=$id_commun?>" 
                   target="_blank">Visualiser l'annexe sur CARMEN</a>.   
            </td>
        </tr>
    </table>
</div>
<ul class="spip">
    <li><strong>Département :</strong> <?=$annexe_hydraulique->id_dpt?></li>
    <li><strong>Commune :</strong> </li>
    <li><strong>Rive :</strong> <?=$annexe_hydraulique->rive?></li>
    <li><strong>Île associée :</strong> <?=$annexe_hydraulique->ile_associee?></li>
    <li><strong>Annexe associée :</strong> <?=$annexe_hydraulique->annexe_associee?></li>
</ul>
<h3 class="spip">Position de l'annexe par rapport au lit endigué :</h3>
<ul class="spip">    
    <li><strong>Nom de la levée :</strong> <?=$annexe_hydraulique->nom_levee?></li>
    <li><strong>Extérieur/intérieur :</strong> <?=$annexe_hydraulique->exterieur_interieur?></li>
</ul>
<h3 class="spip">Surface (en ha) :</h3>
<ul class="spip"> 
    <li><strong>Totalité de l'annexe (surface morphologique ) et/ou surface de vallée inondable :</strong> <?=$annexe_hydraulique->surf_annexe?></li>
    <li><strong>Frayères :</strong> <?=$annexe_hydraulique->surf_frayeres?></li>
</ul>
<ul class="spip"> 
    <li><strong>Longueur de l'annexe (en km) :</strong> <?=$annexe_hydraulique->longueur_km?></li>
</ul>
    
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            