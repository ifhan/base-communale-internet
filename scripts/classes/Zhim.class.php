<?php

/**
 * Description of Zhim
 * Classe et fonctions concernant les Zones Humides d'Importance Majeure
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-24
 * @version 1.0
 */
class Zhim {

    /**
     * Sélectionne une ZHIM par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getZhimByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_ZHIM_R52, R_ZHIM_R52_data  
        WHERE R_ZHIM_R52.id_regional = :id_regional
        AND R_ZHIM_R52.id_regional = R_ZHIM_R52_data.id_regional');
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
