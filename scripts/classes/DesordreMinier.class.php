<?php

/**
 * Description of DesordreMinier
 * Classe et fonctions concernant les désordres miniers
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-01
 * @version 1.0
 */
class DesordreMinier {

    /**
     * Sélectionne un désordre minier par son identifiant régional
     * @param string $id_regional Identifiant régional du titre
     */
    public function getDesordreMinierByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_desordre_minier_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->type = $row["type"];
            $this->precision = $row["PRECISION"];
            $this->longueur = $row["longueur"];
            $this->largeur = $row["largeur"];            
            $this->surface = $row["surface"];
            $this->profondeur = $row["profondeur"];
            $this->volume = $row["volume"];
            $this->debit = $row["debit"];
            $this->annee = $row["annee"];
            $this->comment = $row["comment"];
            $this->enjeu = $row["enjeu"];
            $this->perturbation = $row["perturbation"];
            $this->terrain = $row["terrain"];
            $this->media = $row["media"];
            $this->odj_connu = $row["odj_connu"];
            $this->type_odj = $row["type_odj"];
            $this->travaux_connus = $row["travaux_connus"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}