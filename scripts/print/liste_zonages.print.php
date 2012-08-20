<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<?php 
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';
?>

<head>

	<title><?php include("query_type_zonage.php")?></title>
	<INCLURE{fond=inc-head}>
	<meta http-equiv="Content-Type" content="text/html; charset=#CHARSET">

<!-- Feuilles de style -->

<link rel="stylesheet" href="../css/spip_style.css" type="text/css" media="projection, screen, tv">
<link rel="stylesheet" href="../css/style_intranet.css" type="text/css" media="print, projection, screen, tv">
<link rel="stylesheet" href="../css/special_intranet.css" type="text/css" media="print, projection, screen, tv">
<link rel="stylesheet" href="../css/print_intranet.css" type="text/css" media="print, projection, screen, tv">

<!-- Favicon -->

<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

</head>

<body class="white">

	<table id="cartouche" width="100%">
		<tr>
			<td><img src="IMG/jpg/Bloc-Marques_MEEDDADT-150.jpg" alt="Logo MEDDLT"></td>
			<td valign="middle" width="90%">

				<h1 class="titre-texte"><?php include("query_type_zonage.php")?></h1>
				<div class="soustitre"><?php include("query_departement.php")?></div>
				<div class="ps"></div>
			</td>
		</tr>
	</table><br />

	<div><?php include("liste_zonages.php")?></div><br />

</body>

</html>