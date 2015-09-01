<?php

/**
 * Description of IcpeSilo
 * Classe et fonctions concernant les ICPE de type silo
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-06-11
 * @version 1.1
 */
class IcpeSilo {

    /**
     * Sélectionne un silo par son identifiant régional
     * @param string $id_regional Identifiant régional du site
     */
    public function getIcpeSiloByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_icpe_silo_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->etat = $row["etat"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}