<?php

/**
 * Description of Ramsar
 * Classe et fonctions concernant les secteurs d'application de la convention
 * de Ramsar
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-30
 * @version 1.0
 */
class Ramsar {

    /**
     * Sélectionne un secteur d'application de la convention de Ramsar 
     * par son identifiant régional
     * @global string $pdo Connexion à la base de données
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getRamsarByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_RAMSAR_R52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->surf_sig_l93 = $row["surf_sig_l93"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
