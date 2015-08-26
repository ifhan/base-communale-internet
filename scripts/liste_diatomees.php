<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/Diatomee.class.php';

$diatomees = getDiatomees();
?>
<p>
    <strong><?=count($diatomees)?> taxons</strong> 
    recens&eacute;es en Bretagne et Pays de la Loire.
</p>
<br />
<table class="display" id="example">
    <thead>
        <tr>
            <th>Identifiant</th>           
            <th>Famille</th>
            <th>Genre</th>
            <th>Taxon</th>
            <th>Fiche</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($diatomees as $diatomee): ?>
        <tr valign="top">
            <td><?=$diatomee["code_espece"]?></td>
            <td align="center"><?=$diatomee["famille"]?></td>
            <td align="center"><?=$diatomee["genre"]?></td>
            <td><?=$diatomee["espece"]?></td>
            <td align="center">
                <?php if(file_exists("data/fiches/diatomees/" . $diatomee["espece"] . " - " . $diatomee["code_espece"] . ".pdf")):?>
                <a href="data/fiches/diatomees/<?=$diatomee["espece"]?> - <?=$diatomee["code_espece"]?>.pdf"><img src="IMG/png/filesave.png" alt="Télécharger la fiche du taxon" /></a><br/>
                (PDF, <?=@convertFilesize("data/fiches/diatomees/" . $diatomee["espece"] . " - " . $diatomee["code_espece"] . ".pdf")?>)
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
