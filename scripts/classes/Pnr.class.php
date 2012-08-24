<?php

/**
 * Description of Pnr
 * Classe et fonctions concernant les Parcs Naturels Régionaux (PNR)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-26
 * @version 1.0
 */
class Pnr {

    /**
     * Sélectionne un PNR par son identifiant régional
     * @global string $pdo Connexion à la base de données
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getPnrByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_PNR_R52 
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->surf_sig_l93 = $row["surf_sig_l93"];
            $this->url_site = $row["url_site"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
