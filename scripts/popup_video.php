<?php
// Application-wide data and database connection
require_once 'config/constants.inc.php';
require_once 'config/database.inc.php';

// Classes
require_once 'classes/Commune.class.php';
require_once 'classes/Departement.class.php';
require_once 'classes/Epci.class.php';

/**
 * Ce fichier sert à ouvrir une fenêtre pop-up qui lance automatiquement une
 * vidéo en lecture
 * @var $id_commune Code géographique de la commune
 * @var $id_epci Code SIREN de l'EPCI
 * @var $id_dpt Code géographique du département
 */
$id_commune = $_REQUEST["id_commune"];
$id_epci = $_REQUEST["id_epci"];
$id_dpt = $_REQUEST["id_dpt"];
?>
<?php if(!empty($id_commune)): ?>
<?php $commune = new Commune(); ?>
<?php $commune->getCommuneById($id_commune); ?>
<h2>Tache urbaine : <?=$commune->nom_commune?> (<?=$commune->id_commune?>)</h2>
<div class="center">
    <video width="1024" height="768" controls="controls" autoplay="true">
        <source src="http://www.donnees.pays-de-la-loire.developpement-durable.gouv.fr/data/videos/tache_urbaine/<?=$id_commune?>.ogg" type="video/ogg" />
        <object width="1024" height="768" type="application/x-shockwave-flash" data="flashmediaelement.swf">
            <param name="movie" value="javascript/mediaelement/build/flashmediaelement.swf" />
            <param name="flashvars" value="controls=true&poster=myvideo.jpg&file=myvideo.mp4" />
            Votre navigateur n'est pas assez r&eacute;cent pour 
            interpr&eacute;ter la de balise <code>video</code> de 
            <abbr lang="en" title="HyperText Markup Language" xml:lang="en">HTML</abbr>5.
        </object>
    </video>
</div>
<?php endif; ?>
<?php if(!empty($id_epci)): ?>
<?php $epci = new Epci(); ?>
<?php $epci->getEpciByIdEpci($id_epci); ?>
<h2>Tache urbaine : <?=$epci->nom_epci?></h2>
<div class="center">
    <video width="1024" height="768" controls="controls" autoplay="true">
        <source src="http://www.donnees.pays-de-la-loire.developpement-durable.gouv.fr/data/videos/tache_urbaine/<?=$id_epci?>.ogg" type="video/ogg" />
        Votre navigateur n'est pas assez r&eacute;cent pour 
        interpr&eacute;ter la de balise <code>video</code> de 
        <abbr lang="en" title="HyperText Markup Language" xml:lang="en">HTML</abbr>5.
    </video>
</div>
<?php endif; ?>
<?php if(!empty($id_dpt)): ?>
<?php $departement = new Departement(); ?>
<?php $departement->getDepartementById($id_dpt); ?>
<h2>Tache urbaine : <?=$departement->nom_dpt?> (<?=$departement->id_dpt?>)</h2>
<div class="center">
    <video width="1024" height="768" controls="controls" autoplay="true">
        <source src="http://www.donnees.pays-de-la-loire.developpement-durable.gouv.fr/data/videos/tache_urbaine/<?=$departement->id_dpt?>.ogg" type="video/ogg" />
        Votre navigateur n'est pas assez r&eacute;cent pour interpr&eacute;ter 
        la de balise <code>video</code> de 
        <abbr lang="en" title="HyperText Markup Language" xml:lang="en">HTML</abbr>5.
    </video>
</div>
<?php endif; ?>