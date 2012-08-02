<?php
function formulaires_qualite_recherche_reseau_traiter_dist(){
    /**
     * Permet d'utiliser le bouton "Précédent" pour revenir au formulaire
     */
    refuser_traiter_formulaire_ajax();
    /**
     * @var $id_reseau Identifiant du réseau
     * @var $id_dpt Code géographique du département
     */
    $id_reseau = _request('id_reseau');
    $id_dpt = _request('id_dpt');
    return array(
        'redirect' => 'spip.php?page=liste_stations_reseaux&id_reseau=' . $id_reseau . '&id_dpt=' . $id_dpt
    );
}
?>