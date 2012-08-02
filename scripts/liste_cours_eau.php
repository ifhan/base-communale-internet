<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

/* On récupère si elle existe la valeur du département envoyée par le formulaire */

$idr = isset($_POST['departement']) ? $_POST['departement'] : null;
if (isset($_POST['ok']) && isset($_POST['riviere']) && $_POST['riviere'] != "") {

    $departement_selectionne = $_POST['departement'];
    $riviere_selectionnee = $_POST['riviere'];
}

/* On établit la connexion à MySQL avec mysql_pconnect() plutôt qu'avec mysql_connect()
 *  car on aura besoin de la connexion un peu plus loin dans le script */

$connexion = mysql_pconnect($host, $user, $pass);

$choixbase = mysql_select_db($bdd, $connexion);
$query_1 = "SELECT * FROM admin_departements WHERE id_region = 18 OR id_departement = 61
	OR id_departement = 79 ORDER BY id_departement ";
$rech_departement = mysql_query($query_1);
$code_departement = array();
$nom_departement = array();

/* On active un compteur pour les régions */

$nb_departement = 0;
if ($rech_departement != false) {

    while ($ligne_departement = mysql_fetch_assoc($rech_departement)) {

        array_push($code_departement, $ligne_departement['id_departement']);
        array_push($nom_departement, $ligne_departement['nom_departement']);

        /* On incrémente le compteur */

        $nb_departement++;
    }
}
?>
<table><tr><td>
<div class="select">
	<form action="spip.php?rubrique7" method="post" id="changeriviere">
	<p>D&eacute;partement&nbsp;:</p>
	<select name="departement" id="departement" onchange="document.forms['changeriviere'].submit();">
		<option value="-1">---Choisir un d&eacute;partement---</option>
<?php for ($i = 0; $i < $nb_departement; $i++) { ?>
    		<option value="<?php echo($code_departement[$i]); ?>"<?php echo((isset($idr) && $idr == $code_departement[$i]) ? " selected=\"selected\"" : null); ?>><?php echo(utf8_encode($nom_departement[$i])); ?></option>
<?php } ?>
	</select>
<?php
mysql_free_result($rech_departement);

/* On commence par vérifier si on a envoyé un numéro de département 
 * et le cas échéant s'il est différent de -1 */

if (isset($idr) && $idr != -1) {

    /* Création de la requpête pour avoir les rivières de ce département */

    $table = "qualite_rivieres";
    $table_2 = "qualite_departements_rivieres";

    if ($idr != 0) {

        $query_2 = "SELECT * 
        FROM $table, $table_2 
        WHERE $table_2.id_departement = " . $idr . " 
        AND $table.id_riviere = $table_2.id_riviere 
        ORDER BY $table.id_riviere ";
    } else {

        $query_2 = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_riviere = $table_2.id_riviere 
        GROUP BY $table.nom_riviere 
        ORDER BY $table.id_riviere ";
    }

    if ($connexion != false) {

        $rech_riviere = mysql_query($query_2, $connexion);

        /** 
         * Un petit compteur pour les rivières
         */

        $nd = 0;

        /* On crée deux tableaux pour les numéros et les noms des rivières */

        $code_riviere = array();
        $nom_riviere = array();

        /* On va mettre les numéros et noms des rivières dans 
         * les deux tableaux
         */

        while ($ligne_riviere = mysql_fetch_assoc($rech_riviere)) {

            array_push($code_riviere, $ligne_riviere['id_riviere']);
            array_push($nom_riviere, $ligne_riviere['nom_riviere']);
            $nd++;
        }
?>
        	</form>
        </div>
        </td><td>
        <div class="select">
        	<form action="spip.php?page=liste_stations_qualite" method="post">
        	<p>Cours d'eau&nbsp;:</p>
        	<input type="hidden" name="departement" value="<?php echo $idr; ?>" />
        	<select name="riviere" id="riviere">
        		<option value="-1">--- Choisir un cours d'eau ---</option>
        <?php for ($d = 0; $d < $nd; $d++) { ?>
            		<option value="<?php echo($code_riviere[$d]); ?>"<?php echo((isset($riviere_selectionnee) && $riviere_selectionnee == $code_riviere[$d]) ? " selected=\"selected\"" : null); ?>><?php echo(utf8_encode(stripslashes($nom_riviere[$d]))); ?></option>
        <?php } ?>
        	</select>
        	<input type="submit" name="ok" id="ok" value="Ok" />
        <?php
    }

    mysql_free_result($rech_riviere);
}
        ?>
	</form>
</div>
</td></tr></table>
<?php mysql_close($connexion); ?>