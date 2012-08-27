<?php

/**
 * Description of Rnn
 * Classe et fonctions concernant les Réserves Naturelles Nationales (RNN)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-27
 * @version 1.0
 */
class Rnn {

    /**
     * Sélectionne une RNN par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getRnnByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_RNN_R52, R_RNN_R52_data  
        WHERE R_RNN_R52.id_regional = :id_regional 
        AND R_RNN_R52.id_regional = R_RNN_R52_data.id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_national = $row["id_national"];
            $this->nom = $row["nom"];
            $this->surf_sig_l93 = $row["surf_sig_l93"];
            $this->id_decret = $row['id_decret'];
            $this->date = date("d/m/Y", strtotime($row['date']));
            $this->commentaire_decret = $row['commentaire_decret'];
            $this->url_decret = $row['url_decret'];
            $this->parcelles = nl2br($row['parcelles']);
            $this->statut_foncier = nl2br($row['statut_foncier']);
            $this->interet_bio = nl2br($row['interet_bio']);
            $this->effets_protection = nl2br($row['effets_protection']);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les photographies d'une RNN par l'identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getRnnPhotosByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM R_RNN_R52_photos 
    WHERE id_regional = :id_regional');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
    try {
        $sql->execute();
        $rnn_photos = $sql->fetchAll();
        return $rnn_photos;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
