<?php

/**
 * Description of Zsc
 * Classe et fonctions concernant les Zones Spéciales de Conservation (ZSC)
 * (Natura 2000, directive "Habitats")
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-26
 * @version 1.0
 */
class Zsc {

    /**
     * Sélectionne les données annexes d'une ZSC
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getZscDataByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_zsc_r52_data 
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->dreal = $row["dreal"];
            $this->url_fiche = $row["url_fiche"];
            $this->url_docob = $row["url_docob"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
