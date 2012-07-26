<?php
/**
 * Description of HabitatEur15
 *
 * @author ronan.vignard
 * @copyright 2012-06-20
 * @version 1.0
 */
class HabitatEur15 {
    public $id_eur15;
    public $lb_eur15;
   
    //Sélection de l'ensemble de la liste des habitats Natura 2000
    // (nomenclature EUR15)
    public function getHabitatsEur15() {
        global $pdo;
        $sql = "SELECT * 
        FROM natura_eur15"; 
        try {
            $habitats_eur15 = $pdo->query($sql)->fetchAll();
            
            return $habitats_eur15;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }    

    // Sélection d'un habitat par son identifiant
    public function getHabitatEur15ById($id_eur15) {
        global $pdo;
        $sql = "SELECT * 
        FROM natura_eur15 
        WHERE ID_EUR15 = '$id_eur15' "; 
        try {
            $row = $pdo->query($sql)->fetch();
            
            $this->id_eur15  = $row['ID_EUR15'];
            $this->lb_eur15  = $row['LB_EUR15'];
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

//Sélection de l'ensemble de la liste des habitats Natura 2000
// (nomenclature EUR15)
function getHabitatsEur15() {
    global $pdo;
    $sql = "SELECT * 
        FROM natura_eur15"; 
    try {
        $habitats_eur15 = $pdo->query($sql)->fetchAll();
        
        return $habitats_eur15;
        
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    } 
?>