<?php

/**
 * Description of OiseauProtege
 *
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-26
 * @version 1.0
 */
class OiseauProtege {
    //put your code here
}

/**
 * Sélectionne les oiseaux protégés par identifiant de l'article
 * @global type $pdo
 * @param type $id_article
 * @return type 
 */
function getOiseauxProtegesByIdArticle($id_article) {
    global $pdo;
    if($id_article!=="0") {
        $sql = "SELECT * 
        FROM R_OISEAUX_PROTEGES_2009_FRANCE 
        WHERE id_article = $id_article 
        ORDER BY id";
    } else if($id_article=="0") {
        $sql = "SELECT * 
        FROM R_OISEAUX_PROTEGES_2009_FRANCE 
        ORDER BY id" ;
    }
    try {
        $oiseaux_proteges = $pdo->query($sql)->fetchAll();
        return $oiseaux_proteges;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>
