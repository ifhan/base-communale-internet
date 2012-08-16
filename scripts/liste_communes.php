<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Commune.class.php';
require_once 'classes/Departement.class.php';

$departements = getDepartementByRegion();

/* Récupération de la valeur du département envoyée par le formulaire 
 * si elle existe */
$id_dpt = isset($_POST['departement'])?$_POST['departement']:null;
?>
<table>
    <tr>
        <td>
            <div class="select">
                <form action="spip.php?rubrique2" method="post" id="changecommune">
                    <p>D&eacute;partement&nbsp;:</p>
                    <select name="departement" id="departement" onchange="document.forms['changecommune'].submit();">
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
        /* On commence par vérifier si on a envoyé un numéro de département et le 
         * cas échéant s'il est différent de -1 */
        if (isset($id_dpt) && $id_dpt != -1):
        ?>
        <td>
            <?php $communes = getCommunesByIdDpt($id_dpt); ?>
            <div class="select">
                <form action="spip.php?page=fiche_commune&amp;id_commune=" method="post">
                    <p>Commune&nbsp;:</p>
                    <select name="id_commune" id="id_commune">
                        <?php foreach ($communes as $commune): ?>
                        <option value="<?= $commune['id_commune'] ?>">
                        <?=$commune['nom_commune']?> (<?= $commune['id_commune'] ?>)
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