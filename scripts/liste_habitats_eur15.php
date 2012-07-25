<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/HabitatEur15.class.php';

$habitats_eur15 = getHabitatsEur15();
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom de l'habitat</th>
            <th>Liste</th>
        </tr>
    </thead>
    <tbody>     
<?php foreach ($habitats_eur15 as $habitat_eur15):  ?>
        <tr valign="top">
            <td><?=$habitat_eur15["ID_EUR15"]?></td>
            <td><?=$habitat_eur15["LB_EUR15"]?></td>
            <td class="cache">
                <div class="logo" align="right">
                    <a href='spip.php?page=liste_zonages&id_dpt=0&id_eur15=<?=$habitat_eur15["ID_EUR15"]?>'>
                        <img src='IMG/png/system-search.png' alt='Lien vers la Ressource' /></a><br />
                </div>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table><br />