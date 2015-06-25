<?php

/**
 * Description of SousUnitePaysagere
 * Classe et fonctions concernant les Sous-unités paysagères de l'Atlas 
 * de Paysages
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-06-18
 * @version 1.0
 */
class SousUnitePaysagere {

    /**
     * Sélectionne une sous-unité paysagère par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getSousUnitePaysagereByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM r_sous_unite_paysagere_r52  
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 4);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->id_up = $row['id_up'];
            $this->nom_up = $row['nom_up'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les sous-unités paysagères d'une unité paysagère à 
 * partir de son identifiant
 * @param int $id_regional Identifiant de l'unité paysagère
 * @return array
 */
function getSousUnitePaysagereByIdUp($id_up) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM r_sous_unite_paysagere_r52 
    WHERE id_up = :id_up
    ORDER BY id_regional');
    $sql->bindParam(':id_up', $id_up, PDO::PARAM_STR, 4);
    try {
        $sql->execute();
        $sous_unite_paysageres = $sql->fetchAll();
        return $sous_unite_paysageres;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
