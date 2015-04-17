<?php

/**
 * Description of ZoneInteretSterileMinier
 * Classe et fonctions concernant les stériles miniers
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-16
 * @version 1.0
 */
class ZoneInteretSterileMinier {

    /**
     * Sélectionne un stérile minier par son identifiant régional
     * @param string $id_regional Identifiant régional du titre
     */
    public function getZoneInteretSterileMinierByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_zone_interet_sterile_minier_s_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];
            $this->nom = $row["nom"];            
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}