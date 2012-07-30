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
    public $NM_REGZN;
    public $NM_SFFZN;
    public $LB_ZN;
    
    /**
     * Sélectionne une ZNIEFF par son identifiant régional
     * @global string $pdo Connexion à la base de données
     * @param varchar $id_regional Identifiant régional de la ZNIEFF 
     */
    public function getZnieff2GByIdRegional($id_regional){
        global $pdo;
        $sql = "SELECT * 
        FROM znieff_znieff, znieff_comment 
        WHERE znieff_znieff.NM_REGZN = $id_regional
        AND znieff_znieff.NM_SFFZN  = znieff_comment.NM_SFFZN ";
        try {
            $row = $pdo->query($sql)->fetch();          
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
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }
    
    /**
     * Récupère le nombre d'espèces faunistiques prospectées par ZNIEFF
     * @global string $pdo Connexion à la base de données
     * @param varchar $id_regional Identifiant régional de la ZNIEFF 
     */
    public function getProspectionZnieff($id_regional) {
        global $pdo;
        $table = "znieff_znieff";
        $table_2 = "znieff_bilan";

        $sql = "SELECT * 
        FROM $table, $table_2 
        WHERE NM_REGZN = $id_regional 
        AND $table.MS_BILAN = $table_2.MS_BILAN";
        try {
            $prospection = $pdo->query($sql)->fetch();          
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
     * @global string $pdo Connexion à la base de données
     * @param varchar $id_regional Identifiant régional de la ZNIEFF 
     */
    public function getCommentCriteresDelimitationZnieff($id_regional) {
        global $pdo;
        $table = "znieff_znieff";
        $table_4 = "znieff_comment";

        $sql = "SELECT 
        DISTINCT $table.NM_SFFZN, $table.NM_REGZN, $table_4.CM_DELIM, 
        $table_4.NM_SFFZN 
        FROM $table, $table_4 
        WHERE $table.NM_REGZN = '$id_regional' 
        AND  $table.NM_SFFZN = $table_4.NM_SFFZN ";
        try {
            $comment_znieff = $pdo->query($sql)->fetch();      
            $this->CM_DELIM = $comment_znieff["CM_DELIM"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    /**
     * Sélectionne les photographies d'une ZNIEFF
     * @global string $pdo Connexion à la base de données
     * @param varchar $id_regional Identifiant régional de la ZNIEFF
     * @param int $id_type 
     */
    public function getPhotosZnieff($id_regional,$id_type) {
        global $pdo;
        $table = "R_ZNIEFF_R52_photos";
        $table_2 = "znieff_znieff";
        $table_3 = "R_TYPE_ZONAGE_R52";
        
        $sql = "SELECT * 
        FROM $table, $table_2, $table_3
        WHERE $table.NM_REGZN = '$id_regional' 
        AND $table.NM_REGZN = $table_2.NM_REGZN
        AND $table_3.id_type = $id_type "; 
        try {
            $znieff = $pdo->query($sql)->fetch();      
            $this->id_regional = $znieff["NM_REGZN"];
            $this->id_national = $znieff["NM_SFFZN"];
            $this->nom = $znieff["LB_ZN"];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }
}

/**
 * Sélectionne les ZNIEFF concernées par un habitat de la nomenclature CORINE
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_corine
 * @return ARRAY 
 */
function getZnieffByIdCorine($id_corine) {
    global $pdo;		
    $table = "znieff_typologie";
    $table_2 = "znieff_znieff";
    $table_3 = "znieff_zni_typo";
    
    $sql = "SELECT * 
    FROM $table, $table_2, $table_3
    WHERE $table.CD_TYPO = '$id_corine' 
    AND $table.CD_TYPO = $table_3.CD_TYPO
    AND $table_2.NM_SFFZN = $table_3.NM_SFFZN
    GROUP BY $table_2.NM_REGZN 
    ORDER BY $table_2.NM_REGZN";
    try {
        $query = $pdo->query($sql);
        $array_znieff = $query->fetchAll();
        return $array_znieff;
        $count = $sql->fetchColumn() > 0;
        return $count;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}


/**
 * Sélection des milieux d'une ZNIEFF par typologie
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @param char $fg_typo
 * @return array 
 */
function getMilieuxZnieff($id_regional,$fg_typo) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_typo";
    $table_3 = "znieff_typologie";
    $table_4 = "znieff_comment";
    
    $sql = "SELECT 
    DISTINCT $table_4.TX_TYPO, $table_3.CD_TYPO, $table_3.LB_TYPO
    FROM $table, $table_2, $table_3, $table_4
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_TYPO = $table_2.CD_TYPO 
    AND $table.NM_REGZN = $id_regional
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    AND $table_2.FG_TYPO= '$fg_typo'
    ORDER BY $table_2.CD_TYPO" ;
    try {
        $query = $pdo->query($sql);
        $milieux_znieff = $query->fetchAll();
        return $milieux_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection de la géomorphologie d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getGeomorphologieZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_geo";
    $table_3 = "znieff_geomorphologie";
    $table_4 = "znieff_comment";
    
    $sql = "SELECT 
    DISTINCT $table_4.TX_GEO, $table_3.CD_GEO, $table_3.LB_GEO 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_GEO = $table_2.CD_GEO 
    AND $table.NM_REGZN = $id_regional
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_GEO ";
    try {
        $query = $pdo->query($sql);
        $geomorphologies_znieff = $query->fetchAll();
        return $geomorphologies_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des activités humaines d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getActivitesHumainesZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_act";
    $table_3 = "znieff_act_humaine";
    $table_4 = "znieff_comment";
    
    $sql = "SELECT 
    DISTINCT $table_4.TX_ACTH, $table_3.CD_ACTH, $table_3.LB_ACTH 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_ACTH = $table_2.CD_ACTH 
    AND $table.NM_REGZN = $id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_ACTH" ;
    try {
        $query = $pdo->query($sql);
        $activites_humaines_znieff = $query->fetchAll();
        return $activites_humaines_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des statuts de propriété d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return type 
 */
function getStatutsProprieteZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_stat";
    $table_3 = "znieff_statut_propri";
    $table_4 = "znieff_comment";
    
    $sql = "SELECT 
    DISTINCT $table_4.TX_STPRO, $table_3.CD_STPRO, $table_3.LB_STPRO 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table_4.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_STPRO = $table_2.CD_STPRO 
    AND $table.NM_REGZN = $id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_STPRO" ;
    try {
        $query = $pdo->query($sql);
        $statuts_propriete_znieff = $query->fetchAll();
        return $statuts_propriete_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélection des mesures de protection d'une ZNIEFF
 * @global string $pdo
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getMesuresProtectionZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_mpro";
    $table_3 = "znieff_mes_protection";
    $table_4 = "znieff_comment";
    
    $sql = "SELECT 
    DISTINCT $table_4.TX_MESPRO, $table_3.CD_MPRO, $table_3.LB_MPRO 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_MPRO = $table_2.CD_MPRO 
    AND $table.NM_REGZN = $id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    ORDER BY $table_2.CD_MPRO" ;
    try {
        $query = $pdo->query($sql);
        $mesures_protection_znieff = $query->fetchAll();
        return $mesures_protection_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}
/**
 * Sélectionne les facteurs influençant l'évolution d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getFacteursEvolutionZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_fact";
    $table_3 = "znieff_facteur";
    $table_4 = "znieff_comment";
    
    $sql = "SELECT 
    DISTINCT $table_4.TX_FACT, $table_3.CD_FACT, $table_3.LB_FACT 
    FROM $table, $table_2, $table_3, $table_4 
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_3.CD_FACT = $table_2.CD_FACT 
    AND $table.NM_REGZN = $id_regional 
    AND $table.NM_SFFZN  = $table_4.NM_SFFZN 
    GROUP BY $table_2.CD_FACT";
    try {
        $query = $pdo->query($sql);
        $facteurs_evolution_znieff = $query->fetchAll();
        return $facteurs_evolution_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresInteretZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    
    $sql = "SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table.NM_REGZN = '$id_regional'
    AND  $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_2.CD_INTER = $table_3.CD_INTER ";
    try {
        $query = $pdo->query($sql);
        $criteres_interet_znieff = $query->fetchAll();
        return $criteres_interet_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt patrimonial d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresPatrimoniauxZnieff($id_regional){
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    
    $sql = "SELECT 
    DISTINCT $table_3.CD_INTER, $table_3.LB_INTER
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table_3.CD_INTER = $table_2.CD_INTER
    AND $table.NM_REGZN = $id_regional
    AND $table_3.CD_INTER <= '36'
    ORDER BY $table_2.CD_INTER" ;
    try {
        $query = $pdo->query($sql);
        $criteres_patrimoniaux_znieff = $query->fetchAll();
        return $criteres_patrimoniaux_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt fonctionnel d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresFonctionnelsZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    
    $sql = "SELECT 
    DISTINCT $table_3.CD_INTER, $table_3.LB_INTER
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table_3.CD_INTER = $table_2.CD_INTER
    AND $table.NM_REGZN = $id_regional
    AND $table_3.CD_INTER > '36'
    AND $table_3.CD_INTER <= '70'
    ORDER BY $table_2.CD_INTER" ;
    try {
        $query = $pdo->query($sql);
        $criteres_fonctionnels_znieff = $query->fetchAll();
        return $criteres_fonctionnels_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les critères d'intérêt complémentaire d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresComplementairesZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_int";
    $table_3 = "znieff_interet";
    
    $sql = "SELECT 
    DISTINCT $table_3.CD_INTER, $table_3.LB_INTER
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table_3.CD_INTER = $table_2.CD_INTER
    AND $table.NM_REGZN = $id_regional
    AND $table_3.CD_INTER > '70'
    ORDER BY $table_2.CD_INTER" ;
    try {
        $query = $pdo->query($sql);
        $criteres_complementaires_znieff = $query->fetchAll();
        return $criteres_complementaires_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}


/**
 * Récupère un tableau des espèces faunistiques et floristiques citées 
 * dans la ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF 
 * @param varchar $cd_esp Code de l'espèce
 * @return array 
 */
function getNbEspecesCitees($id_regional,$cd_esp) {
    global $pdo;
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    
    $sql = "SELECT 
    DISTINCT * 
    FROM $table, $table_3
    WHERE $table.NM_REGZN = $id_regional 
    AND $table.NM_SFFZN = $table_3.NM_SFFZN
    AND $table_3.CD_ESP LIKE '$cd_esp'";
    try {
        $query = $pdo->query($sql);
        $nb_especes_citees = $query->fetchAll();
        return $nb_especes_citees;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère un tableau des autres espèces faunistiques citées dans la ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getNbAutresEspecesFauneCitees($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    
    $sql = "SELECT 
    DISTINCT * 
    FROM $table, $table_3
    WHERE $table.NM_REGZN = $id_regional 
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
    OR $table_3.CD_ESP LIKE '59%')";
    try {
        $query = $pdo->query($sql);
        $nb_autres_especes_citees = $query->fetchAll();
        return $nb_autres_especes_citees;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère un tableau des espèces phanéro. citées dans la ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getNbEspecesPhaneroCitees($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    
    $sql = "SELECT 
    DISTINCT * 
    FROM $table, $table_3 
    WHERE $table.NM_REGZN = $id_regional
    AND $table.NM_SFFZN = $table_3.NM_SFFZN
    AND  ($table_3.CD_ESP LIKE '82%' OR $table_3.CD_ESP LIKE '83%')";
    try {
        $query = $pdo->query($sql);
        $nb_especes_phanero_citees = $query->fetchAll();
        return $nb_especes_phanero_citees;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère un tableau des algues citées dans la ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getNbAlguesCitees($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_3 = "znieff_liste_esp";
    
    $sql = "SELECT 
    DISTINCT * 
    FROM $table, $table_3 
    WHERE $table.NM_REGZN = $id_regional 
    AND $table.NM_SFFZN = $table_3.NM_SFFZN
    AND  ($table_3.CD_ESP LIKE '0%' OR $table_3.CD_ESP LIKE '1%')";
    try {
        $query = $pdo->query($sql);
        $nb_algues_citees = $query->fetchAll();
        return $nb_algues_citees;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 *
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getCriteresDelimitationZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_delim";
    $table_3 = "znieff_delimitation";
    
    $sql = "SELECT 
    DISTINCT $table.NM_SFFZN, $table.NM_REGZN, $table_2.NM_SFFZN, 
    $table_2.CD_DELIM, $table_3.CD_DELIM, $table_3.LB_DELIM
    FROM $table, $table_2, $table_3 
    WHERE $table.NM_REGZN = '$id_regional' 
    AND $table.NM_SFFZN  = $table_2.NM_SFFZN 
    AND $table_2.CD_DELIM = $table_3.CD_DELIM 
    ORDER BY $table_2.CD_DELIM";
    try {
        $query = $pdo->query($sql);
        $criteres_delim_znieff = $query->fetchAll();
        return $criteres_delim_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les liens avec d'autres ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @return array 
 */
function getLiensAutresZnieff($id_regional) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_zni";
    
    $sql = "SELECT * 
    FROM $table, $table_2 
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN
    AND $table.NM_REGZN = '$id_regional' ";
    try {
        $query = $pdo->query($sql);
        $liens_autres_znieff = $query->fetchAll();
        return $liens_autres_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les sources d'une ZNIEFF
 * @global string $pdo Connexion à la base de données
 * @param varchar $id_regional Identifiant régional de la ZNIEFF
 * @param char $ty_source Type de source
 * @return array 
 */
function getSourcesZnieff($id_regional,$ty_source) {
    global $pdo;
    $table = "znieff_znieff";
    $table_2 = "znieff_zni_source";
    $table_3 = "znieff_sources";
    
    $sql = "SELECT 
    DISTINCT $table_3.MS_SOURCE, $table_3.LB_SOURCE
    FROM $table, $table_2, $table_3
    WHERE $table.NM_SFFZN  = $table_2.NM_SFFZN  
    AND $table_3.MS_SOURCE = $table_2.MS_SOURCE 
    AND $table.NM_REGZN = '$id_regional'
    AND $table_3.TY_SOURCE = '$ty_source' ";
    try {
        $query = $pdo->query($sql);
        $sources_znieff = $query->fetchAll();
        return $sources_znieff;
    } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
    }
}

function getZnieff2GPhotosByIdRegional($id_regional,$id_type){
    global $pdo;
    $table = "R_ZNIEFF_R52_photos";
    $table_2 = "znieff_znieff";
    $table_3 = "R_TYPE_ZONAGE_R52";
    
    $sql = "SELECT * 
    FROM $table, $table_2, $table_3 
    WHERE $table.NM_REGZN = '$id_regional' 
    AND $table.NM_REGZN = $table_2.NM_REGZN 
    AND $table_3.id_type = $id_type 
    ORDER BY $table.id_photo ";
    try {
        $znieff2g_photos = $pdo->query($sql)->fetchAll();
        return $znieff2g_photos;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
?>