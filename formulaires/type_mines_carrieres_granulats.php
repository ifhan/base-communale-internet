<?php

function formulaires_type_mines_carrieres_granulats_traiter_dist() {
    /**
     * Permet d'utiliser le bouton "Précédent" pour revenir au formulaire
     */
    refuser_traiter_formulaire_ajax();
    /**
     * @var $id_type int Identifiant du type de zonage
     * @var $id_dpt string Identifiant du département
     */
    $id_type = _request('id_type');
    $id_dpt = _request('id_dpt');
    return array(
        'redirect' => 'spip.php?page=liste_zonages&id_type=' . $id_type . '&id_dpt=' . $id_dpt
    );
}

?>