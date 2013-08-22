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
        global $pdo_pg;
        $sql = $pdo_pg->prepare('SELECT * FROM eolien."N_ZDE_EOLIEN_S_R52"
        WHERE "N_ZDE_EOLIEN_S_R52"."ID_ZDE" = :id_zde');
        $sql->bindParam(':id_zde', $id_zde, PDO::PARAM_INT, 7);
        try { 
            $sql->execute();
            $row = $sql->fetch();
            $this->nom_zde = $row['NOM_ZDE'];
            $this->id_zde = $row['ID_ZDE'];
            $this->datearrete = date("d/m/Y", strtotime($row['DATEARRETE']));
            $this->pu_mini = $row['PU_MINI'];
            $this->pu_maxi = $row['PU_MAXI'];
            $this->etat_zde = $row['ETAT_ZDE'];
            $this->surfdeclar = $row['SURFDECLAR'];
            $this->refarrete = $row['REFARRETE'];
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
    global $pdo_pg;
    $sql = $pdo_pg->prepare('SELECT * FROM N_ZDE_EOLIEN_S_R52
    ORDER BY ID_ZDE');
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
