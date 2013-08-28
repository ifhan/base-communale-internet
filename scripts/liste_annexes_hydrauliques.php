<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/AnnexeHydraulique.class.php';

$annexes = getAnnexesHydrauliques();
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($annexes as $annexe): ?>
        <tr valign="top">
            <td><?=$annexe["id_commun"]?></td>
            <td><?=$annexe["nom_principal"]?></td>
            <td><?=$annexe["annexes_2004"]?></td>
            <td class="cache">
                <div align="right">
                    <a href="spip.php?page=fiche_annexe_hydraulique&id_commun=<?=$annexe["id_commun"] ?>"><img src="IMG/png/system-search.png"  alt="Icone afficher la fiche de l'annexe" /></a><br />
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>