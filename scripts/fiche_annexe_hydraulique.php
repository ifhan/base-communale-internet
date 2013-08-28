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
 * Ce fichier sert à afficher l'ensemble des informations concernant l'a station'annexe
 * @var $id_commun Identifiant de l'annexe
 */
$id_commun = $_REQUEST["id_commun"];

$annexe_hydraulique = new AnnexeHydraulique();
$annexe_hydraulique->getAnnexeHydrauliqueByIdCommun($id_commun);

$zonage = new Zonage();
$zonage->getTypeZonageByIdType("40");
?>
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
                   target="_blank">Consulter la localisation de l'annexe sur CARMEN</a>.   
            </td>
        </tr>
    </table>
</div>
<h3 class="spip">Principales caract&eacute;ristiques de la station :</h3>
<table class="spip">
    <thead>
        <tr class="row_first">
            <th>Identifiant</th>
            <th>Cours d'eau</th>
            <th>Nom de la station</th>
            <th>Date de mise en service</th>
        </tr>
    </thead>
    <tbody>
        <tr valign="top">
            <td><?=$annexe_hydraulique->id_commun?></td>
            <td><?=$annexe_hydraulique->nom_principal?></td>
            <td><?=$annexe_hydraulique->commune?> (<?=$annexe_hydraulique->id_commune?>) <?=$annexe_hydraulique->localite?></td>
            <td><?=$annexe_hydraulique->mise_en_service?></td>
        </tr>
    </tbody>
</table>
<div class="listedoc">
    <h3>T&eacute;l&eacute;charger :</h3>
    <ul>

    </ul>
</div>