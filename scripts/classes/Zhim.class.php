<?php

/**
 * Description of Zhim
 * Classe et fonctions concernant les Zones Humides d'Importance Majeure (ZHIM)
 * provenant de l'Observatoire National des Zones Humides (ONZH)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-02
 * @version 1.1
 */
class Zhim {

    /**
     * Sélectionne une ZHIM par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getZhimByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM r_zhim_r52, r_zhim_r52_data  
        WHERE r_zhim_r52.id_regional = :id_regional
        AND r_zhim_r52.id_regional = r_zhim_r52_data.id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->nom = $row["nom"];
            $this->id_regional = $row["id_regional"];
            $this->presentation = nl2br($row['presentation']);
            $this->enjeux = nl2br($row["enjeux"]);
            $this->actions = nl2br($row["actions"]);
            $this->geologie = nl2br($row['geologie']);
            $this->hydrologie = nl2br($row['hydrologie']);
            $this->eutrophisation = nl2br($row['eutrophisation']);
            $this->autres = nl2br($row['autres']);
            $this->occupation_sol = nl2br($row['occupation_sol']);
            $this->faune_flore = nl2br($row['faune_flore']);
            $this->habitats = nl2br($row['habitats']);
            $this->paysage = nl2br($row['paysage']);
            $this->contexte = nl2br($row['contexte']);
            $this->bibliographie = nl2br($row['bibliographie']);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
