<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';
	
// Classes
require_once 'classes/Commune.class.php';
require_once 'classes/Departement.class.php';

$id_region = "18";
$departements = getDepartementsByIdRegion($id_region);

/* Récupération de la valeur de l'identifiant du département envoyé 
 * par le formulaire s'il existe */
$id_dpt = isset($_POST['departement_commune'])?$_POST['departement_commune']:null;
?>
<table>
    <tr>
        <td>
            <div class="select">
                <form action="spip.php?rubrique7" method="post" id="changecommune">
                    <p>D&eacute;partement&nbsp;:</p>
                    <select name="departement_commune" id="departement_commune" onchange="document.forms['changecommune'].submit();">
                        <option value="-1">---Choisir un d&eacute;partement---</option>
                        <?php foreach($departements as $departement): ?>
                        <option value="<?=$departement['id_departement']?>"
                            <?php echo((isset($id_dpt) && $id_dpt == $departement['id_departement'])?" selected=\"selected\"":null); ?>>
                            <?=$departement['nom_departement']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </td>
        <?php
        /* Vérification de l'instanciation de l'identifiant du département et 
         * s'il est différent de -1 */
        if(isset($id_dpt) && $id_dpt != -1):
        ?>
        <td>
            <?php $communes = getCommunesStationsQualiteByIdDpt($id_dpt); ?>
            <div class="select">
                <form action="spip.php?page=liste_stations_qualite_communes" method="post">
                    <p>Commune&nbsp;:</p>
                    <select name="id_commune" id="id_commune">
                    <?php foreach($communes as $commune): ?>
                        <option value="<?=$commune['id_commune']?>">
                        <?=$commune['nom_commune']?> (<?=$commune['id_commune']?>)
                        </option>
                    <?php endforeach; ?>
                    </select>
                    <input type="submit" name="ok" id="ok" value="Ok" />           
                </form>
            </div>
        </td>
        <?php endif; ?>
    </tr>
</table>
