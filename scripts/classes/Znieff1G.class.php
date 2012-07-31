<?php

/**
 * Description of Znieff1G
 * Classe et fonctions concernant les Zones Naturelles d'Intérêt Faunistique et
 * Floristique (ZNIEFF) de première génération
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-23
 * @version 1.0
 */
class Znieff1G {
    public function getZnieff1GByIdRegional($id_regional,$id_type) {
        global $pdo;
        if($id_type==8):
            $table = R_ZNIEFF1_G1_R52;
            $table_2 = R_ZNIEFF1_G1_R52_data;
        elseif($id_type==9):
            $table = R_ZNIEFF2_G1_R52;
            $table_2 = R_ZNIEFF2_G1_R52_data;
        endif;
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_regional = $id_regional 
        AND $table.id_regional = $table_2.id_regional ";
        try {
            $row = $pdo->query($sql)->fetch();          
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->annee_description = $row["annee_description"];
            $this->annee_maj  = $row['annee_maj'];
            $this->type_zone  = $row['type_zone'];
            $this->altitude_min  = $row['altitude_min'];
            $this->altitude_max  = $row['altitude_max'];
            $this->surface  = $row['surface'];
            $this->commentaire_general  = nl2br($row['commentaire_general']);
            $this->sources  = $row['sources'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }
}

?>
