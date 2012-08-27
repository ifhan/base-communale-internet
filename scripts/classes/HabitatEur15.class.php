<?php

/**
 * Description of HabitatEur15
 * Classe et fonction concernant les Habitats de la nomemclature EUR15
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-20
 * @version 1.0
 */
class HabitatEur15 {

    /**
     * Sélection d'un habitat par son identifiant
     * @param int $id_eur15 Identifiant EUR15 de l'habitat
     */
    public function getHabitatEur15ById($id_eur15) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM natura_eur15 
        WHERE ID_EUR15 = :id_eur15');
        $sql->bindParam(':id_eur15', $id_eur15, PDO::PARAM_STR, 11);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_eur15 = $row['ID_EUR15'];
            $this->lb_eur15 = $row['LB_EUR15'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélection de l'ensemble de la liste des habitats Natura 2000 
 * (nomenclature EUR15)
 * @global string $pdo Connexion à la base de données
 * @return array 
 */
function getHabitatsEur15() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM natura_eur15');
    $sql->execute();
    try {
        $habitats_eur15 = $sql->fetchAll();
        return $habitats_eur15;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
