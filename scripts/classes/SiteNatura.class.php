<?php

/**
 * Description of SiteNatura
 *
 * @author ronan.vignard
 * @copyright 2012-07-24
 * @version 1.0
 */
class SiteNatura {
    /**
     * Sélectionne un site Natura 2000 par son identifiant
     * @global string $pdo
     * @param string $id_regional
     * @param int $id_type 
     */
    public function getSiteNaturaByIdRegionalIdType($id_regional,$id_type) {
        global $pdo;
        $sql_1 = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql_1)->fetch();
            $table = $row["table"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        try {
        $table_2 = $table."_data";
        $sql_2 = "SELECT * 
        FROM $table, $table_2
        WHERE $table.id_regional = '$id_regional'
        AND $table.id_regional = $table_2.id_regional ";
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        try {
            $row = $pdo->query($sql_2)->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->date_transmission = $row["date_transmission"];
            $this->date_designation = $row["date_designation"];
            $this->surf_sig_l93 = $row["surf_sig_l93"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne un opérateur par l'identifiant régional 
     * du site Natura
     * @global string $pdo
     * @param type $id_regional 
     */
    public function getOperateurByIdRegional($id_regional) {
        global $pdo;
        $table = "R_DOCOB_R52";
        $table_2 = "R_DOCOB_ORGANISMES_R52";
        
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_regional = '$id_regional' 
        AND $table.id_operateur = $table_2.id_organisme"; 
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_organisme = $row["id_organisme"];
            $this->sigle = $row["sigle"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne un structure animatrice par l'identifiant régional 
     * du site Natura
     * @global string $pdo
     * @param string $id_regional 
     */
    public function getStructureAnimatriceByIdRegional($id_regional) {
        global $pdo;
        $table = "R_DOCOB_R52";
        $table_2 = "R_DOCOB_ORGANISMES_R52";
        
        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE $table.id_regional = '$id_regional' 
        AND $table.id_structure_animatrice = $table_2.id_organisme"; 
        try {
            $row = $pdo->query($sql)->fetch();
            $this->id_organisme = $row["id_organisme"];
            $this->sigle = $row["sigle"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne les données d'un site Natura à partir de son 
     * identifiant régional
     * @global string $pdo
     * @param string $id_regional 
     */
    public function getDataByIdRegional($id_regional) {
        global $pdo;
        $sql = "SELECT * 
        FROM natura_biotop 
        WHERE SITECODE = '$id_regional'";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->QUALITY = nl2br($row["QUALITY"]);
            $this->VULNAR = nl2br($row["VULNAR"]);
            $this->CHARACT = nl2br($row["CHARACT"]);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

/**
 * Sélectionne les sites Natura par catégorie (marin, mixte, terrestre)
 * @global string $pdo
 * @param int $id_type
 * @param string $categorie
 * @return array 
 */
function getSitesNaturaByCategorie($id_type,$categorie) {
    global $pdo;
    if($id_type == "25"):
        $sql_2 = "(SELECT * FROM R_ZPS_R52 WHERE categorie = '$categorie' 
        GROUP BY id_regional) 
        UNION (SELECT *  FROM R_ZSC_R52  WHERE categorie = '$categorie' 
        GROUP BY id_regional)
        UNION (SELECT *  FROM R_SIC_R52  WHERE categorie = '$categorie' 
        GROUP BY id_regional) 
        ORDER BY id_regional ";
    else:
        $sql_1 = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql_1)->fetch();
            $table = $row["table"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        try {
        $sql_2 = "SELECT * 
        FROM $table
        WHERE categorie = '$categorie'
        AND id_type = '$id_type'
        GROUP BY id_regional 
        ORDER BY id_regional ";
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    endif;
    try {
        $sites_natura = $pdo->query($sql_2)->fetchAll();
        return $sites_natura;
        $this->id_regional = $sites_natura["id_regional"];
        $this->nom = $sites_natura["nom"];
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les amphibiens et reptiles présents sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getAmpbhibiensReptilesByIdRegional($id_regional) {
    global $pdo;
    $sql = "SELECT * 
    FROM natura_amprep 
    WHERE SITECODE = '$id_regional'
    GROUP BY SPECNUM
    ORDER BY SPECNUM"; 
    try {
        $amphibiens_reptiles = $pdo->query($sql)->fetchAll();
        return $amphibiens_reptiles;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

/**
 * Sélectionne les invertébrés présents sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getInvertebresByIdRegional($id_regional) {
    global $pdo;
    $sql = "SELECT * 
    FROM natura_invert 
    WHERE SITECODE = '$id_regional'
    GROUP BY SPECNUM
    ORDER BY SPECNUM"; 
    try {
        $invertebres = $pdo->query($sql)->fetchAll();
        return $invertebres;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

/**
 * Sélectionne les mammifères présents sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getMammiferesByIdRegional($id_regional) {
    global $pdo;
    $sql = "SELECT * 
    FROM natura_mammal 
    WHERE SITECODE = '$id_regional'
    GROUP BY SPECNUM
    ORDER BY SPECNUM"; 
    try {
        $mammiferes = $pdo->query($sql)->fetchAll();
        return $mammiferes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

/**
 * Sélectionne les plantes présentes sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getPlantesByIdRegional($id_regional) {
    global $pdo;
    $sql = "SELECT * 
    FROM natura_plant 
    WHERE SITECODE = '$id_regional'
    GROUP BY SPECNUM
    ORDER BY SPECNUM"; 
    try {
        $plantes = $pdo->query($sql)->fetchAll();
        return $plantes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

/**
 * Sélectionne les poissons présentes sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getPoissonsByIdRegional($id_regional) {
    global $pdo;
    $sql = "SELECT * 
    FROM natura_fishes 
    WHERE SITECODE = '$id_regional'
    GROUP BY SPECNUM
    ORDER BY SPECNUM"; 
    try {
        $poissons = $pdo->query($sql)->fetchAll();
        return $poissons;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

/**
 * Sélectionne les autres espèces présentes sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getAutresEspecesByIdRegional($id_regional) {
    global $pdo;
    $sql = "SELECT * 
    FROM natura_spec 
    WHERE SITECODE = '$id_regional'
    GROUP BY SPECNAME
    ORDER BY SPECNAME"; 
    try {
        $autres_especes = $pdo->query($sql)->fetchAll();
        return $autres_especes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

/**
 * Sélectionne les oiseaux présents sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param string $id_regional
 * @return array 
 */
function getOiseauxByIdRegional($id_regional) {
    global $pdo;
    $sql = "SELECT * 
    FROM natura_bird 
    WHERE SITECODE = '$id_regional'
    GROUP BY SPECNAME
    ORDER BY SPECNAME"; 
    try {
        $autres_especes = $pdo->query($sql)->fetchAll();
        return $autres_especes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

/**
 * Sélectionne les habitats présents sur le site Natura 2000 
 * par son identifiant régional
 * @global string $pdo
 * @param type $id_regional
 * @return type 
 */
function getHabitatsByIdRegional($id_regional) {
    global $pdo;
    $table = "natura_eur15";
    $table_2 = "natura_habit1";
    
    $sql = "SELECT * 
    FROM $table, $table_2 
    WHERE $table_2.SITECODE = '$id_regional' 
    AND $table_2.HBCDAX = $table.ID_EUR15";
    try {
        $habitats = $pdo->query($sql)->fetchAll();
        return $habitats;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}

?>