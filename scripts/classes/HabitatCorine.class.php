<?php
/**
 * Description of HabitatCorine
 *
 * @author ronan.vignard
 * @copyright 2012-06-21
 * @version 1.0
 */

class HabitatCorine {
    public $id_corine;
    public $lb_corine;

    /**
     * Sélection de l'ensemble des habitats ZNIEFF (nomenclature CORINE)
     * @global type $pdo
     * @return array 
     */
    public function getHabitatsCorine() {
        global $pdo;
        $sql = "SELECT * 
        FROM natura_eur15"; 
        try {
            $habitats_corine = $pdo->query($sql)->fetchAll();           
            return $habitats_corine;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }    

    /**
     * Sélection d'un habitat par son identifiant
     * @global type $pdo
     * @param string $id_corine
     */
    public function getHabitatCorineById($id_corine) {
        global $pdo;
        $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO = '$id_corine' "; 
        try {
            $row = $pdo->query($sql)->fetch();          
            $this->id_corine  = $row['CD_TYPO'];
            $this->lb_corine  = $row['LB_TYPO'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

/**
 * Sélection de l'ensemble des habitats ZNIEFF (nomenclature CORINE)
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorine() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie "; 
    try {
        $habitats_corine = $pdo->query($sql)->fetchAll();       
        return $habitats_corine;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 1
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo1() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '1%' "; 
    try {
        $habitats_corine_1 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_1;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 2
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo2() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '2%' "; 
    try {
        $habitats_corine_2 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_2;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 3
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo3() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '3%' "; 
    try {
        $habitats_corine_3 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_3;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 4
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo4() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '4%' "; 
    try {
        $habitats_corine_4 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_4;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 5
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo5() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '5%' "; 
    try {
        $habitats_corine_5 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_5;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 6
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo6() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '6%' "; 
    try {
        $habitats_corine_6 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_6;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 7
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo7() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '7%' "; 
    try {
        $habitats_corine_7 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_7;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

/**
 * Récupère les habitats CORINE du thème 8
 * @global type $pdo
 * @return array 
 */
function getHabitatsCorineByCdTypo8() {
    global $pdo;
    $sql = "SELECT * 
        FROM znieff_typologie 
        WHERE CD_TYPO LIKE '8%' "; 
    try {
        $habitats_corine_8 = $pdo->query($sql)->fetchAll();       
        return $habitats_corine_8;       
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
} 

?>