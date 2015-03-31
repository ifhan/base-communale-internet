<?php

/**
 * Description of Pprt
 * Classe et fonctions concernant les PPRT
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-20
 * @version 1.0
 */
class Pprt {

    /**
     * Sélectionne un PPRT par son identifiant GASPAR
     * @param string $id_regional Identifiant régional du site
     */
    public function getPprtByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_document_pprt_s_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 18);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->etat = $row["etat"];
            $this->date_approbation = date("d/m/Y", strtotime($row['date_approbation']));
            $this->date_finval = date("d/m/Y", strtotime($row['date_finval']));
            $this->multi_risque = $row["multi_risque"];
            $this->id_risque = $row["id_risque"];
            $this->risque = $row["risque"];
            $this->url = $row["url"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}