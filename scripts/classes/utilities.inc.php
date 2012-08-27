<?php

/**
 * Transforme un tableau multi-dimensionnel en objet
 * @param type $array
 * @return \stdClass|boolean 
 */
function arrayToObject($array) {
    if(!is_array($array)) {
        return $array;
    }
    
    $object = new stdClass();
    if (is_array($array) && count($array) > 0) {
      foreach ($array as $name=>$value) {
         $name = strtolower(trim($name));
         if (!empty($name)) {
            $object->$name = arrayToObject($value);
         }
      }
      return $object; 
    }
    else {
      return FALSE;
    }
}

/**
 * Calcule la taille du fichier et la convertit dans la bonen unité
 * @param string $filename Nom informatique du fichier
 */
function convertFilesize($filename) {
    $data = filesize($filename);
    if ($data < 1024):
        echo "$data";
    elseif ($data >= 1024 && $data < (1 << 20)):
        echo round(($data / 1024), 0) . " Ko";
    elseif ($data >= (1 << 20) && $data < (1 << 30)):
        echo round(($data / (1 << 20)), 2) . " Mo";
    else:
        echo round(($data / (1 << 30)), 2) . " Go";
    endif;
}

/**
 * Alterne les couleurs des lignes dans un tableau
 * @staticvar type $col
 * @return string 
 */
function switchColor() {
    static $col;
    $couleur1 = "#ffffff";
    $couleur2 = "#eeeeee";
    if ($col == $couleur1):
        $col = $couleur2;
    else:
        $col = $couleur1;
    endif;
    return $col;
}
