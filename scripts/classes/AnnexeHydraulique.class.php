<?php

/**
 * Description of AnnexeHydraulique
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
        $sql = $pdo->prepare('SELECT * FROM r_annexes_hydrauliques_r52_data
        WHERE r_annexes_hydrauliques_r52_data.id_commun = :id_commun');
        $sql->bindParam(':id_commun', $id_commun, PDO::PARAM_STR, 10);
        try { 
            $sql->execute();
            $row = $sql->fetch();
            $this->nom_principal = $row['nom_principal'];
            $this->autres_noms = $row['autres_noms'];
            $this->description = $row['description'];
            $this->SDAGE = $row['SDAGE'];
            $this->lineaire_surfacique = $row['lineaire_surfacique'];
            $this->annexes_2004 = $row['annexes_2004'];
            $this->type_hydraulique_dominant = $row['type_hydraulique_dominant'];
            $this->statut_foncier = $row['statut_foncier'];
            $this->detail = $row['detail'];
            $this->rive = $row['rive'];
            $this->id_dpt = $row['id_dpt'];
            $this->ile_associee = $row['ile_associee'];
            $this->annexe_associee = $row['annexe_associee'];
            $this->nom_levee = $row['nom_levee'];
            $this->exterieur_interieur = $row['exterieur_interieur'];
            $this->surf_annexe = $row['surf_annexe'];
            $this->surf_frayeres = $row['surf_frayeres'];
            $this->longueur_km = $row['longueur_km'];
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
            FROM r_annexes_hydrauliques_r52_data
            ORDER BY r_annexes_hydrauliques_r52_data.id_commun');
    try {
        $sql->execute();
        $annexes = $sql->fetchAll();
        return $annexes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>