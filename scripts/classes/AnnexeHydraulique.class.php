<?php

/**
 * Description of AnnexesHydrauliques
 * Classe et fonction concernant les annexes hydrauliques en Pays de la Loire
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2013-08-27
 * @version 1.0
 */
class AnnexeHydraulique {
    /**
     * Sélectionne une annexe par son identifiant
     * @param string $id_commun Identifiant de l'annexe
     */
    public function getAnnexeHydrauliqueByIdCommun($id_commun) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM R_ANNEXES_HYDRAULIQUES_R52_data
        WHERE R_ANNEXES_HYDRAULIQUES_R52_data.id_commun = :id_commun');
        $sql->bindParam(':id_commun', $id_commun, PDO::PARAM_STR, 10);
        try { 
            $sql->execute();
            $row = $sql->fetch();
            $this->nom_principal = $row['nom_principal'];
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
 * Sélectionne l'ensemble des annexes hydrauliques de la région
 * @return array 
 */    
function getAnnexesHydrauliques() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
            FROM R_ANNEXES_HYDRAULIQUES_R52_data
            ORDER BY R_ANNEXES_HYDRAULIQUES_R52_data.id_commun');
    try {
        $sql->execute();
        $annexes = $sql->fetchAll();
        return $annexes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>