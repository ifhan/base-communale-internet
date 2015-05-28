<?php

/**
 * Description of Pprm
 * Classe et fonctions concernant les Plans de Prévention des Risques Miniers (PPRM)
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-05-26
 * @version 1.0
 */
class Pprm {

    /**
     * Sélectionne un PPRM  par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getPprmByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_document_pprm_s_r52 
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 18);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->ETAT = $row["ETAT"];
            $this->DATEAPPRO = date("d/m/Y", strtotime($row['DATEAPPRO']));
            $this->DATEFINVAL = date("d/m/Y", strtotime($row['DATEFINVAL']));
            $this->MULTI_RISQU = $row["MULTI_RISQU"];
            $this->CODERISQUE = $row["CODERISQUE"];
            $this->NOMRISQUE = $row["NOMRISQUE"];
            $this->SITE_WEB = $row["SITE_WEB"];
            $this->URI_GASPAR = $row["URI_GASPAR"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

    /**
     * Sélectionne un PPRM  par son identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    function getTypeRisquePprmByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM n_pprm_multirisque_r52 
        WHERE ID_GASPAR = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 18);
        try {
            $sql->execute();
            $sql->execute();
            $types_risque = $sql->fetchAll();
            return $types_risque;

        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }