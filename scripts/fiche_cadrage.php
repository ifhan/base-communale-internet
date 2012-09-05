<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Commune.class.php';

/**
 *  Ce fichier sert à afficher les liens vers les ressources statistiques 
 *  identifiées pour la commune
 *  @var $id_commune Code géographique de la commune
 */
$id_commune = $_REQUEST["id_commune"];

$commune = new Commune();
$commune->getCommuneByIdCommune($id_commune);
?>
<br />
<div class="listerub">
    <a name="risques">
        <div class="titresousrub">Risques</div>
    </a>
    <div text="top">
        <table>
            <tr>
                <td style="vertical-align:bottom;">
                    <img src="IMG/png/gnome-globe.png" style="border:none" alt="Icone web" />
                </td>
                <td>
                    <a href="<?=URL_PRIM_NET?><?=$commune->id_commune?>"  target="_blank">
                       Consulter la fiche de la commune sur le site prim.net
                    </a>.
                </td>
            </tr>
        </table>
    </div>
</div>
<br />
<div class="listerub">
    <a name="stats">
        <div class="titresousrub">Statistiques</div>
    </a>
    <div text="top">
        <table>
            <tr>
                <td style="vertical-align:bottom;">
                    <img src="IMG/png/gnome-globe.png" style="border:none" alt="Icone web" />
                </td>
                <td>
                    <a href='<?=URL_INSEE?><?=$commune->id_commune?>&Niveau=COM' target="_blank">
                        Consulter les donn&eacute;es de cadrage de la commune sur le site de l'INSEE
                    </a>.
                </td>
            </tr>
        </table>
    </div>
</div>