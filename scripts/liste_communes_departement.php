<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Commune.class.php';

$communes = getCommunesByIdDpt($id_dpt);
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Code g&eacute;ographique</th>
            <th>Nom</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
        <!-- Boucle affichant un tableau listant les communes du département
        avec un lien vers une liste des zonages par commune -->
        <?php foreach ($communes as $commune): ?>
        <tr>
            <td width="10%" align="center"><?=$commune["id_commune"];?></td>
            <td><?=$commune["nom_commune"];?></td>
            <td align="center">
                <a href="spip.php?page=fiche_commune&id_commune=<?=$commune["id_commune"];?>">
                    <img src="IMG/png/system-search.png" alt="Icone Afficher" />
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>