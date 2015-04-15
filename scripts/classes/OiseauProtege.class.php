<?php

/**
 * Description of OiseauProtege
 * Classe et fonctions concernant les oiseaux protégés
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2014-04-15
 * @version 1.1
 */
class OiseauProtege {

}

/**
 * Sélectionne les oiseaux protégés par identifiant de l'article
 * @param type $id_article Identifiant de l'article
 * @return array
 */
function getOiseauxProtegesByIdArticle($id_article) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    if ($id_article !== "0"):
        $sql = $pdo->prepare('SELECT * FROM r_oiseaux_proteges_2009_france 
        WHERE id_article = :id_article
        ORDER BY id');
        $sql->bindParam(':id_article', $id_article, PDO::PARAM_INT, 1);
    elseif ($id_article == "0"):
        $sql = $pdo->prepare('SELECT * FROM r_oiseaux_proteges_2009_france 
        ORDER BY id');
    endif;
    try {
        $sql->execute();
        $oiseaux_proteges = $sql->fetchAll();
        return $oiseaux_proteges;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
