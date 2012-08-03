<?php

/**
 * Retourne la chaîne passée en paramètre dans un tableau de mots en 
 * conservant l'ordre de la chaîne
 * @param type $string
 * @return type 
 */
function split_words($string) {
    $retour = array();
    $delimiteurs = " .!?,:(){}[]%\/";
    $tok = strtok($string, " ");
    while (strlen(join(" ", $retour)) != strlen($string)) {
        array_push($retour, $tok);
        $tok = strtok($delimiteurs);
    }
    return array_non_empty($retour);
}

/**
 * Supprime les entrées vides du tableau
 * @param type $array
 * @return array 
 */
function array_non_empty($array) {
    $retour = array();
    foreach ($array as $a) {
        if ((!empty($a)) && (strlen($a) >= 3)) {
            array_push($retour, trim($a));
        }
    }
    return $retour;
}

/**
 * Gestion centralisée des messages d'erreurs
 * @param type $niveau
 * @param type $message 
 */
function gestionnaire_erreurs($niveau, $message) {

    /*
     * Affiche simplement un message
     */
    if ($niveau == 2) {
        echo "<em>";
        echo "Le fichier n'existe pas ou le nom du fichier ne correspond pas.";
        echo "</em>";
    }
}

/**
 * Calcule la taille du fichier
 * @param type $filename 
 */
function ConvertirTaille($filename) {
    $data = filesize($filename);
    if ($data < 1024)
        echo "$data";
    elseif ($data >= 1024 && $data < (1 << 20))
        echo round(($data / 1024), 0) . " Ko";
    elseif ($data >= (1 << 20) && $data < (1 << 30))
        echo round(($data / (1 << 20)), 2) . " Mo";
    else
        echo round(($data / (1 << 30)), 2) . " Go";
}

/**
 * Alterne les couleurs des lignes dans un tableau
 * @staticvar type $col
 * @return string 
 */
function switchcolor() {
    static $col;
    $couleur1 = "#ffffff";
    $couleur2 = "#eeeeee";

    if ($col == $couleur1) {
        $col = $couleur2;
    } else {
        $col = $couleur1;
    }
    return $col;
}

/**
 * Formate une date
 * @param type $date
 * @return type 
 */
function dd($date) {
    return date("d/m/Y", $date);
}

/**
 *  Affiche l'extension d'un ficher
 * @param type $file
 * @return type 
 */
function extension($file) {
    return substr($file, strrpos($file, ".") + 1);
}

?>