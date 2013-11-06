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
     * Sélectionne l'ensemble des taxons concernés par un plan d'action
     * ou de conservation en Pays de la Loire
     * @param string $type_plan Type de plan
     * @param string $type_sp Type de l'espèce (Faune/Flore)
     * @return array 
     */    
    function getTaxons($type_plan,$type_sp) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
                FROM r_taxons_plans_2012_r52 
                WHERE r_taxons_plans_2012_r52.TYPE_PLAN = :type_plan
                AND r_taxons_plans_2012_r52.TYPE_SP = :type_sp
                ORDER BY r_taxons_plans_2012_r52.id_regional');
        $sql->bindParam(':type_plan', $type_plan, PDO::PARAM_STR, 3);
        $sql->bindParam(':type_sp', $type_sp, PDO::PARAM_STR, 5);
        try {
            $sql->execute();
            $taxons = $sql->fetchAll();
            return $taxons;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    }  

?>
