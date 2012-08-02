<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
/*require_once 'classes/Commune.class.php';*/
require_once 'classes/Departement.class.php';

$departements = getDepartementByRegion();
/*$communes = getCommunesByIdDpt($id_dpt);*/

/* Récupération de la valeur du département envoyée par le formulaire 
 * si elle existe */
$id_dpt = isset($_POST['departement'])?$_POST['departement']:null;
/*if(isset($_POST['ok']) && isset($_POST['id_commune']) && $_POST['id_commune'] != ""):
    $departement_selectionne = $_POST['departement'];
    $commune_selectionnee = $_POST['id_commune'];  
endif;*/
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
<?php   
$pdo = null;

/* On commence par vérifier si on a envoyé un numéro de département et le 
 * cas échéant s'il est différent de -1 */

if(isset($id_dpt) && $id_dpt != -1):
    echo $id_dpt;
    global $pdo;
$sql = "SELECT *
        FROM BDC_COMMUNE_52
        WHERE id_departement = $id_dpt
        ORDER BY nom_commune";
    try {
        $query = $pdo->query($sql);
        $communes = $query->fetchAll();
        return $communes;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
    /* Création de la requête pour avoir les communes de ce département */

    /*$query_2 = "SELECT id_commune, nom_commune 
    FROM BDC_COMMUNE_52
    WHERE id_departement = " . $id_dpt . " 
    ORDER BY nom_commune";*/
    
    /*if(isset($pdo)):
        
        

        /*$rech_commune = mysql_query($query_2, $pdo);*/
        
        /* Un petit compteur pour les communes 
        $nd = 0;*/
        
        /* On crée deux tableaux pour les numéros 
         * et les noms des départements       
        $code_commune = array();
        $nom_commune = array();*/
        
        /* On va mettre les numéros et noms des 
         * départements dans les deux tableaux   
        foreach($communes as $commune):
            array_push($code_commune, $commune['id_commune']);
            array_push($nom_commune, $commune['nom_commune']);
            $nd++;
        endforeach;*/ 
?>
        </td>
        <td>
            <div class="select">
                <form action="spip.php?page=fiche_commune&amp;id_commune=" method="post">
                    <p>Commune&nbsp;:</p>
                    <select name="id_commune" id="id_commune">
                        <?php /*for($d = 0; $d<$nd; $d++):*/ ?>
                        <?php foreach($communes as $commune): ?>
                        <option value="<?=$commune['id_commune']?>"<?php echo((isset($commune_selectionnee) && $commune_selectionnee == $commune['id_commune'])?" selected=\"selected\"":null); ?>>
                        <?=$commune['nom_commune']?> (<?=$commune['id_commune']?>)"); ?>
                        </option>
                        <?php endforeach; ?>
                   </select>
                    <input type="submit" name="ok" id="ok" value="Ok" />
                </form>
            </div>
    <?php /*endif;*/ ?>
<?php $pdo = null; ?>
<?php endif; ?>
        </td>
    </tr>
</table>