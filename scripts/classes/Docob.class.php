<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Docob
 *
 * @author ronan.vignard
 */
class Docob {
    public function getDocob() {
        global $pdo;
        $sql = "(SELECT * FROM R_ZPS_R52_data) 
        UNION  (SELECT * FROM R_ZSC_R52_data)
        UNION(SELECT * FROM R_SIC_R52_data)
        ORDER BY id_regional";
        try {
            $docobs = array();
            while ($docobs = $pdo->query($sql)->fetchAll()) {
                $docobs[] = $row;
            }
            return $docobs;
            $this->id_regional = $docobs["id_regional"];
            $this->nom = $docobs["nom"];
            $this->id_article = $docobs["id_article"];
            $this->id_type = $docobs["id_type"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
   
}

function getDocob() {
        global $pdo;        
        $sql = "(SELECT * FROM R_ZPS_R52_data) 
            UNION  (SELECT * FROM R_ZSC_R52_data) 
            UNION(SELECT * FROM R_SIC_R52_data) 
            ORDER BY id_regional";
        try {
            $docob = $pdo->query($sql)->fetchAll();
            return $docob;
            $this->id_regional = $docob["id_regional"];
            $this->nom = $docob["nom"];
            $this->id_article = $docob["id_article"];
            $this->id_type = $docob["id_type"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }

?>