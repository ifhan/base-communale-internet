<?php

/**
 * Description of OiseauProtege
 *
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-07-26
 * @version 1.0
 */
class OiseauProtege {

}

/**
 * Sélectionne les oiseaux protégés par identifiant de l'article
 * @global type $pdo Connexion à la base de données
 * @param type $id_article Identifiant de l'article
 * @return array
 */
function getOiseauxProtegesByIdArticle($id_article) {
    // $pdo = Connection::getConnection();
    $pdo = ConnectionFactory::getFactory()->getConnection();
    if ($id_article !== "0"):
        $sql = $pdo->prepare('SELECT * 
        FROM R_OISEAUX_PROTEGES_2009_FRANCE 
        WHERE id_article = :id_article
        ORDER BY id');
        $sql->bindParam(':id_article', $id_article, PDO::PARAM_INT, 1);
    elseif ($id_article == "0"):
        $sql = $pdo->prepare('SELECT * 
        FROM R_OISEAUX_PROTEGES_2009_FRANCE 
        ORDER BY id');
    endif;
    $sql->execute();
    try {
        $oiseaux_proteges = $sql->fetchAll();
        return $oiseaux_proteges;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
