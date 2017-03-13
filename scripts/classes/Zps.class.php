<?php

/**
 * Description of Zps
 * Classe et fonctions concernant les Zones de Protection Spéciale (ZPS)
 * (Natura 2000, directive "Oiseaux")
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-26
 * @version 1.0
 */
class Zps {

    /**
     * Sélectionne les données annexes d'une ZSC
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getZpsDataByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_zps_r52_data 
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
