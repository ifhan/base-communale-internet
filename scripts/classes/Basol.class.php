<?php

/**
 * Description of Basol
 * Classe et fonctions concernant les sites et sols pollués (BASOL)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-09
 * @version 1.0
 */
class Basol {

    /**
     * Sélectionne un site BASOL par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getBasolByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_basol_p_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 7);
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