<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Utility functions  
require_once 'classes/utilities.inc.php';

// Classes
require_once 'classes/OiseauProtege.class.php';

/**
 * @var  $id_article Identifiant de l'article
 * @todo ajouter les identifiants TAXREF des espèces
 */
$id_article = $_REQUEST["id_article"];

$oiseaux_proteges = getOiseauxProtegesByIdArticle($id_article);
?>
<?php if ($id_article !== "0"): ?>
    <p>Esp&egrave;ces list&eacute;es &agrave; l'article <?= $id_article ?> de l'arr&ecirc;t&eacute; du 29 octobre 2009 :</p><br />
<?php endif; ?>
<table class="display" id="example">
    <thead>
        <tr>
            <th>Ligne</th>
            <th>Identifiant TAXREF</th>
            <th>Nom vernaculaire</th>
            <th>Nom latin</th>
            <th>Article</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($oiseaux_proteges as $oiseau_protege): ?>
            <tr>
                <td><?= $oiseau_protege["id"] ?></td>
                <td></td>
                <td>
                    <?= $partie = explode("(", $oiseau_protege["nom"]) ?>
                    <?= $partie[0] ?>
                </td>
                <td>
                    <em><?= $label = str_replace(").", '', $partie[1]) ?><?= $label ?></em>
                </td>
                <td><?= $oiseau_protege["id_article"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>