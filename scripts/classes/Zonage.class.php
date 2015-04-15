<?php

/**
 * Description of Zonage
 * Classe et fonctions concernant l'ensemble des zonages d'inventaire et 
 * de protection réglementaire
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2014-04-14
 * @version 1.1
 */
class Zonage {

    /**
     * Sélectionne un type de zonage par son identifiant
     * @param int $id_type Identifiant du type de zonage
     */
    public function getTypeZonageByIdType($id_type) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_type_zonage_r52 
        WHERE id_type = :id_type');
        $sql->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->type = $row['type'];
            $this->sigle = $row['sigle'];
            $this->table = $row['table'];
            $this->primary_key = $row['primary_key'];
            $this->fact_sheet = $row['fact_sheet'];
            $this->path = $row['path'];
            $this->map_carmen = $row['map_carmen'];
            $this->map_sigloire = $row['map_sigloire'];
            $this->layer = $row['layer'];
            $this->url_presentation = $row['url_presentation'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne un type de zonage puis un zonage
     * @param int $id_type Identifiant du type de zonage
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getZonageByIdRegional($id_type, $id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql_1 = $pdo->prepare('SELECT * FROM r_type_zonage_r52 
        WHERE id_type = :id_type');
        $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);   
        try {
            $sql_1->execute();
            $row = $sql_1->fetch();
            $this->table = $row["table_name"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        $sql_2 = $pdo->prepare("SELECT * FROM $this->table
        WHERE id_regional = :id_regional ");
        $sql_2->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql_2->execute();
            $row = $sql_2->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne un type de zonage puis la table _data correspondante
     * @param int $id_type Identifiant du type de zonage
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getZonageDataById($id_type, $id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql_1 = $pdo->prepare('SELECT * FROM r_type_zonage_r52 
        WHERE id_type = :id_type');
        $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
        try {
            $sql_1->execute();
            $row = $sql_1->fetch();
            $this->table = $row["table_name"];
            $table_data = $this->table . "_data";
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        $sql_2 = $pdo->prepare("SELECT * FROM $table_data 
        WHERE id_regional = :id_regional");
        $sql_2->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);    
        try {
            $sql_2->execute();
            $row = $sql_2->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélection de l'ensemble des types de zonages
     */
    public function getZonages() {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_type_zonage_r52');   
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->type = $row['type'];
            $this->table = $row['table'];
            $this->path = $row['path'];
            $this->map_carmen = $row['map_carmen'];
            $this->map_sigloire = $row['map_sigloire'];
            $this->layer = $row['layer'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne un objet par son sigle
     * @param string $sigle Sigle de l'objet ou du zonage
     */
    public function getZonageBySigle($sigle) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM r_type_zonage_r52 
        WHERE sigle = :sigle');
        $sql->bindParam(':sigle', $sigle, PDO::PARAM_INT, 7);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->type = $row['type'];
            $this->sigle = $row['sigle'];
            $this->table = $row['table'];
            $this->path = $row['path'];
            $this->map_carmen = $row['map_carmen'];
            $this->map_sigloire = $row['map_sigloire'];
            $this->layer = $row['layer'];
            $this->url_presentation = $row['url_presentation'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne l'ensemble des zonages d'un département par l'identifiant 
 * du type de zonage et le code géographique du département
 * @param int $id_type Identifiant du type de zonage
 * @param int $id_dpt Identifiant du département
 * @return array 
 */
function getZonagesByIdTypeByIdDpt($id_type, $id_dpt) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = $pdo->prepare('SELECT * FROM r_type_zonage_r52 
    WHERE id_type = :id_type');
    $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql_1->execute();
        $row = $sql_1->fetch();
        $table = $row["table_name"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour le département choisi 
     */
    $sql_2 = $pdo->prepare("SELECT * FROM $table
    WHERE id_dpt = :id_dpt 
    GROUP BY id_regional 
    ORDER BY id_regional");
    $sql_2->bindParam(':id_dpt', $id_dpt, PDO::PARAM_INT, 2);
    try {
        $sql_2->execute();
        $zonages = $sql_2->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages de la région par l'identifiant du type
 * de zonage
 * @param int $id_type Identifiant du type de zonage
 * @return array 
 */
function getZonagesByIdTypeByRegion($id_type) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = $pdo->prepare('SELECT * FROM r_type_zonage_r52 
    WHERE id_type = :id_type');
    $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql_1->execute();
        $row = $sql_1->fetch();
        $table = $row["table_name"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour la région
     */
    $sql_2 = $pdo->prepare("SELECT * FROM $table
    GROUP BY id_regional 
    ORDER BY id_regional");
    try {
        $sql_2->execute();
        $zonages = $sql_2->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les thèmes des zonages présents sur une commune à partir du 
 * code géographique de la commune et de l'identifiant de la rubrique
 * @param int $id_commune Code géographique de la commune
 * @param int $id_rub Identifiant de la rubrique
 * @return array 
 */
function getThemesByIdCommuneIdRubrique($id_commune,$id_rub) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "r_zonages_communes_r52";
    $table_2 = "r_type_zonage_r52";
    $table_3 = "r_type_theme_r52";
    $table_4 = "r_type_rubrique_r52";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3, $table_4 
    WHERE $table.id_commune = :id_commune
    AND $table.id_type = $table_2.id_type
    AND $table_2.id_theme = $table_3.id_theme
    AND $table_2.id_rub = $table_4.id_rub
    AND $table_4.id_rub = :id_rub
    GROUP BY $table_3.id_theme 
    ORDER BY $table_3.id_theme");
    $sql->bindParam(':id_commune', $id_commune, PDO::PARAM_INT, 5);
    $sql->bindParam(':id_rub', $id_rub, PDO::PARAM_INT, 2);
    try {
        $sql->execute();
        $themes = $sql->fetchAll();
        return $themes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les types de zonages des zonages présents sur une commune à
 * partir de le code géographique de la commune et de l'identifiant 
 * du thème
 * @param int $id_commune Code géographique de la commune
 * @param int $id_theme Identifiant du thème du zonage
 * @return array 
 */
function getTypesZonagesByIdCommuneByIdTheme($id_commune, $id_theme) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "r_zonages_communes_r52";
    $table_2 = "r_type_zonage_r52";
    $table_3 = "r_type_theme_r52";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3 
    WHERE $table.id_commune = :id_commune 
    AND $table_3.id_theme = :id_theme 
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    GROUP BY $table.id_type 
    ORDER BY $table.id_type");
    $sql->bindParam(':id_commune', $id_commune, PDO::PARAM_INT, 5);
    $sql->bindParam(':id_theme', $id_theme, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $types_zonages = $sql->fetchAll();
        return $types_zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages présents sur une commune par
 * l'identifiant du type de zonage et le code géographique de la commune
 * @param int $id_type Identifiant du type de zonage
 * @param int $id_commune Code géographique de la commune
 * @return array 
 */
function getZonagesByIdTypeByIdCommune($id_type, $id_commune) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = $pdo->prepare("SELECT * FROM r_type_zonage_r52 
    WHERE id_type = :id_type");
    $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql_1->execute();
        $row = $sql_1->fetch();
        $table_3 = $row["table_name"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour la commune
     */
    $table = "r_zonages_communes_r52";
    $sql_2 = $pdo->prepare("SELECT * FROM $table, $table_3 
    WHERE $table.id_commune = :id_commune 
    AND $table.id_type = :id_type
    AND $table.id_regional = $table_3.id_regional
    GROUP BY $table.id_regional
    ORDER BY $table.id_regional");
    $sql_2->bindParam(':id_commune', $id_commune, PDO::PARAM_INT, 5);
    $sql_2->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3); 
    try {
        $sql_2->execute();
        $zonages = $sql_2->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les thèmes des zonages présents sur un EPCI à partir de
 * l'identifiant de l'EPCI
 * @param int $id_commune Code géographique de la commune
 * @return array 
 */
function getThemesByIdEpci($id_epci) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "r_zonages_communes_r52";
    $table_2 = "r_type_zonage_r52";
    $table_3 = "r_type_theme_r52";
    $table_4 = "r_epci_communes_r52";
    $sql = $pdo->prepare("SELECT * 
    FROM $table, $table_2, $table_3, $table_4
    WHERE $table_4.id_epci = :id_epci
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    AND $table_4.id_commune = $table.id_commune
    GROUP BY $table_3.id_theme 
    ORDER BY $table_3.id_theme");
    $sql->bindParam(':id_epci', $id_epci, PDO::PARAM_STR, 3);
    try {
        $sql->execute();
        $themes = $sql->fetchAll();
        return $themes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les types de zonages des zonages présents sur un EPCI à
 * partir de l'identifiant de l'EPCI et de l'identifiant du thème
 * @param int $id_commune Code géographique de la commune
 * @param int $id_theme Identifiant du thème du zonage
 * @return array 
 */
function getTypesZonagesByIdEpciByIdTheme($id_epci, $id_theme) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "r_zonages_communes_r52";
    $table_2 = "r_type_zonage_r52";
    $table_3 = "r_type_theme_r52";
    $table_4 = "r_epci_communes_r52";
    $sql = $pdo->prepare("SELECT * 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.id_epci = :id_epci
    AND $table_3.id_theme = :id_theme 
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    AND $table_4.id_commune = $table.id_commune
    GROUP BY $table.id_type 
    ORDER BY $table.id_type");
    $sql->bindParam(':id_epci', $id_epci, PDO::PARAM_STR, 3);
    $sql->bindParam(':id_theme', $id_theme, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $types_zonages = $sql->fetchAll();
        return $types_zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages présents sur un EPCI par
 * l'identifiant du type de zonage et l'identifiant de l'EPCI
 * @param int $id_type Identifiant du type de zonage
 * @return string 
 */
function getZonagesByIdTypeByIdEpci($id_type, $id_epci) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = $pdo->prepare("SELECT * 
    FROM r_type_zonage_r52 
    WHERE id_type = :id_type");
    $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3); 
    try {
        $sql_1->execute();
        $row = $sql_1->fetch();
        $table_3 = $row["table_name"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour l'EPCI
     */
    $table = "r_zonages_communes_r52";
    $table_2 = "r_epci_communes_r52";
    $sql_2 = $pdo->prepare("SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table_2.id_epci = :id_epci
    AND $table.id_type = :id_type
    AND $table.id_regional = $table_3.id_regional
    AND $table_2.id_commune = $table.id_commune
    GROUP BY $table.id_regional
    ORDER BY $table.id_regional");
    $sql_2->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3); 
    $sql_2->bindParam(':id_epci', $id_epci, PDO::PARAM_STR, 3);
    try {
        $sql_2->execute();
        $zonages = $sql_2->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les thèmes des zonages présents sur un SCoT  à partir de
 * l'identifiant du SCoT et de l'identifiant de la rubrique
 * @param int $id_scot Identifiant SUDOCUH du SCoT
 * @param int $id_rub Identifiant de la rubrique 
 * @return array 
 */
function getThemesByIdScotIdRubrique($id_scot,$id_rub) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "r_zonages_communes_r52";
    $table_2 = "r_type_zonage_r52";
    $table_3 = "r_type_theme_r52";
    $table_4 = "r_scot_communes_r52";
    $table_5 = "r_type_rubrique_r52";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3, $table_4, $table_5
    WHERE $table_4.id_scot = :id_scot
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    AND $table_4.id_commune = $table.id_commune
    AND $table_2.id_rub = $table_5.id_rub
    AND $table_5.id_rub = :id_rub
    GROUP BY $table_3.id_theme 
    ORDER BY $table_3.id_theme");
    $sql->bindParam(':id_scot', $id_scot, PDO::PARAM_STR, 5);
    $sql->bindParam(':id_rub', $id_rub, PDO::PARAM_INT, 2);    
    try {
        $sql->execute();
        $themes = $sql->fetchAll();
        return $themes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les types de zonages des zonages présents sur un SCoT à
 * partir de l'identifiant du SCoT et de l'identifiant du thème
 * @param int $id_commune Code géographique de la commune
 * @param int $id_theme Identifiant du thème du zonage
 * @return array 
 */
function getTypesZonagesByIdScotByIdTheme($id_scot, $id_theme) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "r_zonages_communes_r52";
    $table_2 = "r_type_zonage_r52";
    $table_3 = "r_type_theme_r52";
    $table_4 = "r_scot_communes_r52";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.id_scot = :id_scot
    AND $table_3.id_theme = :id_theme 
    AND $table.id_type = $table_2.id_type 
    AND $table_2.id_theme = $table_3.id_theme
    AND $table_4.id_commune = $table.id_commune
    GROUP BY $table.id_type 
    ORDER BY $table.id_type");
    $sql->bindParam(':id_scot', $id_scot, PDO::PARAM_STR, 2);
    $sql->bindParam(':id_theme', $id_theme, PDO::PARAM_STR, 2);
    try {
        $sql->execute();
        $types_zonages = $sql->fetchAll();
        return $types_zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des zonages présents sur une commune par
 * l'identifiant du type de zonage et le code géographique de la commune
 * @param int $id_type Identifiant du type de zonage
 * @return array 
 */
function getZonagesByIdTypeByIdScot($id_type, $id_scot) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    /**
     * Sélectionne la table d'un zonage à partir de son identifiant 
     */
    $sql_1 = $pdo->prepare("SELECT * FROM r_type_zonage_r52 
    WHERE id_type = :id_type");
    $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql_1->execute();
        $row = $sql_1->fetch();
        $table_3 = $row["table_name"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /**
     * Retourne l'ensemble des zonages concernés pour le SCoT
     */
    $table = "r_zonages_communes_r52";
    $table_2 = "r_scot_communes_r52";
    $sql_2 = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3 
    WHERE $table_2.id_scot = :id_scot
    AND $table.id_type = :id_type
    AND $table.id_regional = $table_3.id_regional
    AND $table_2.id_commune = $table.id_commune
    GROUP BY $table.id_regional
    ORDER BY $table.id_regional");
    $sql_2->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    $sql_2->bindParam(':id_scot', $id_scot, PDO::PARAM_STR, 2);
    try {
        $sql_2->execute();
        $zonages = $sql_2->fetchAll();
        return $zonages;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
