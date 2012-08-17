<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Epci.class.php';
require_once 'classes/Departement.class.php';

$departements = getDepartementByRegion();

/* Récupération de la valeur de l'identifiant du département envoyé 
 * par le formulaire s'il existe */
$id_dpt = isset($_POST['departement_epci'])?$_POST['departement_epci']:null;
?>
<table>
    <tr>
        <td>
            <div class="select">
                <form action="spip.php?rubrique2" method="post" id="changeepci">
                    <p>D&eacute;partement&nbsp;:</p>
                    <select name="departement_epci" id="departement_epci" onchange="document.forms['changeepci'].submit();">
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
            <?php $array_epci = getEpciByIdDpt($id_dpt); ?>
            <div class="select">
                <form action="spip.php?page=fiche_epci&amp;id_epci=" method="post">
                    <p>EPCI&nbsp;:</p>
                    <select name="id_epci" id="id_epci">
                        <?php foreach ($array_epci as $epci): ?>
                        <option value="<?=$epci['id_epci']?>">
                        <?=$epci['nom_epci']?>
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