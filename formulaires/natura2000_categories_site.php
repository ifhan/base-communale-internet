<?php
function formulaires_natura2000_categories_site_traiter_dist(){
    /**
     * Permet d'utiliser le bouton "Précédent" pour revenir au formulaire
     */
    refuser_traiter_formulaire_ajax();
    /**
     * @var $id_type int Identifiant du type de zonage
     * @var $id_dpt string Identifiant du département
     */
    $id_type = _request('id_type');
    $categorie = _request('categorie');
    return array(
        'redirect' => 'spip.php?page=liste_categories_natura&id_type='.$id_type.'&categorie='.$categorie
    );
}
?>