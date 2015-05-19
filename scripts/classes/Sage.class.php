<?php

/**
 * Description of Sage
 * Classe et fonctions concernant les Schémas d'Aménagement et de Gestion
 * des Eaux (SAGE)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-05-19
 * @version 1.2
 */
class Sage {

    /**
     * Sélectionne un SAGE par son identifiant régional
     * @param string $id_regional Identifiant régional du SAGE
     */
    public function getSageByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM n_sage_r52
        WHERE n_sage_r52.id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row['id_regional'];
            $this->nom = $row['nom'];
            $this->etat = $row['etat'];
            $this->comite = $row['comite'];
            $this->type_perimetre = $row['type_perimetre'];
            $this->url_gesteau = $row['url_gesteau'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
