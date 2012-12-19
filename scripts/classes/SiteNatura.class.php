<?php

/**
 * Description of SiteNatura
 * Classe et fonctions concernant les sites Natura 2000 des directives Oiseaux
 * et Habitats
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-24
 * @version 1.0
 */
class SiteNatura {

    /**
     * Sélectionne un site Natura 2000 par son identifiant
     * @param string $id_regional Identifiant régional du zonage
     * @param int $id_type Identifiant du type de zonage
     */
    public function getSiteNaturaByIdRegionalIdType($id_regional, $id_type) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql_1 = $pdo->prepare('SELECT * FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = :id_type');
        $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
        try {
            $sql_1->execute();
            $row = $sql_1->fetch();
            $table = $row["table"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        $sql_2 = $pdo->prepare("SELECT * FROM $table
        WHERE id_regional = :id_regional");
        $sql_2->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql_2->execute();
            $row = $sql_2->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->date_transmission = date("d/m/Y", strtotime($row['date_transmission']));
            $this->date_designation = date("d/m/Y", strtotime($row['date_designation']));
            $this->surf_sig_l93 = $row["surf_sig_l93"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne un opérateur par l'identifiant régional 
     * du site Natura
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getOperateurByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_DOCOB_R52, R_DOCOB_ORGANISMES_R52
        WHERE R_DOCOB_R52.id_regional = :id_regional
        AND R_DOCOB_R52.id_operateur = R_DOCOB_ORGANISMES_R52.id_organisme');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_INT, 11);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_organisme = $row["id_organisme"];
            $this->sigle = $row["sigle"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne un structure animatrice par l'identifiant régional 
     * du site Natura
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getStructureAnimatriceByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * 
        FROM R_DOCOB_R52, R_DOCOB_ORGANISMES_R52 
        WHERE R_DOCOB_R52.id_regional = :id_regional
        AND R_DOCOB_R52.id_structure_animatrice = R_DOCOB_ORGANISMES_R52.id_organisme');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_INT, 11);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_organisme = $row["id_organisme"];
            $this->sigle = $row["sigle"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne les données d'un site Natura à partir de son 
     * identifiant régional
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getDataByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM natura_biotop 
        WHERE SITECODE = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_INT, 11);
        try {
            $sql->execute();
            $row = $sql->fetch();
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
 * @param int $id_type Identifiant du type de zonage
 * @param string $categorie Identifiant de la catégorie du zonage
 * @return array 
 */
function getSitesNaturaByCategorie($id_type, $categorie) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    if ($id_type == "25"):
        $sql_2 = $pdo->prepare('(SELECT * FROM R_ZPS_R52 
        WHERE categorie = :categorie
        GROUP BY id_regional) 
        UNION (SELECT * FROM R_ZSC_R52 
        WHERE categorie = :categorie
        GROUP BY id_regional)
        UNION (SELECT * FROM R_SIC_R52 
        WHERE categorie = :categorie
        GROUP BY id_regional) 
        ORDER BY id_regional');
        $sql_2->bindParam(':categorie', $categorie, PDO::PARAM_STR, 10);
    else:
        $sql_1 = $pdo->prepare('SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE id_type = :id_type');
        $sql_1->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
        try {
            $sql_1->execute();
            $row = $sql_1->fetch();
            $table = $row["table"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        } 
        $sql_2 = $pdo->prepare("SELECT * FROM $table
        WHERE categorie = :categorie
        AND id_type = :id_type
        GROUP BY id_regional 
        ORDER BY id_regional");
        $sql_2->bindParam(':categorie', $categorie, PDO::PARAM_STR, 10);
        $sql_2->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    endif;
    try {
        $sql_2->execute();
        $sites_natura = $sql_2->fetchAll();
        return $sites_natura;
        $this->id_regional = $sites_natura["id_regional"];
        $this->nom = $sites_natura["nom"];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les amphibiens et reptiles présents sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getAmpbhibiensReptilesByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_amprep 
    WHERE SITECODE = :id_regional
    GROUP BY SPECNUM
    ORDER BY SPECNUM');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $amphibiens_reptiles = $sql->fetchAll();
        return $amphibiens_reptiles;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les invertébrés présents sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getInvertebresByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_invert 
    WHERE SITECODE = :id_regional
    GROUP BY SPECNUM
    ORDER BY SPECNUM');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $invertebres = $sql->fetchAll();
        return $invertebres;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les mammifères présents sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getMammiferesByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_mammal
    WHERE SITECODE = :id_regional
    GROUP BY SPECNUM
    ORDER BY SPECNUM');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $mammiferes = $sql->fetchAll();
        return $mammiferes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les plantes présentes sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getPlantesByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_plant
    WHERE SITECODE = :id_regional
    GROUP BY SPECNUM
    ORDER BY SPECNUM');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $plantes = $sql->fetchAll();
        return $plantes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les poissons présentes sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getPoissonsByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_fishes
    WHERE SITECODE = :id_regional
    GROUP BY SPECNUM
    ORDER BY SPECNUM');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $poissons = $sql->fetchAll();
        return $poissons;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les autres espèces présentes sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getAutresEspecesByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_spec
    WHERE SITECODE = :id_regional
    GROUP BY SPECNUM
    ORDER BY SPECNUM');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $autres_especes = $sql->fetchAll();
        return $autres_especes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les oiseaux présents sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getOiseauxByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_bird
    WHERE SITECODE = :id_regional
    GROUP BY SPECNUM
    ORDER BY SPECNUM');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $oiseaux = $sql->fetchAll();
        return $oiseaux;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les habitats présents sur le site Natura 2000 
 * par son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return type 
 */
function getHabitatsByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM natura_eur15, natura_habit1 
    WHERE natura_habit1.SITECODE = :id_regional
    AND natura_habit1.HBCDAX = natura_eur15.ID_EUR15');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 11);
    try {
        $sql->execute();
        $habitats = $sql->fetchAll();
        return $habitats;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
