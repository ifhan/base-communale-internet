<?php

/**
 * Description of TitreMinier
 * Classe et fonctions concernant les titres miniers en activité ou en projet
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-23
 * @version 1.0
 */
class TitreMinier {

    /**
     * Sélectionne un titre minier par son identifiant régional
     * @param string $id_regional Identifiant régional du titre
     */
    public function getTitreMinierByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_titre_minier_activite_projet_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->titre_minier = $row["titre_minier"];
            $this->type_travaux_miniers = $row["type_travaux_miniers"];
            $this->substances = $row["substances"];
            $this->statut_adm = $row["statut_adm"];            
            $this->demande = date("d/m/Y", strtotime($row['demande']));
            $this->delivrance = date("d/m/Y", strtotime($row['delivrance']));
            $this->titulaire = $row["titulaire"];
            $this->duree_ans = $row["duree_ans"];
            $this->surf_km2 = $row["surf_km2"];
            $this->comment = $row["comment"];
            $this->texte = $row["texte"];
            $this->legifrance = $row["legifrance"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}