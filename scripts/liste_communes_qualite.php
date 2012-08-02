<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';
	
	/* On récupère si elle existe la valeur du département envoyée par le formulaire */

$idr = isset($_POST['departement_commune']) ? $_POST['departement_commune'] : null;
if (isset($_POST['ok']) && isset($_POST['commune']) && $_POST['commune'] != "") {

    $departement_selectionne = $_POST['departement'];
    $commune_selectionnee = $_POST['commune'];
}

/* On établit la connexion à MySQL avec mysql_pconnect() plutôt qu'avec mysql_connect()
  car on aura besoin de la connexion un peu plus loin dans le script */

$connexion = mysql_pconnect($host, $user, $pass);

$choixbase = mysql_select_db($bdd, $connexion);
$query_1 = "SELECT * FROM BDC_DEPARTEMENT_52 WHERE id_region = 18 ORDER BY nom_departement";
$rech_departement = mysql_query($query_1);
$code_departement = array();
$nom_departement = array();

/* On active un compteur pour les départements */

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
	<form action="spip.php?rubrique7" method="post" id="changecommune">
	<p>D&eacute;partement&nbsp;:</p>	
	<select name="departement_commune" id="departement_commune" onchange="document.forms['changecommune'].submit();">
		<option value="-1">---Choisir un d&eacute;partement---</option>
<?php for ($i = 0; $i < $nb_departement; $i++) { ?>
    		<option value="<?php echo($code_departement[$i]); ?>"<?php echo((isset($idr) && $idr == $code_departement[$i]) ? " selected=\"selected\"" : null); ?>><?php echo(utf8_encode($nom_departement[$i])); ?></option>
<?php } ?>
	</select>
<?php
mysql_free_result($rech_departement);

/* On commence par vérifier si on a envoyé un numéro de département et le cas échéant s'il est différent de -1 */

if (isset($idr) && $idr != -1) {

    /* Création de la requête pour avoir les communes de ce département */

    $table_1 = "BDC_COMMUNE_52";
    $table_2 = "R_STATION_QUALITE_RCS_R52";

    $query_2 = "SELECT $table_1.id_commune, $table_2.id_commune, $table_1.nom_commune 
		FROM $table_1, $table_2 WHERE $table_1.id_departement = " . $idr . " 
		AND $table_1.id_commune = $table_2.id_commune GROUP BY $table_1.nom_commune
		ORDER BY $table_1.nom_commune";

    if ($connexion != false) {

        $rech_commune = mysql_query($query_2, $connexion);

        /* Un petit compteur pour les communes */

        $nd = 0;

        /* On crée deux tableaux pour les numéros et les noms des départements */

        $code_commune = array();
        $nom_commune = array();

        /* On va mettre les numéros et noms des départements dans les deux tableaux */

        while ($ligne_commune = mysql_fetch_assoc($rech_commune)) {

            array_push($code_commune, $ligne_commune['id_commune']);
            array_push($nom_commune, $ligne_commune['nom_commune']);
            $nd++;
        }
?>
        	</form>
        </div>
        </td><td>
        <div class="select">
        	<form action="spip.php?page=liste_stations_communes" method="post">
        	<p>Commune&nbsp;:</p>
        	<select name="commune" id="commune">
        <?php for ($d = 0; $d < $nd; $d++) { ?>
            	  	<option value="<?php echo($code_commune[$d]); ?>"<?php echo((isset($commune_selectionnee) && $commune_selectionnee == $code_commune[$d]) ? " selected=\"selected\"" : null); ?>><?php echo(utf8_encode($nom_commune[$d]) . " (" . $code_commune[$d] . ")"); ?></option>
        <?php } ?>
        	</select>
        	<input type="submit" name="ok" id="ok" value="Ok" />
        <?php
    }

    mysql_free_result($rech_commune);
}
        ?>
	</form>
</div>
</td></tr></table>
<?php mysql_close($connexion); ?>