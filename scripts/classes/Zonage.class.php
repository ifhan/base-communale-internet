<?php

/**
 * Description of Zonage
 * Classe et fonctions concernant l'ensemble des zonages d'inventaire et 
 * de protection réglementaire
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-15
 * @version 1.0
 */
class Zonage {

    /**
     * Sélectionne un type de zonage par son identifiant
     * @global type $pdo
     * @param int $id_type 
     */
    public function getTypeZonageByIdType($id_type) {
        global $pdo;
        $sql = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $this->type = $row['type'];
            $this->sigle = $row['sigle'];
            $this->table = $row['table'];
            $this->path = $row['path'];
            $this->map = $row['map'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne un type de zonage puis un zonage
     * @global type $pdo
     * @param int $id_type
     * @param string $id_regional 
     */
    public function getZonageByIdRegional($id_type, $id_regional) {
        global $pdo;
        $sql_1 = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql_1)->fetch();
            $this->table = $row["table"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        try {
            $sql_2 = "SELECT * 
            FROM $this->table
            WHERE id_regional = '$id_regional' ";
            $row = $pdo->query($sql_2)->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne un type de zonage puis la table _data correspondante
     * @global type $pdo
     * @param int $id_type
     * @param string $id_regional 
     */
    public function getZonageDataById($id_type, $id_regional) {
        global $pdo;
        $sql_1 = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql_1)->fetch();
            $this->table = $row["table"];
            $table_data = $this->table . "_data";
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        try {
            $sql_2 = "SELECT * 
            FROM $table_data 
            WHERE id_regional = '$id_regional' ";
            $row = $pdo->query($sql_2)->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->region = $row["region"];
            $this->url_fiche = $row["url_fiche"];
            $this->dreal = $row["dreal"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélection de l'ensemble des types de zonages
     * @global type $pdo 
     */
    public function getZonages() {
        global $pdo;
        $sql = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 ";
        try {
            $row = $pdo->query($sql)->fetch();

            $this->type = $row['type'];
            $this->table = $row['table'];
            $this->path = $row['path'];
            $this->map = $row['map'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne l'ensemble des zonages d'un département par l'identifiant 
 * du type de zonage et le code géographique du département
 * @global type $pdo
 * @param int $id_type Identifiant du type de zonage
 * @param int $id_dpt Identifiant du département
 * @return array 
 */
function getZonagesByIdTypeByIdDpt($id_type, $id_dpt) {
    global $pdo;
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = "SELECT * 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = '$id_type'";
    try {
        $row = $pdo->query($sql_1)->fetch();
        $table = $row["table"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour le département choisi 
     */
    $sql_2 = "SELECT * 
    FROM $table
    WHERE id_dpt = '$id_dpt' 
    GROUP BY id_regional 
    ORDER BY id_regional";
    try {
        $query = $pdo->query($sql_2);
        $zonages = $query->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages de la région par l'identifiant du type
 * de zonage
 * @global type $pdo
 * @param int $id_type Identifiant du type de zonage
 * @return string 
 */
function getZonagesByIdTypeByRegion($id_type) {
    global $pdo;
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = "SELECT * 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = '$id_type'";
    try {
        $row = $pdo->query($sql_1)->fetch();
        $table = $row["table"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour la région
     */
    $sql_2 = "SELECT * 
    FROM $table
    GROUP BY id_regional 
    ORDER BY id_regional";
    try {
        $query = $pdo->query($sql_2);
        $zonages = $query->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les thèmes des zonages présents sur une commune à partir du 
 * code géographique de la commune
 * @global string $pdo
 * @param int $id_commune
 * @param int $id_theme
 * @return array 
 */
function getThemesByIdCommune($id_commune) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_TYPE_ZONAGE_R52";
    $table_3 = "R_TYPE_THEME_R52";

    $sql = "SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table.id_commune = $id_commune
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    GROUP BY $table_3.id_theme 
    ORDER BY $table_3.id_theme";
    try {
        $query = $pdo->query($sql);
        $themes = $query->fetchAll();
        return $themes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les types de zonages des zonages présents sur une commune à
 * partir de le code géographique de la commune et de l'identifiant 
 * du thème
 * @global string $pdo
 * @param int $id_commune
 * @param int $id_theme
 * @return array 
 */
function getTypesZonagesByIdCommuneByIdTheme($id_commune, $id_theme) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_TYPE_ZONAGE_R52";
    $table_3 = "R_TYPE_THEME_R52";

    $sql = "SELECT * 
   FROM $table, $table_2, $table_3 
   WHERE $table.id_commune = $id_commune 
   AND $table_3.id_theme = $id_theme 
   AND $table.id_type = $table_2.id_type 
   AND $table_2.id_theme = $table_3.id_theme
   GROUP BY $table.id_type 
   ORDER BY $table.id_type";
    try {
        $query = $pdo->query($sql);
        $types_zonages = $query->fetchAll();
        return $types_zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages présents sur une commune par
 * l'identifiant du type de zonage et le code géographique de la commune
 * @global string $pdo
 * @param int $id_type Identifiant du type de zonage
 * @return string 
 */
function getZonagesByIdTypeByIdCommune($id_type, $id_commune) {
    global $pdo;
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = "SELECT * 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = '$id_type'";
    try {
        $row = $pdo->query($sql_1)->fetch();
        $table_3 = $row["table"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour la commune
     */
    $table = "R_ZONAGES_COMMUNES_R52";
    $sql_2 = "SELECT * 
    FROM $table, $table_3 
    WHERE $table.id_commune = $id_commune 
    AND $table.id_type = '$id_type'
    AND $table.id_regional = $table_3.id_regional
    GROUP BY $table.id_regional
    ORDER BY $table.id_regional";
    try {
        $query = $pdo->query($sql_2);
        $zonages = $query->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les thèmes des zonages présents sur un EPCI à partir de
 * l'identifiant de l'EPCI
 * @global string $pdo
 * @param int $id_commune
 * @param int $id_theme
 * @return array 
 */
function getThemesByIdEpci($id_epci) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_TYPE_ZONAGE_R52";
    $table_3 = "R_TYPE_THEME_R52";
    $table_4 = "R_EPCI_COMMUNES_R52";

    $sql = "SELECT * 
    FROM $table, $table_2, $table_3, $table_4
    WHERE $table_4.id_epci = $id_epci
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    AND $table_4.id_commune = $table.id_commune
    GROUP BY $table_3.id_theme 
    ORDER BY $table_3.id_theme";
    try {
        $query = $pdo->query($sql);
        $themes = $query->fetchAll();
        return $themes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les types de zonages des zonages présents sur un EPCI à
 * partir de l'identifiant de l'EPCI et de l'identifiant du thème
 * @global string $pdo
 * @param int $id_commune
 * @param int $id_theme
 * @return array 
 */
function getTypesZonagesByIdEpciByIdTheme($id_epci, $id_theme) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_TYPE_ZONAGE_R52";
    $table_3 = "R_TYPE_THEME_R52";
    $table_4 = "R_EPCI_COMMUNES_R52";

    $sql = "SELECT * 
   FROM $table, $table_2, $table_3, $table_4 
   WHERE $table_4.id_epci = $id_epci
   AND $table_3.id_theme = $id_theme 
   AND $table.id_type = $table_2.id_type 
   AND $table_2.id_theme = $table_3.id_theme
   AND $table_4.id_commune = $table.id_commune
   GROUP BY $table.id_type 
   ORDER BY $table.id_type";
    try {
        $query = $pdo->query($sql);
        $types_zonages = $query->fetchAll();
        return $types_zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages présents sur un EPCI par
 * l'identifiant du type de zonage et l'identifiant de l'EPCI
 * @global string $pdo
 * @param int $id_type Identifiant du type de zonage
 * @return string 
 */
function getZonagesByIdTypeByIdEpci($id_type, $id_epci) {
    global $pdo;
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = "SELECT * 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = '$id_type'";
    try {
        $row = $pdo->query($sql_1)->fetch();
        $table_3 = $row["table"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour l'EPCI
     */
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_EPCI_COMMUNES_R52";
    $sql_2 = "SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table_2.id_epci = $id_epci
    AND $table.id_type = '$id_type'
    AND $table.id_regional = $table_3.id_regional
    AND $table_2.id_commune = $table.id_commune
    GROUP BY $table.id_regional
    ORDER BY $table.id_regional";
    try {
        $query = $pdo->query($sql_2);
        $zonages = $query->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les thèmes des zonages présents sur un SCoT  à partir de
 * l'identifiant du SCoT
 * @global string $pdo
 * @param int $id_commune
 * @param int $id_theme
 * @return array 
 */
function getThemesByIdScot($id_scot) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_TYPE_ZONAGE_R52";
    $table_3 = "R_TYPE_THEME_R52";
    $table_4 = "R_SCOT_COMMUNES_R52";

    $sql = "SELECT * 
    FROM $table, $table_2, $table_3, $table_4
    WHERE $table_4.id_scot = $id_scot
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    AND $table_4.id_commune = $table.id_commune
    GROUP BY $table_3.id_theme 
    ORDER BY $table_3.id_theme";
    try {
        $query = $pdo->query($sql);
        $themes = $query->fetchAll();
        return $themes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les types de zonages des zonages présents sur un SCoT à
 * partir de l'identifiant du SCoT et de l'identifiant du thème
 * @global string $pdo
 * @param int $id_commune
 * @param int $id_theme
 * @return array 
 */
function getTypesZonagesByIdScotByIdTheme($id_scot, $id_theme) {
    global $pdo;
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_TYPE_ZONAGE_R52";
    $table_3 = "R_TYPE_THEME_R52";
    $table_4 = "R_SCOT_COMMUNES_R52";

    $sql = "SELECT * 
   FROM $table, $table_2, $table_3, $table_4 
   WHERE $table_4.id_scot = $id_scot
   AND $table_3.id_theme = $id_theme 
   AND $table.id_type = $table_2.id_type 
   AND $table_2.id_theme = $table_3.id_theme
   AND $table_4.id_commune = $table.id_commune
   GROUP BY $table.id_type 
   ORDER BY $table.id_type";
    try {
        $query = $pdo->query($sql);
        $types_zonages = $query->fetchAll();
        return $types_zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages présents sur une commune par
 * l'identifiant du type de zonage et le code géographique de la commune
 * @global string $pdo
 * @param int $id_type Identifiant du type de zonage
 * @return string 
 */
function getZonagesByIdTypeByIdScot($id_type, $id_scot) {
    global $pdo;
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = "SELECT * 
    FROM R_TYPE_ZONAGE_R52 
    WHERE id_type = '$id_type'";
    try {
        $row = $pdo->query($sql_1)->fetch();
        $table_3 = $row["table"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour le SCoT
     */
    $table = "R_ZONAGES_COMMUNES_R52";
    $table_2 = "R_SCOT_COMMUNES_R52";
    $sql_2 = "SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table_2.id_scot = $id_scot
    AND $table.id_type = '$id_type'
    AND $table.id_regional = $table_3.id_regional
    AND $table_2.id_commune = $table.id_commune
    GROUP BY $table.id_regional
    ORDER BY $table.id_regional";
    try {
        $query = $pdo->query($sql_2);
        $zonages = $query->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>