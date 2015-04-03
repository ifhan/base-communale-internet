<?php

/**
 * Description of ZnieffIp
 * Classe et fonctions concernant les Zones Naturelles d'Intérêt Faunistique et
 * Floristique (ZNIEFF) de l'Inventaire Permanent
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2015-04-03
 * @version 2.1
 */
class ZnieffIp {

    /**
     * Sélectionne une ZNIEFF de l'Inventaire permanent par son 
     * identifiant régional et l'identifiant du type de zonage 
     * @param string $id_regional Identifiant régional du zonage
     * @param int $id_type Identifiant du type de zonage
     */
    public function getZnieffIpByIdRegional($id_regional, $id_type) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        if($id_type==10):
            $sql = $pdo->prepare('SELECT * FROM n_znieff1_r52
            WHERE n_znieff1_r52.id_regional = :id_regional');
        elseif($id_type==11):
            $sql = $pdo->prepare('SELECT * FROM n_znieff2_r52
            WHERE n_znieff2_r52.id_regional = :id_regional');
        endif;
        $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 10);
        try {
            $sql->execute();
            $row = $sql->fetch();
            $this->id_dpt = $row["id_dpt"];
            $this->id_regional = $row["id_regional"];
            $this->id_national = $row["id_national"];
            $this->nom = $row["nom"];
            $this->surf_sig_l93 = $row['surf_sig_l93'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélectionne les photographies d'une ZNIEFF
 * @param string $id_regional Identifiant régional
 * @param int $id_type Identifiant du type de zonage
 * @return array 
 */
function getZnieffIpPhotosByIdRegional($id_regional, $id_type) {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $table = "r_znieff_r52_photos";
    if($id_type==10):
        $table_2 = "n_znieff1_r52";
    elseif($id_type==11):
        $table_2 = "n_znieff2_r52";
    endif;
    $table_3 = "r_type_zonage_r52";
    $sql = $pdo->prepare("SELECT * FROM $table, $table_2, $table_3 
    WHERE $table.id_regional = :id_regional 
    AND $table.id_regional = $table_2.id_regional 
    AND $table_3.id_type = :id_type 
    ORDER BY $table.id_photo");
    $sql->bindParam(':id_regional', $id_regional, PDO::PARAM_STR, 8);
    $sql->bindParam(':id_type', $id_type, PDO::PARAM_INT, 3);
    try {
        $sql->execute();
        $znieff_ip_photos = $sql->fetchAll();
        return $znieff_ip_photos;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
