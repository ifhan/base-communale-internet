<?php

/**
 * Description of IcpeTar
 * Classe et fonctions concernant les tours aéro-réfrigérantes (TAR)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-10
 * @version 1.0
 */
class IcpeTar {

    /**
     * Sélectionne une tour aéro-réfriférante par son identifiant régional
     * @param string $id_regional Identifiant régional du site
     */
    public function getIcpeTarByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_icpe_tar_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->url_basol = $row["url_basol"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}