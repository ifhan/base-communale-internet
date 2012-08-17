<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/CoursEau.class.php';
require_once 'classes/Departement.class.php';

$departements = getDepartementsStationsQualiteByIdRegion();

/* Récupération de la valeur de l'identifiant du département envoyé 
 * par le formulaire s'il existe */
$id_dpt = isset($_POST['departement'])?$_POST['departement']:null;
?>
<table>
    <tr>
        <td>
            <div class="select">
                <form action="spip.php?rubrique7" method="post" id="changeriviere">
                    <p>D&eacute;partement&nbsp;:</p>
                    <select name="departement" id="departement" onchange="document.forms['changeriviere'].submit();">
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
            <?php $rivieres = getRivieresQualiteByIdDpt($id_dpt); ?>
            <div class="select">
                <form action="spip.php?page=liste_stations_qualite" method="post">
                    <p>Cours d'eau&nbsp;:</p>
                    <input type="hidden" name="departement" value="<?php echo $id_dpt; ?>" />
                    <select name="id_riviere" id="id_riviere">
                        <option value="-1">--- Choisir un cours d'eau ---</option>
                        <?php foreach($rivieres as $riviere): ?>
                        <option value="<?=$riviere['id_riviere']?>">
                            <?=stripslashes($riviere['nom_riviere'])?>
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
