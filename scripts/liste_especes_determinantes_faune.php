<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/EspeceDeterminante.class.php';

$especes_determinantes_faune = getEspecesDeterminantesFaune();
?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant TAXREF</th>
            <th>Genre</th>
            <th>Nom vernaculaire</th>
            <th>Lien INPN</th>
    </thead>
    <tbody>
        <?php foreach ($especes_determinantes_faune as $espece_determinante_faune): ?>
        <tr>
            <td><?=$espece_determinante_faune["CD_NOM"]?></td>
            <td><em><?=$espece_determinante_faune["GENRE"]?></em></td>
            <td><?=$espece_determinante_faune["NOM_VERNAC"]?></td>
            <?php if ($espece_determinante_faune["CD_NOM"]!=""): ?>
            <td class="cache">
                <div align="right">
                    <a href="<?=URL_INPN_ESPECE?><?=$espece_determinante_faune["CD_NOM"]?>" target="_blank"><img src="IMG/png/Gnome-Emblem-Web-32.png" alt="Icone web" /></a>
                    <br />
                </div>
            </td>
            <?php  else: ?>
            <td></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>