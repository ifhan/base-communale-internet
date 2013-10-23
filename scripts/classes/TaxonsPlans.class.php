<?php

/**
 * Description of TaxonsPlans
 * Classe et fonctions concernant les taxons des plans de conservations et les 
 * plans nationaux d'action en Pays de la Loire
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2013-10-23
 * @version 2.0
 */
class TaxonsPlans {
    /**
     * Sélectionne un taxon par son identifiant TAXREF
     * @param string $id_taxref Identifiant TAXREF de l'espèce
     */
    public function getTaxonByIdTaxref($id_taxref) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_taxons_plans_2012_r52 
        WHERE id_regional = :id_taxref');
        $sql->bindParam(':id_taxref', $id_taxref, PDO::PARAM_STR, 5);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row['id_regional'];
            $this->nom = $row['nom'];
            $this->NOM_VERNAC = $row['NOM_VERNAC'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
    
    /**
     * Sélectionne l'ensemble des taxons concernés par un plan 
     * national d'action en Pays de la Loire
     * @return array 
     */    
    function getTaxonsPNA() {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
                FROM r_taxons_plans_2012_r52 
                WHERE r_taxons_plans_2012_r52.TYPE_PLAN = "PNA"
                ORDER BY r_taxons_plans_2012_r52.id_regional');
        try {
            $sql->execute();
            $taxons = $sql->fetchAll();
            return $taxons;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    }
    
    /**
     * Sélectionne l'ensemble des taxons concernés par un plan de conservation 
     * régional en Pays de la Loire
     * @return array 
     */    
    function getTaxonsPCR() {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
                FROM r_taxons_plans_2012_r52 
                WHERE r_taxons_plans_2012_r52.TYPE_PLAN = "PCR"
                ORDER BY r_taxons_plans_2012_r52.id_regional');
        try {
            $sql->execute();
            $taxons = $sql->fetchAll();
            return $taxons;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne l'ensemble des taxons concernés par un plan de conservation 
     * local en Pays de la Loire
     * @return array 
     */    
    function getTaxonsPCL() {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
                FROM r_taxons_plans_2012_r52 
                WHERE r_taxons_plans_2012_r52.TYPE_PLAN = "PCL"
                ORDER BY r_taxons_plans_2012_r52.id_regional');
        try {
            $sql->execute();
            $taxons = $sql->fetchAll();
            return $taxons;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }    

?>
