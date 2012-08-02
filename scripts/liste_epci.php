<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';
	
/* On récupère si elle existe la valeur du département envoyée par le formulaire */

$idr = isset($_POST['departement_epci']) ? $_POST['departement_epci'] : null;
if (isset($_POST['ok']) && isset($_POST['epci']) && $_POST['epci'] != "") {

    $departement_selectionne = $_POST['departement'];
    $epci_selectionnee = $_POST['epci'];
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
        array_push($nom_departement, utf8_encode($ligne_departement['nom_departement']));

        /* On incrémente le compteur */

        $nb_departement++;
    }
}
?>
<table><tr><td>
<div class="select">
	<form action="spip.php?rubrique2" method="post" id="changeepci">
	<p>D&eacute;partement&nbsp;:</p>	
		<select name="departement_epci" id="departement_epci" onchange="document.forms['changeepci'].submit();">
			<option value="-1">---Choisir un d&eacute;partement---</option>
<?php for ($i = 0; $i < $nb_departement; $i++) { ?>
    			<option value="<?php echo($code_departement[$i]); ?>"<?php echo((isset($idr) && $idr == $code_departement[$i]) ? " selected=\"selected\"" : null); ?>><?php echo($nom_departement[$i]); ?></option>
<?php } ?>
		</select>
<?php
mysql_free_result($rech_departement);

/* On commence par vérifier si on a envoyé un numéro de département et le cas échéant s'il est différent de -1 */

if (isset($idr) && $idr != -1) {

    /* Création de la requête pour avoir les epcis de ce département */

    $query_2 = "SELECT id_epci, nom_epci FROM R_EPCI_R52
		WHERE id_departement = " . $idr . " ORDER BY nom_epci";

    if ($connexion != false) {

        $rech_epci = mysql_query($query_2, $connexion);

        /* Un petit compteur pour les epcis */

        $nd = 0;

        /* On crée deux tableaux pour les numéros et les noms des départements */

        $code_epci = array();
        $nom_epci = array();

        /* On va mettre les numéros et noms des départements dans les deux tableaux */

        while ($ligne_epci = mysql_fetch_assoc($rech_epci)) {

            array_push($code_epci, $ligne_epci['id_epci']);
            array_push($nom_epci, $ligne_epci['nom_epci']);
            $nd++;
        }
?>
        	</form>
        </div>
        </td><td>
        <div class="select">
        	<form action="spip.php?page=fiche_epci&amp;id_epci=" method="post">
        		<p>Intercommunalit&eacute;&nbsp;:</p>
        		<select name="id_epci" id="id_epci">
        <?php for ($d = 0; $d < $nd; $d++) { ?>
            		<option value="<?php echo($code_epci[$d]); ?>"<?php echo((isset($epci_selectionnee) && $epci_selectionnee == $code_epci[$d]) ? " selected=\"selected\"" : null); ?>><?php echo($nom_epci[$d]); ?></option>
        <?php } ?>
        		</select>
        	<input type="submit" name="ok" id="ok" value="Ok" />
        <?php
    }

    mysql_free_result($rech_epci);
}
        ?>
	</form>
</div>
</td></tr></table>
<?php mysql_close($connexion); ?>