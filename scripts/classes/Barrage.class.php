<?php

/**
 * Description of Barrage
 * Classe et fonctions concernant les barrages
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-06-10
 * @version 1.0
 */
class Barrage {
    
    /**
     * Sélectionne un barrage par son identifiant régional
     * @param int $id_regional Identifiant régional de l'objet
     */
    public function getBarrageByIdRegional($id_regional){
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_barrages_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 12);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->classe_ouvrage = $row["classe_ouvrage"];
            $this->edd_obligatoire = $row["edd_obligatoire"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
}
