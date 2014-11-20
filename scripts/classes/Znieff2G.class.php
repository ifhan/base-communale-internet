<?php

/**
 * Description of Znieff2G
 * Classe et fonctions concernant les Zones Naturelles d'Intérêt Faunistique et
 * Floristique (ZNIEFF) de deuxième génération
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-20
 * @version 1.0
 */
class Znieff2G {

    /**
     * Sélectionne une ZNIEFF par son identifiant régional
     * @param varchar $id_regional Identifiant régional de la ZNIEFF 
     */
    public function getZnieff2GByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare("SELECT * FROM znieff_znieff, znieff_comment 
        WHERE znieff_znieff.NM_REGZN = :id_regional
        AND znieff_znieff.NM_SFFZN  = znieff_comment.NM_SFFZN");
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["NM_REGZN"];
            $this->id_national = $row["NM_SFFZN"];
            $this->nom = $row["LB_ZN"];
            $this->TY_ZONE = $row["TY_ZONE"];
            $this->ALT_MINI = $row["ALT_MINI"];
            $this->ALT_MAXI = $row["ALT_MAXI"];
            $this->SU_ZN = $row["SU_ZN"];
            $this->AN_DESCRIP = $row["AN_DESCRIP"];
            $this->AN_MAJ = $row["AN_MAJ"];
            $this->AN_SFFE = $row["AN_SFFE"];
            $this->TX_TYPO = $row["TX_TYPO"];
            $this->TX_GEO = $row["TX_GEO"];
            $this->TX_ACTH = $row["TX_ACTH"];
            $this->TX_STPRO = $row["TX_STPRO"];
            $this->TX_MESPRO = $row["TX_MESPRO"];
            $this->FG_HABITAT = $row["FG_HABITAT"];
            $this->FG_OISEAUX = $row["FG_OISEAUX"];
            $this->TX_FACT = $row["TX_FACT"];
            $this->CM_GENE = $row["CM_GENE"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Récupère le nombre d'espèces faunistiques prospectées par ZNIEFF
     * @param varchar $id_regional Identifiant régional de la ZNIEFF 
     */
    public function getProspectionZnieff($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $table = "znieff_znieff";
        $table_2 = "znieff_bilan";
        $sql = $pdo->prepare("SELECT * FROM $table, $table_2 
        WHERE NM_REGZN = :id_regional 
        AND $table.MS_BILAN = $table_2.MS_BILAN");
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
        try {
            $sql->execute();
            $prospection = $sql->fetch();
            /**
             * Faune 
             */
            $this->NB_PR_MAM = $prospection["NB_PR_MAM"];
            $this->NB_PR_OIS = $prospection["NB_PR_OIS"];
            $this->NB_PR_REP = $prospection["NB_PR_REP"];
            $this->NB_PR_AMP = $prospection["NB_PR_AMP"];
            $this->NB_PR_POI = $prospection["NB_PR_POI"];
            $this->NB_PR_INS = $prospection["NB_PR_INS"];
            $this->NB_PR_AUT = $prospection["NB_PR_AUT"];

            $this->NB_EP_MAM = $prospection["NB_EP_MAM"];
            $this->NB_EP_OIS = $prospection["NB_EP_OIS"];
            $this->NB_EP_REP = $prospection["NB_EP_REP"];
            $this->NB_EP_AMP = $prospection["NB_EP_AMP"];
            $this->NB_EP_POI = $prospection["NB_EP_POI"];
            $this->NB_EP_INS = $prospection["NB_EP_INS"];
            $this->NB_EP_AUT = $prospection["NB_EP_AUT"];

            $this->NB_RM_MAM = $prospection["NB_RM_MAM"];
            $this->NB_RM_OIS = $prospection["NB_RM_OIS"];
            $this->NB_RM_REP = $prospection["NB_RM_REP"];
            $this->NB_RM_AMP = $prospection["NB_RM_AMP"];
            $this->NB_RM_POI = $prospection["NB_RM_POI"];
            $this->NB_RM_INS = $prospection["NB_RM_INS"];
            $this->NB_RM_AUT = $prospection["NB_RM_AUT"];

            $this->NB_EE_MAM = $prospection["NB_EE_MAM"];
            $this->NB_EE_OIS = $prospection["NB_EE_OIS"];
            $this->NB_EE_REP = $prospection["NB_EE_REP"];
            $this->NB_EE_AMP = $prospection["NB_EE_AMP"];
            $this->NB_EE_POI = $prospection["NB_EE_POI"];
            $this->NB_EE_INS = $prospection["NB_EE_INS"];
            $this->NB_EE_AUT = $prospection["NB_EE_AUT"];

            $this->NB_AD_MAM = $prospection["NB_AD_MAM"];
            $this->NB_AD_OIS = $prospection["NB_AD_OIS"];
            $this->NB_AD_REP = $prospection["NB_AD_REP"];
            $this->NB_AD_AMP = $prospection["NB_AD_AMP"];
            $this->NB_AD_POI = $prospection["NB_AD_POI"];
            $this->NB_AD_INS = $prospection["NB_AD_INS"];
            $this->NB_AD_AUT = $prospection["NB_AD_AUT"];

            $this->NB_LA_MAM = $prospection["NB_LA_MAM"];
            $this->NB_LA_OIS = $prospection["NB_LA_OIS"];
            $this->NB_LA_REP = $prospection["NB_LA_REP"];
            $this->NB_LA_AMP = $prospection["NB_LA_AMP"];
            $this->NB_LA_POI = $prospection["NB_LA_POI"];
            $this->NB_LA_INS = $prospection["NB_LA_INS"];
            $this->NB_LA_AUT = $prospection["NB_LA_AUT"];

            $this->NB_ME_MAM = $prospection["NB_ME_MAM"];
            $this->NB_ME_OIS = $prospection["NB_ME_OIS"];
            $this->NB_ME_REP = $prospection["NB_ME_REP"];
            $this->NB_ME_AMP = $prospection["NB_ME_AMP"];
            $this->NB_ME_POI = $prospection["NB_ME_POI"];
            $this->NB_ME_INS = $prospection["NB_ME_INS"];
            $this->NB_ME_AUT = $prospection["NB_ME_AUT"];
            /**
             * Flore 
             */
            $this->NB_PR_PHA = $prospection["NB_PR_PHA"];
            $this->NB_PR_PTE = $prospection["NB_PR_PTE"];
            $this->NB_PR_BRY = $prospection["NB_PR_BRY"];
            $this->NB_PR_LIC = $prospection["NB_PR_LIC"];
            $this->NB_PR_CHA = $prospection["NB_PR_CHA"];
            $this->NB_PR_ALG = $prospection["NB_PR_ALG"];

            $this->NB_EP_PHA = $prospection["NB_EP_PHA"];
            $this->NB_EP_PTE = $prospection["NB_EP_PTE"];
            $this->NB_EP_BRY = $prospection["NB_EP_BRY"];
            $this->NB_EP_LIC = $prospection["NB_EP_LIC"];
            $this->NB_EP_CHA = $prospection["NB_EP_CHA"];
            $this->NB_EP_ALG = $prospection["NB_EP_ALG"];

            $this->NB_RM_PHA = $prospection["NB_RM_PHA"];
            $this->NB_RM_PTE = $prospection["NB_RM_PTE"];
            $this->NB_RM_BRY = $prospection["NB_RM_BRY"];
            $this->NB_RM_LIC = $prospection["NB_RM_LIC"];
            $this->NB_RM_CHA = $prospection["NB_RM_CHA"];
            $this->NB_RM_ALG = $prospection["NB_RM_ALG"];

            $this->NB_EE_PHA = $prospection["NB_EE_PHA"];
            $this->NB_EE_PTE = $prospection["NB_EE_PTE"];
            $this->NB_EE_BRY = $prospection["NB_EE_BRY"];
            $this->NB_EE_LIC = $prospection["NB_EE_LIC"];
            $this->NB_EE_CHA = $prospection["NB_EE_CHA"];
            $this->NB_EE_ALG = $prospection["NB_EE_ALG"];

            $this->NB_AD_PHA = $prospection["NB_AD_PHA"];
            $this->NB_AD_PTE = $prospection["NB_AD_PTE"];
            $this->NB_AD_BRY = $prospection["NB_AD_BRY"];
            $this->NB_AD_LIC = $prospection["NB_AD_LIC"];
            $this->NB_AD_CHA = $prospection["NB_AD_CHA"];
            $this->NB_AD_ALG = $prospection["NB_AD_ALG"];

            $this->NB_LA_PHA = $prospection["NB_LA_PHA"];
            $this->NB_LA_PTE = $prospection["NB_LA_PTE"];
            $this->NB_LA_BRY = $prospection["NB_LA_BRY"];
            $this->NB_LA_LIC = $prospection["NB_LA_LIC"];
            $this->NB_LA_CHA = $prospection["NB_LA_CHA"];
            $this->NB_LA_ALG = $prospection["NB_LA_ALG"];

            $this->NB_ME_PHA = $prospection["NB_ME_PHA"];
            $this->NB_ME_PTE = $prospection["NB_ME_PTE"];
            $this->NB_ME_BRY = $prospection["NB_ME_BRY"];
            $this->NB_ME_LIC = $prospection["NB_ME_LIC"];
            $this->NB_ME_CHA = $prospection["NB_ME_CHA"];
            $this->NB_ME_ALG = $prospection["NB_ME_ALG"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélection du commentaire sur les critères de délimitation d'une ZNIEFF
     * @param varchar $id_regional Identifiant régional de la ZNIEFF 
     */
    public function getCommentCriteresDelimitationZnieff($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $table = "znieff_znieff";
        $table_4 = "znieff_comment";
        $sql = $pdo->prepare("SELECT 
        DISTINCT $table.NM_SFFZN, $table.NM_REGZN, $table_4.CM_DELIM, 
        $table_4.NM_SFFZN 
        FROM $table, $table_4 
        WHERE $table.NM_REGZN = :id_regional
        AND  $table.NM_SFFZN = $table_4.NM_SFFZN");
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
        try {
            $sql->execute();
            $comment_znieff = $sql->fetch();
            $this->CM_DELIM = $comment_znieff["CM_DELIM"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne les photographies d'une ZNIEFF
     * @param varchar $id_regional Identifiant régional de la ZNIEFF
     * @param int $id_type 
     */
    public function getPhotosZnieff($id_regional, $id_type) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $table = "R_ZNIEFF_R52_photos";
        $table_2 = "znieff_znieff";
        $table_3 = "r_type_zonage_r52";
        $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3
        WHERE $table.NM_REGZN = :id_regional
        AND $table.NM_REGZN = $table_2.NM_REGZN
        AND $table_3.id_type = :id_type ");
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
        $sql->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
        try {
            $sql->execute();
            $znieff = $sql->fetch();
            $this->id_regional = $znieff["NM_REGZN"];
            $this->id_national = $znieff["NM_SFFZN"];
            $this->nom = $znieff["LB_ZN"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne l'embranchement, la classe ou l'ordre d'une espèce
     * @param string $id_ms_arbo_pere
     * @return array 
     */
    public function getEmbranchementsEspece($id_ms_arbo_pere) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare("SELECT MS_ARBO, LB_ESP, MS_ARBO_PERE, CD_ESP
        FROM znieff_espece
        WHERE MS_ARBO = :id_ms_arbo_pere");
        $sql->bindParam(':id_ms_arbo_pere', $id_ms_arbo_pere, PDO::PARAM_STR, 7);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->LB_ESP = $row["LB_ESP"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne le sous-règne, l'embranchement, le super embranchement, 
     * la classe ou la super classe de l'espèce
     * @param string $ms_arbo_pere
     * @return array 
     */
    function getSousRegnes($ms_arbo_pere) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare("SELECT LB_NIVEAU, MS_ARBO, LB_ESP, MS_ARBO_PERE
        FROM znieff_espece 
        WHERE MS_ARBO = :ms_arbo_pere
        AND LB_NIVEAU != 'RG'");
        $sql->bindParam(':ms_arbo_pere', $ms_arbo_pere, PDO::PARAM_STR, 7);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->LB_ESP = $row["LB_ESP"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne le nom vernaculaire d'une espèce floristique
     * @param type $CD_ESP
     * @return array 
     */
    public function getNomVernaculaireFlore($CD_ESP) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $table_3 = "znieff_espece";
        $table_5 = "R_ESPECES_DETERMINANTES_FLORE_R52";
        $table_6 = "R_ESPECES_DETERMINANTES_ZNIEFF_R52";
        $sql = $pdo->prepare("SELECT * FROM $table_3, $table_5, $table_6
        WHERE $table_3.CD_ESP = :CD_ESP
        AND $table_5.ID = $table_6.ID
        AND $table_3.CD_ESP = $table_6.CD_ESP
        AND $table_3.MS_ARBO NOT LIKE '4%'");
        $sql->bindParam(':CD_ESP', $CD_ESP, PDO::PARAM_STR, 9);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->NOM_VERNAC = $row["NOM_VERNAC"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Sélectionne le nom vernaculaire d'une espèce faunistique
     * @param type $CD_ESP
     * @return array 
     */
    public function getNomVernaculaireFaune($CD_ESP) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $table_3 = "znieff_espece";
        $table_5 = "R_ESPECES_DETERMINANTES_FAUNE_R52";
        $table_6 = "R_ESPECES_DETERMINANTES_ZNIEFF_R52";
        $sql = $pdo->prepare("SELECT * FROM $table_3, $table_5, $table_6
        WHERE $table_3.CD_ESP = :CD_ESP
        AND $table_3.CD_ESP = $table_5.CD_ESP
        AND $table_3.CD_ESP = $table_6.CD_ESP
        AND $table_3.MS_ARBO LIKE '4%'");
        $sql->bindParam(':CD_ESP', $CD_ESP, PDO::PARAM_STR, 9);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->NOM_VERNAC = $row["NOM_VERNAC"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
}

/**
 * Sélectionne les ZNIEFF concernées par un habitat de la nomenclature CORINE
 * @param varchar $id_corine
 * @return ARRAY 
 */
function getZnieffByIdCorine($id_corine) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_typologie";
    $table_2 = "znieff_znieff";
    $table_3 = "znieff_zni_typo";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3
    WHERE $table.CD_TYPO = :id_corine
    AND $table.CD_TYPO = $table_3.CD_TYPO
    AND $table_2.NM_SFFZN = $table_3.NM_SFFZN
    GROUP BY $table_2.NM_REGZN 
    ORDER BY $table_2.NM_REGZN");
    $sql->bindParam(':id_corine', $id_corine, PDO::PARAM_STR, 5);
    try {
        $sql->execute();
        $array_znieff = $sql->fetchAll();
        return $array_znieff;
        $count = $sql->fetchColumn() > 0;
        return $count;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des milieux d'une ZNIEFF par typologie
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @param char $fg_typo
 * @return array 
 */
function getMilieuxZnieff($id_regional, $fg_typo) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_typo";
    $table_3 = "znieff_typologie";
    $table_4 = "znieff_comment";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_4.TX_TYPO, $table_3.CD_TYPO, $table_3.LB_TYPO
    FROM $table, $table_2, $table_3, $table_4
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_TYPO = $table_2.CD_TYPO 
    AND $table.NM_REGZN = :id_regional
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    AND $table_2.FG_TYPO= :fg_typo
    ORDER BY $table_2.CD_TYPO");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    $sql->bindParam(':fg_typo', $fg_typo, PDO::PARAM_STR, 1);
    try {
        $sql->execute();
        $milieux_znieff = $sql->fetchAll();
        return $milieux_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection de la géomorphologie d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getGeomorphologieZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_geo";
    $table_3 = "znieff_geomorphologie";
    $table_4 = "znieff_comment";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_4.TX_GEO, $table_3.CD_GEO, $table_3.LB_GEO 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_GEO = $table_2.CD_GEO 
    AND $table.NM_REGZN = :id_regional
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_GEO ");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $geomorphologies_znieff = $sql->fetchAll();
        return $geomorphologies_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des activités humaines d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getActivitesHumainesZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_act";
    $table_3 = "znieff_act_humaine";
    $table_4 = "znieff_comment";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_4.TX_ACTH, $table_3.CD_ACTH, $table_3.LB_ACTH 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_ACTH = $table_2.CD_ACTH 
    AND $table.NM_REGZN = :id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_ACTH");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $activites_humaines_znieff = $sql->fetchAll();
        return $activites_humaines_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des statuts de propriété d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return type 
 */
function getStatutsProprieteZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_stat";
    $table_3 = "znieff_statut_propri";
    $table_4 = "znieff_comment";

    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_4.TX_STPRO, $table_3.CD_STPRO, $table_3.LB_STPRO 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_STPRO = $table_2.CD_STPRO 
    AND $table.NM_REGZN = :id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_STPRO");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $statuts_propriete_znieff = $sql->fetchAll();
        return $statuts_propriete_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des mesures de protection d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getMesuresProtectionZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_mpro";
    $table_3 = "znieff_mes_protection";
    $table_4 = "znieff_comment";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_4.TX_MESPRO, $table_3.CD_MPRO, $table_3.LB_MPRO 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_MPRO = $table_2.CD_MPRO 
    AND $table.NM_REGZN = :id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_MPRO");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $mesures_protection_znieff = $sql->fetchAll();
        return $mesures_protection_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les facteurs influençant l'évolution d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getFacteursEvolutionZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_fact";
    $table_3 = "znieff_facteur";
    $table_4 = "znieff_comment";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_4.TX_FACT, $table_3.CD_FACT, $table_3.LB_FACT 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_FACT = $table_2.CD_FACT 
    AND $table.NM_REGZN = :id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    GROUP BY $table_2.CD_FACT");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $facteurs_evolution_znieff = $sql->fetchAll();
        return $facteurs_evolution_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresInteretZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    $sql = $pdo->prepare("SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table.NM_REGZN = '$id_regional'
    AND  $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_2.CD_INTER = $table_3.CD_INTER");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $criteres_interet_znieff = $sql->fetchAll();
        return $criteres_interet_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt patrimonial d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresPatrimoniauxZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    $sql = $pdo->prepape("SELECT 
    DISTINCT $table_3.CD_INTER, $table_3.LB_INTER
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table_3.CD_INTER = $table_2.CD_INTER
    AND $table.NM_REGZN = :id_regional
    AND $table_3.CD_INTER <= '36'
    ORDER BY $table_2.CD_INTER");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $criteres_patrimoniaux_znieff = $sql->fetchAll();
        return $criteres_patrimoniaux_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt fonctionnel d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresFonctionnelsZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_3.CD_INTER, $table_3.LB_INTER
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table_3.CD_INTER = $table_2.CD_INTER
    AND $table.NM_REGZN = :id_regional
    AND $table_3.CD_INTER > '36'
    AND $table_3.CD_INTER <= '70'
    ORDER BY $table_2.CD_INTER");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $criteres_fonctionnels_znieff = $sql->fetchAll();
        return $criteres_fonctionnels_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt complémentaire d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresComplementairesZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table_3.CD_INTER, $table_3.LB_INTER
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table_3.CD_INTER = $table_2.CD_INTER
    AND $table.NM_REGZN = :id_regional
    AND $table_3.CD_INTER > '70'
    ORDER BY $table_2.CD_INTER");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $criteres_complementaires_znieff = $sql->fetchAll();
        return $criteres_complementaires_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère un tableau des espèces faunistiques et floristiques citées 
 * dans la ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF 
 * @param varchar $cd_esp Code de l'espèce
 * @return array 
 */
function getNbEspecesCitees($id_regional, $cd_esp) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    $sql = $pdo->prepare("SELECT DISTINCT * FROM $table, $table_3
    WHERE $table.NM_REGZN = :id_regional 
    AND $table.NM_SFFZN = $table_3.NM_SFFZN
    AND $table_3.CD_ESP LIKE :cd_esp");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    $sql->bindParam(':cd_esp', $cd_esp, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $nb_especes_citees = $sql->fetchAll();
        return $nb_especes_citees;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère un tableau des autres espèces faunistiques citées dans la ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getNbAutresEspecesFauneCitees($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    $sql = $pdo->prepare("SELECT DISTINCT * FROM $table, $table_3
    WHERE $table.NM_REGZN = :id_regional 
    AND $table.NM_SFFZN = $table_3.NM_SFFZN
    AND  ($table_3.CD_ESP LIKE '3%' 
    OR $table_3.CD_ESP LIKE '4%' 
    OR $table_3.CD_ESP LIKE '6%' 
    OR $table_3.CD_ESP LIKE '70%'
    OR $table_3.CD_ESP LIKE '50%' 
    OR $table_3.CD_ESP LIKE '51%' 
    OR $table_3.CD_ESP LIKE '52%' 
    OR $table_3.CD_ESP LIKE '53%'
    OR $table_3.CD_ESP LIKE '54%' 
    OR $table_3.CD_ESP LIKE '55%' 
    OR $table_3.CD_ESP LIKE '56%' 
    OR $table_3.CD_ESP LIKE '58%'
    OR $table_3.CD_ESP LIKE '59%')");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $nb_autres_especes_citees = $sql->fetchAll();
        return $nb_autres_especes_citees;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère un tableau des espèces phanéro. citées dans la ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getNbEspecesPhaneroCitees($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    $sql = $pdo->prepare("SELECT DISTINCT * FROM $table, $table_3 
    WHERE $table.NM_REGZN = :id_regional
    AND $table.NM_SFFZN = $table_3.NM_SFFZN
    AND ($table_3.CD_ESP LIKE '82%' OR $table_3.CD_ESP LIKE '83%')");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $nb_especes_phanero_citees = $sql->fetchAll();
        return $nb_especes_phanero_citees;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère un tableau des algues citées dans la ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getNbAlguesCitees($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    $sql = $pdo->prepare("SELECT DISTINCT * FROM $table, $table_3 
    WHERE $table.NM_REGZN = :id_regional 
    AND $table.NM_SFFZN = $table_3.NM_SFFZN
    AND ($table_3.CD_ESP LIKE '0%' OR $table_3.CD_ESP LIKE '1%')");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $nb_algues_citees = $sql->fetchAll();
        return $nb_algues_citees;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères de délimitation d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresDelimitationZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_delim";
    $table_3 = "znieff_delimitation";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table.NM_SFFZN, $table.NM_REGZN, $table_2.NM_SFFZN, 
    $table_2.CD_DELIM, $table_3.CD_DELIM, $table_3.LB_DELIM
    FROM $table, $table_2, $table_3 
    WHERE $table.NM_REGZN = :id_regional
    AND $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_2.CD_DELIM = $table_3.CD_DELIM 
    ORDER BY $table_2.CD_DELIM");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $criteres_delim_znieff = $sql->fetchAll();
        return $criteres_delim_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les liens avec d'autres ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getLiensAutresZnieff($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_zni";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2 
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table.NM_REGZN = :id_regional");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    try {
        $sql->execute();
        $liens_autres_znieff = $sql->fetchAll();
        return $liens_autres_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les sources d'une ZNIEFF
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @param char $ty_source Type de source
 * @return array 
 */
function getSourcesZnieff($id_regional, $ty_source) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_source";
    $table_3 = "znieff_sources";
    $sql = $pdo->prepare("SELECT DISTINCT $table_3.MS_SOURCE, $table_3.LB_SOURCE
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN  
    AND $table_3.MS_SOURCE = $table_2.MS_SOURCE 
    AND $table.NM_REGZN = :id_regional
    AND $table_3.TY_SOURCE = :ty_source");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    $sql->bindParam(':ty_source', $ty_source, PDO::PARAM_STR, 1);
    try {
        $sql->execute();
        $sources_znieff = $sql->fetchAll();
        return $sources_znieff;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les photographies d'une ZNIEFF
 * @param string $id_regional Identifiant régional
 * @param int $id_type Identifiant du type de zonage
 * @return array 
 */
function getZnieff2GPhotosByIdRegional($id_regional, $id_type) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "R_ZNIEFF_R52_photos";
    $table_2 = "znieff_znieff";
    $table_3 = "r_type_zonage_r52";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3 
    WHERE $table.NM_REGZN = :id_regional 
    AND $table.NM_REGZN = $table_2.NM_REGZN 
    AND $table_3.id_type = :id_type 
    ORDER BY $table.id_photo");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    $sql->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql->execute();
        $znieff2g_photos = $sql->fetchAll();
        return $znieff2g_photos;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les espèces confidentielles d'une ZNIEFF par son identifiant 
 * régional et le code FG_ESP (D, C ou A)
 * @param string $id_regional
 * @return array 
 */
function getEspecesByIdRegionalByFgEsp($id_regional,$fg_esp) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_liste_esp";
    $table_3 = "znieff_espece";
    $sql = $pdo->prepare("SELECT * 
    FROM ($table INNER JOIN $table_2 USING (NM_SFFZN)) 
    INNER JOIN $table_3 USING (CD_ESP)
    WHERE $table.NM_REGZN = :id_regional
    AND $table_2.FG_ESP = :fg_esp
    GROUP BY MS_ARBO
    ORDER BY MS_ARBO_PERE");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    $sql->bindParam(':fg_esp', $fg_esp, PDO::PARAM_STR, 1);
    try {
        $sql->execute();
        $especes = $sql->fetchAll();
        return $especes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

}

/**
 * Sélectionne les sources de la liste d'espèces pour les espèces déterminantes
 * ou les autres espèces
 * @param string $id_regional Identifiant régional du zonage
 * @param string $fg_esp
 * @return array 
 */
function getSourcesEspeces($id_regional, $fg_esp) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "znieff_znieff";
    $table_2 = "znieff_liste_esp";
    $table_3 = "znieff_espece";
    $table_4 = "znieff_sources";
    $sql = $pdo->prepare("SELECT 
    DISTINCT $table.NM_SFFZN, $table_2.NM_SFFZN, $table_2.CD_ESP, 
    $table_3.CD_ESP, $table_4.MS_SOURCE, $table.NM_REGZN, $table_2.FG_ESP, 
    $table_4.LB_SOURCE
    FROM $table_4, ($table INNER JOIN $table_2 USING (NM_SFFZN)) 
    INNER JOIN $table_3 USING (CD_ESP) 
    WHERE $table.NM_REGZN = :id_regional
    AND $table_2.FG_ESP = :fg_esp
    AND $table_2.MS_SOURCE = $table_4.MS_SOURCE 
    GROUP BY $table_4.MS_SOURCE");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    $sql->bindParam(':fg_esp', $fg_esp, PDO::PARAM_STR, 1);
    try {
        $sql->execute();
        $sources_especes = $sql->fetchAll();
        return $sources_especes;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
