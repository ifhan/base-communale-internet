<?php

/**
 * Description of Zde
 * Classe et fonction concernant les zones de développement éolien
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-09-05
 * @version 1.0
 */
class Zde {
    
    /**
     * Sélectionne une ZDE par son identifiant
     * @param string $id_zde Identifiant de la ZDE
     */
    public function getZdeByIdZde($id_zde) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_zde_eolien_s_r52
        WHERE id_zde = :id_zde');
        $sql->bindParam(':id_zde', $id_zde, PDO::PARAM_STR, 7);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->nom_zde = $row['nom_zde'];
            $this->id_zde = $row['id_zde'];
            $this->datearrete = date("d/m/Y", strtotime($row['datearrete']));
            $this->pu_mini = $row['pu_mini'];
            $this->pu_maxi = $row['pu_maxi'];
            $this->etat_zde = $row['etat_zde'];
            $this->surfdeclar = $row['surfdeclar'];
            $this->refarrete = $row['refarrete'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
}

/**
 * Sélectionne l'ensemble des ZDE de la région Pays de la Loire
 * @return array 
 */
function getZde() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM n_zde_eolien_s_r52
    ORDER BY id_zde');
    try {
        $sql->execute();
        $array_zde = $sql->fetchAll();
        return $array_zde;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les ZDE d'un département
 * @todo à construire à partir de la table n_zde_com_r52
 */
function getZdeByDpt($id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM n_zde_com_r52
    WHERE code_com LIKE :id_dpt
    ORDER BY id_zde');
    $sql->bindParam(':id_dpt', $id_dpt, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $array_zde = $sql->fetchAll();
        return $array_zde;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
