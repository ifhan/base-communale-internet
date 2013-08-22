<?php

/**
 * Description of Znieff1G
 * Classe et fonctions concernant les Zones Naturelles d'Intérêt Faunistique et
 * Floristique (ZNIEFF) de l'Inventaire Permanent
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-10-05
 * @version 1.0
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
        if ($id_type == 34):
            $sql = $pdo->prepare('SELECT * FROM R_ZNIEFF1_IP_R52
            WHERE R_ZNIEFF1_IP_R52.id_regional = :id_regional');
        elseif ($id_type == 35):
            $sql = $pdo->prepare('SELECT * FROM R_ZNIEFF2_IP_R52
            WHERE R_ZNIEFF2_IP_R52.id_regional = :id_regional');
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
