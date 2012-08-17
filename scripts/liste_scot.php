<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Scot.class.php';
require_once 'classes/Departement.class.php';

$id_region = "18";
$departements = getDepartementsByIdRegion($id_region);

/* Récupération de la valeur de l'identifiant du département envoyé 
 * par le formulaire s'il existe */
$id_dpt = isset($_POST['departement_scot'])?$_POST['departement_scot']:null;
?>
<table>
    <tr>
        <td>
            <div class="select">
                <form action="spip.php?rubrique2" method="post" id="changescot">
                    <p>D&eacute;partement&nbsp;:</p>
                    <select name="departement_scot" id="departement_scot" onchange="document.forms['changescot'].submit();">
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
        if (isset($id_dpt) && $id_dpt != -1):
        ?>
        <td>
            <?php $array_scot = getScotsByIdDpt($id_dpt); ?>
            <div class="select">
                <form action="spip.php?page=fiche_scot&amp;id_scot=" method="post">
                    <p>SCoT&nbsp;:</p>
                    <select name="id_scot" id="id_scot">
                        <?php foreach($array_scot as $scot): ?>
                        <option value="<?= $scot['id_scot'] ?>">
                        <?=$scot['nom_scot']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="ok" id="ok" value="Ok" />
                </form>
            </div>
            <?php $pdo = null; ?>
        </td>
        <?php endif; ?>
    </tr>
</table>