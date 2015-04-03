<?php

/**
 * Description of Dta
 * Classe et fonctions concernant les Directives Territoriales
 * d'Aménagement (DTA)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-03
 * @version 1.1
 */
class Dta {
    
    /**
     * Sélectionne la DTA par son identifiant régional
     * @param int $id_regional Identifiant régional du zonage
     */
    public function getDtaByIdRegional($id_regional){
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_dta_r52
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->url_site = $row["url_site"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
}
