<?php

/**
 * Description of Znieff1G
 * Classe et fonctions concernant les Zones Naturelles d'Intérêt Faunistique et
 * Floristique (ZNIEFF) de première génération
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-23
 * @version 1.0
 */
class Znieff1G {

    /**
     * Sélectionne une ZNIEFF de 1ère génération par son identifiant régional
     * et l'identifiant du type de zonage 
     * @param string $id_regional Identifiant régional du zonage
     * @param int $id_type Identifiant du type de zonage
     */
    public function getZnieff1GByIdRegional($id_regional, $id_type) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        if ($id_type == 8):
            $sql = $pdo->prepare('SELECT * 
            FROM R_ZNIEFF1_G1_R52, R_ZNIEFF1_G1_R52_data
            WHERE R_ZNIEFF1_G1_R52.id_regional = :id_regional 
            AND R_ZNIEFF1_G1_R52.id_regional = 
            R_ZNIEFF1_G1_R52_data.id_regional');
        elseif ($id_type == 9):
            $sql = $pdo->prepare('SELECT * 
            FROM R_ZNIEFF2_G1_R52, R_ZNIEFF2_G1_R52_data
            WHERE R_ZNIEFF2_G1_R52.id_regional = :id_regional 
            AND R_ZNIEFF2_G1_R52.id_regional = 
            R_ZNIEFF2_G1_R52_data.id_regional');
        endif;
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->annee_description = $row["annee_description"];
            $this->annee_maj = $row['annee_maj'];
            $this->type_zone = $row['type_zone'];
            $this->altitude_min = $row['altitude_min'];
            $this->altitude_max = $row['altitude_max'];
            $this->surface = $row['surface'];
            $this->commentaire_general = nl2br($row['commentaire_general']);
            $this->sources = $row['sources'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}
