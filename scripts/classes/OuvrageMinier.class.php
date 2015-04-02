<?php

/**
 * Description of OuvrageMinier
 * Classe et fonctions concernant les ouvrages miniers
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-01
 * @version 1.0
 */
class OuvrageMinier {

    /**
     * Sélectionne un ouvrage minier par son identifiant régional
     * @param string $id_regional Identifiant régional du titre
     */
    public function getOuvrageMinierByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_ouvrage_minier_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 4);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->id_site = $row["id_site"];
            $this->source = $row["source"];
            $this->z = $row["z"];
            $this->visibilite = $row["visibilite"];            
            $this->incertitude_position = $row["incertitude_position"];
            $this->nature = $row["nature"];
            $this->role_odj = $row["role_odj"];
            $this->date_fc = $row["date_fc"];
            $this->section = $row["section"];
            $this->diametre_largeur = $row["diametre_largeur"];
            $this->longueur_rectangle = $row["longueur_rectangle"];
            $this->hauteur = $row["hauteur"];
            $this->profondeur = $row["profondeur"];
            $this->longueur_galerie = $row["longueur_galerie"];
            $this->nb_recette = $row["nb_recette"];
            $this->profondeur_recette_1 = $row["profondeur_recette_1"];
            $this->etat_tete = $row["etat_tete"];
            $this->etat_corps = $row["etat_corps"];
            $this->revetement = $row["revetement"];
            $this->coupe_tech = $row["coupe_tech"];
            $this->coupe_geo = $row["coupe_geo"];
            $this->date_traitement = $row["date_traitement"];
            $this->nature_traitement = $row["nature_traitement"];
            $this->emergence = $row["emergence"];
            $this->accessibilite = $row["accessibilite"];
            $this->penetrabilite = $row["penetrabilite"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}