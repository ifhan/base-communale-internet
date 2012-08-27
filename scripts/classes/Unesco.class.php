<?php

/**
 * Description of Unesco
 * Classe et fonctions concernant les sites insctits au Patrimoine Mondial
 * de l'UNESCO
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-26
 * @version 1.0
 */
class Unesco {

    /**
     * Sélectionne un bien UNESCO par son identifiant régional
     * @global string $pdo Connexion à la base de données
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getUnescoByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM R_UNESCO_049
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 5);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_bien = $row["id_bien"];
            $this->nom = $row["nom"];
            $this->url_site = $row["url_site"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
