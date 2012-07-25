<?php

/**
 * Description of Table
 *
 * @author ronan.vignard
 */

class Table {
    
    public $table;
    
    public function name_table()
    {
        return $this->table;
    }
    
    
    
    /*public function getTypeZonageById() {
        global $pdo;
        $sql = "SELECT * 
        FROM R_TYPE_ZONAGE_R52 
        WHERE  id_type = '$id_type' ";
        try {
            $row = $pdo->query($sql)->fetch();
            $table = $row["table"];
            
            $table_2 = $table.'_data';
            
            $query = "SELECT * 
            FROM $table, $table_2  
            WHERE $table.id_regional = '$id_regional' 
            AND $table.id_regional = $table_2.id_regional"; 
            $row = $pdo->query($query)->fetch();
            
            
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }    */
}

?>