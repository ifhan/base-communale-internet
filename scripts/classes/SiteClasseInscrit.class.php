<?php

/**
 * Description of SiteClasseInscrit
 * Classe et fonctions concernant les sites classés et inscrits
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-27
 * @version 1.0
 */
class SiteClasseInscrit {
    
    /**
     * Sélectionne les données annexes d'un site classé ou inscrit
     * @param string $id_regional Identifiant régional du zonage
     */
    public function getSiteClasseInscritDataByIdRegional($id_regional) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM R_SITE_CLASSE_INSCRIT_R52_data 
        WHERE id_regional = :id_regional');
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_regional = $row["id_regional"];
            $this->nom = $row["nom"];
            $this->texte_protection = $row["texte_protection"];
            $this->url_texte = $row["url_texte"];
            $this->commentaires = nl2br($row["commentaires"]);
            $this->sources = nl2br($row["sources"]);
            $this->id_side = $row["id_side"];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les entités d'un site à partir de son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @return array 
 */
function getEntitesFromSiteByIdRegional($id_regional) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM R_SITE_CLASSE_INSCRIT_R52, R_SITE_CLASSE_INSCRIT_R52_data
    WHERE R_SITE_CLASSE_INSCRIT_R52.id_regional = :id_regional 
    AND R_SITE_CLASSE_INSCRIT_R52.id_sp = 
    R_SITE_CLASSE_INSCRIT_R52_data.id_sp
    GROUP BY R_SITE_CLASSE_INSCRIT_R52.id_sp
    ORDER BY R_SITE_CLASSE_INSCRIT_R52.id_entite');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
    try {
        $sql->execute();
        $entites = $sql->fetchAll();
        return $entites;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne les photographies d'un site à partir de son identifiant régional
 * @param string $id_regional Identifiant régional du zonage
 * @param int $id_type Identifiant du type de zonage
 * @return array 
 */
function getSiteClasseInscritPhotosByIdRegional($id_regional, $id_type) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * 
    FROM R_SITE_CLASSE_INSCRIT_R52_photos, R_SITE_CLASSE_INSCRIT_R52, 
    R_TYPE_ZONAGE_R52
    WHERE R_SITE_CLASSE_INSCRIT_R52_photos.id_regional = :id_regional
    AND R_TYPE_ZONAGE_R52.id_type = :id_type
    AND R_SITE_CLASSE_INSCRIT_R52_photos.id_regional = 
    R_SITE_CLASSE_INSCRIT_R52.id_regional');
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
    $sql->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql->execute();
        $site_photos = $sql->fetchAll();
        return $site_photos;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Sélectionne l'ensemble des sites classés et inscrit de la région
 * @return array 
 */
function getSitesClassesInscrits() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM R_SITE_CLASSE_INSCRIT_R52, 
    R_SITE_CLASSE_INSCRIT_R52_data
    WHERE R_SITE_CLASSE_INSCRIT_R52.id_sp = R_SITE_CLASSE_INSCRIT_R52_data.id_sp
    GROUP BY R_SITE_CLASSE_INSCRIT_R52.id_regional 
    ORDER BY R_SITE_CLASSE_INSCRIT_R52.id_regional');
    try {
        $sql->execute();
        $sites_classes_inscrits = $sql->fetchAll();
        return $sites_classes_inscrits;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
