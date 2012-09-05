<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Zde.class.php';

$array_zde = getZde();
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>     
<?php foreach ($array_zde as $zde):  ?>
        <tr valign="top">
            <td><?=$zde["id_zde"]?></td>
            <td><?=$zde["nom_zde"]?></td>
            <td class="cache">
                <div class="logo" align="right">
                    <a href='spip.php?page=fiche&amp;id_type=39&amp;id_zde=<?=$zde["id_zde"]?>'>
                        <img src='IMG/png/system-search.png' alt='Lien vers la Ressource' /></a><br />
                </div>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table><br />