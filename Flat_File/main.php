<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Sturtevant
 * Date: 11/17/16
 * Time: 9:55 PM
 */
header('Content-type: text/json');

$core_path = realpath(dirname(__FILE__) . '/../..');
$core_path = $core_path . '/flat_file.csv';

/**
 * @param $hero_id - ID number to search for
 * @return array - Contains info about hero with specified id
 */
function read_file_id($hero_id){
    $row = str_getcsv(file($GLOBALS['core_path'])[$hero_id - 1]);
    return $row;
}

/**
 * @param $hero_persona - Persona to search for
 * @return array - Contains info about hero with specified persona
 */
function read_file_persona($hero_persona){
    $row = array();
    foreach (file($GLOBALS['core_path']) as $line){
        $line = str_getcsv($line);
        if(strtolower($line[3]) == strtolower($hero_persona)){
            array_push($row, $line);
        }
    }
    return $row;
}

/**
 * @param $hero_sex - Sex to search for
 * @return array - Contains info about hero with specified sex
 */
function read_file_sex($hero_sex){
    $row = array();
    foreach (file($GLOBALS['core_path']) as $line){
        $line = str_getcsv($line);
        if(strtolower($line[4]) == strtolower($hero_sex)){
            array_push($row, $line);
        }
    }
    return $row;
}

/**
 * @param $hero_first_name - First name to search for
 * @return array - Contains info about hero with specified first name
 */
function read_file_first_name($hero_first_name){
    $row = array();
    foreach (file($GLOBALS['core_path']) as $line){
        $line = str_getcsv($line);
        if(strtolower($line[1]) == strtolower($hero_first_name)){
            array_push($row, $line);
        }
    }
    return $row;
}

/**
 * @param $hero_last_name - last name to search for
 * @return array - Contains info about hero with specified last name
 */
function read_file_last_name($hero_last_name){
    $row = array();
    foreach (file($GLOBALS['core_path']) as $line){
        $line = str_getcsv($line);
        if(strtolower($line[2]) == strtolower($hero_last_name)){
            array_push($row, $line);
        }
    }
    return $row;
}

$hero_id = htmlspecialchars($_GET["id"]);
$hero_persona = htmlspecialchars($_GET["persona"]);
$hero_sex = htmlspecialchars($_GET["sex"]);
$hero_first_name = htmlspecialchars($_GET["first_name"]);
$hero_last_name = htmlspecialchars($_GET["last_name"]);

$row = array();
$count = 0;

//The following block controls which searches are executed
//Begin search block
if($hero_id){
    $count++;
    array_push($row, read_file_id($hero_id));
}
if($hero_persona){
    $count++;
    foreach (read_file_persona($hero_persona) as $line) {
        array_push($row, $line);
    }
}
if($hero_sex){
    $count++;
    foreach (read_file_sex($hero_sex) as $line) {
        array_push($row, $line);
    }
}
if($hero_first_name){
    $count++;
    foreach (read_file_first_name($hero_first_name) as $line) {
        array_push($row, $line);
    }
}
if($hero_last_name){
    $count++;
    foreach (read_file_last_name($hero_last_name) as $line) {
        array_push($row, $line);
    }
}
//End search block


//The following logic controls hero array population
//Begin population block
$hero = array();
if($count > 1){
    $row = array_diff_assoc($row, array_unique($row, SORT_REGULAR));
    foreach ($row as $line){
        $result = $line;
    }
    $hero["id"] = $result[0];
    $hero["first-name"] = $result[1];
    $hero["last-name"] = $result[2];
    $hero["persona"] = $result[3];
    $hero["sex"] = $result[4];

} elseif ($count == 1 and !$hero_sex){
    foreach ($row as $line){
        $result = $line;
    }
    $hero["id"] = $result[0];
    $hero["first-name"] = $result[1];
    $hero["last-name"] = $result[2];
    $hero["persona"] = $result[3];
    $hero["sex"] = $result[4];
} else {
    foreach ($row as $line){
        $temp["id"] = $line[0];
        $temp["first-name"] = $line[1];
        $temp["last-name"] = $line[2];
        $temp["persona"] = $line[3];
        $temp["sex"] = $line[4];
        array_push($hero, $temp);
    }
}
//End population block


$to_print["status"] = "200";
$to_print["success"] = "true";
$to_print["Version"] = "JSON-Flat-File-0.1";
$to_print["Hero"] = $hero;
$to_print = json_encode($to_print, JSON_PRETTY_PRINT|JSON_FORCE_OBJECT);
print_r($to_print);
print "\n";