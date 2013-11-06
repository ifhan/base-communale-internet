<?php

function formulaires_type_taxons_plans_traiter_dist() {
    /**
     * Permet d'utiliser le bouton "Précédent" pour revenir au formulaire
     */
    refuser_traiter_formulaire_ajax();
    /**
     * @var $type_plan string Type de plan
     * @var $type_sp string Type d'espèces (Faune/Flore)
     */
    $type_plan = _request('type_plan');
    $type_sp = _request('type_sp');
    return array(
        'redirect' => 'spip.php?page=liste_taxons_plans&type_plan=' . $type_plan . '&type_sp=' . $type_sp
    );
}

?>