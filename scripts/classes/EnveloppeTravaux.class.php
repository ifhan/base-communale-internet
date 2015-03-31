<?php

/**
 * Description of EnveloppeTravaux
 * Classe et fonctions concernant les enveloppes de travaux miniers
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-03-30
 * @version 1.0
 */
class EnveloppeTravaux {

    /**
     * Sélectionne une enveloppe de travaux par son identifiant régional
     * @param string $id_regional Identifiant régional du titre
     */
    public function getEnveloppeTravauxByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_enveloppe_travaux_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->substance = $row["substance"];
            $this->statut = $row["statut"];
            $this->d_statut = $row["d_statut"];
            $this->origine_enveloppe = $row["origine_enveloppe"];            
            $this->surf_enveloppe = $row["surf_enveloppe"];
            $this->cat_surf_env = $row["cat_surf_env"];
            $this->production = $row["production"];
            $this->caractere_env = $row["caractere_env"];
            $this->surf_enj = $row["surf_enj"];
            $this->res_min = $row["res_min"];
            $this->typo_gisement = $row["typo_gisement"];
            $this->meth_exp = $row["meth_exp"];
            $this->profondeur_max = $row["profondeur_max"];
            $this->profondeur_min = $row["profondeur_min"];
            $this->ouverture = $row["ouverture"];
            $this->deformation = $row["deformation"];
            $this->profondeur_ouvrage = $row["profondeur_ouvrage"];
            $this->pendage = $row["pendage"];
            $this->encaissage = $row["encaissage"];
            $this->recouvrement = $row["recouvrement"];
            $this->ouvrages = $row["ouvrages"];
            $this->nb_ouvrages = $row["nb_ouvrages"];
            $this->desordre = $row["desordre"];
            $this->depot = $row["depot"];
            $this->echelle = $row["echelle"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}