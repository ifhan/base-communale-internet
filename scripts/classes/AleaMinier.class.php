<?php

/**
 * Description of AleaMinier
 * Classe et fonctions concernant les aléas miniers
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-01
 * @version 1.0
 */
class AleaMinier {

    /**
     * Sélectionne un aléa minier par son identifiant régional
     * @param string $id_regional Identifiant régional du titre
     */
    public function getAleaMinierByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_alea_minier_pac_s_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->id_dpt = $row["id_dpt"];            
            $this->nom = $row["nom"];
            $this->type = $row["type"];
            $this->niveau = $row["niveau"];
            $this->audit_alea = $row["audit_alea"];
            $this->etude = $row["etude"];            
            $this->surf_alea = $row["surf_alea"];
            $this->remarques = $row["remarques"];
            $this->pac = $row["pac"];
            $this->date_pac = $row["date_pac"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}