<?php

/**
 * Description of UnitePaysagere
 * Classe et fonctions concernant les Unités paysagères de l'Atlas de Paysages
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-06-18
 * @version 1.0
 */
class UnitePaysagere {

    /**
     * Sélectionne une unité paysagère par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getUnitePaysagereByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM r_unite_paysagere_r52  
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 4);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->famille_up = $row['famille_up'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
