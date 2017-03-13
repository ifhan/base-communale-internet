<?php

/**
 * Description of Zsc
 * Classe et fonctions concernant les Zones Spéciales de Conservation (ZSC)
 * (Natura 2000, directive "Habitats")
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2016-12-23
 * @version 1.1
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
            $this->id_article = $row["id_article"];
            $this->id_side = $row["id_side"];
            $this->id_type = $row["id_type"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
