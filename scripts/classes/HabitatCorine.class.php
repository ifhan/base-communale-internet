<?php

/**
 * Description of HabitatCorine
 * Classe et fonction concernant les Habitats de la nomenclature CORINE
 * @author Ronan Vignard <ronan.vignard@developpement-durable.gouv.fr>
 * @copyright 2012-06-21
 * @version 1.0
 */
class HabitatCorine {

    /**
     * Sélection d'un habitat par son identifiant
     * @param string $id_corine Identifiant CORINE de l'habitat
     */
    public function getHabitatCorineById($id_corine) {
        $pdo = ConnectionFactory::getFactory()->getConnection();
        $sql = $pdo->prepare('SELECT * FROM znieff_typologie 
        WHERE CD_TYPO = :id_corine');
        $sql->bindParam(':id_corine', $id_corine, PDO::PARAM_STR, 5);
        $sql->execute();
        try {
            $row = $sql->fetch();
            $this->id_corine = $row['CD_TYPO'];
            $this->lb_corine = $row['LB_TYPO'];
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

/**
 * Sélection de l'ensemble des habitats ZNIEFF (nomenclature CORINE)
 * @return array 
 */
function getHabitatsCorine() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare('SELECT * FROM znieff_typologie');
    $sql->execute();
    try {
        $habitats_corine = $sql->fetchAll();
        return $habitats_corine;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 1
 * @return array 
 */
function getHabitatsCorineByCdTypo1() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '1%'");
    $sql->execute();
    try {
        $habitats_corine_1 = $sql->fetchAll();
        return $habitats_corine_1;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 2
 * @return array 
 */
function getHabitatsCorineByCdTypo2() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '2%'");
    $sql->execute();
    try {
        $habitats_corine_2 = $sql->fetchAll();
        return $habitats_corine_2;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 3
 * @return array 
 */
function getHabitatsCorineByCdTypo3() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '3%'");
    $sql->execute();
    try {
        $habitats_corine_3 = $sql->fetchAll();
        return $habitats_corine_3;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 4
 * @return array 
 */
function getHabitatsCorineByCdTypo4() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '4%'");
    $sql->execute();
    try {
        $habitats_corine_4 = $sql->fetchAll();
        return $habitats_corine_4;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 5
 * @return array 
 */
function getHabitatsCorineByCdTypo5() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '5%'");
    $sql->execute();
    try {
        $habitats_corine_5 = $sql->fetchAll();
        return $habitats_corine_5;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 6
 * @return array 
 */
function getHabitatsCorineByCdTypo6() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '6%'");
    $sql->execute();
    try {
        $habitats_corine_6 = $sql->fetchAll();
        return $habitats_corine_6;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 7
 * @return array 
 */
function getHabitatsCorineByCdTypo7() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '7%'");
    $sql->execute();
    try {
        $habitats_corine_7 = $sql->fetchAll();
        return $habitats_corine_7;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

/**
 * Récupère les habitats CORINE du thème 8
 * @return array 
 */
function getHabitatsCorineByCdTypo8() {
    $pdo = ConnectionFactory::getFactory()->getConnection();
    $sql = $pdo->prepare("SELECT * FROM znieff_typologie 
    WHERE CD_TYPO LIKE '8%'");
    $sql->execute();
    try {
        $habitats_corine_8 = $sql->fetchAll();
        return $habitats_corine_8;
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
