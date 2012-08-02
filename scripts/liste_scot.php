<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';
    
/* On récupère si elle existe la valeur du département envoyée par le formulaire */

$idr = isset($_POST['departement_scot']) ? $_POST['departement_scot'] : null;
if (isset($_POST['ok']) && isset($_POST['scot']) && $_POST['scot'] != "") {

    $departement_selectionne = $_POST['departement'];
    $scot_selectionnee = $_POST['scot'];
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
	<form action="spip.php?rubrique2" method="post" id="changescot">
	<p>D&eacute;partement&nbsp;:</p>	
		<select name="departement_scot" id="departement_scot" onchange="document.forms['changescot'].submit();">
			<option value="-1">---Choisir un d&eacute;partement---</option>
<?php for ($i = 0; $i < $nb_departement; $i++) { ?>
    			<option value="<?php echo($code_departement[$i]); ?>"<?php echo((isset($idr) && $idr == $code_departement[$i]) ? " selected=\"selected\"" : null); ?>><?php echo($nom_departement[$i]); ?></option>
<?php } ?>
		</select>
<?php
mysql_free_result($rech_departement);

/* On commence par vérifier si on a envoyé un numéro de département et le cas échéant s'il est différent de -1 */

if (isset($idr) && $idr != -1) {

    /* Création de la requête pour avoir les scots de ce département */

    $query_2 = "SELECT id_scot, nom_scot FROM R_SCOT_R52
		WHERE id_departement = " . $idr . " ORDER BY nom_scot";

    if ($connexion != false) {

        $rech_scot = mysql_query($query_2, $connexion);

        /* Un petit compteur pour les scots */

        $nd = 0;

        /* On crée deux tableaux pour les numéros et les noms des départements */

        $code_scot = array();
        $nom_scot = array();

        /* On va mettre les numéros et noms des départements dans les deux tableaux */

        while ($ligne_scot = mysql_fetch_assoc($rech_scot)) {

            array_push($code_scot, $ligne_scot['id_scot']);
            array_push($nom_scot, $ligne_scot['nom_scot']);
            $nd++;
        }
?>
        	</form>
        </div>
        </td><td>
        <div class="select">
        	<form action="spip.php?page=fiche_scot&amp;id_scot=" method="post">
        	<p>SCoT&nbsp;:</p>
        		<select name="id_scot" id="id_scot">
        <?php for ($d = 0; $d < $nd; $d++) { ?>
              			<option value="<?php echo($code_scot[$d]); ?>"<?php echo((isset($scot_selectionnee) && $scot_selectionnee == $code_scot[$d]) ? " selected=\"selected\"" : null); ?>><?php echo(utf8_encode($nom_scot[$d])); ?></option>
        <?php } ?>
        		</select>
        	<input type="submit" name="ok" id="ok" value="Ok" />
        <?php
    }

    mysql_free_result($rech_scot);
}
        ?>
	</form>
</div>
</td></tr></table>
<?php mysql_close($connexion); ?>