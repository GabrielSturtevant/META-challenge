<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Sturtevant
 * Date: 10/28/16
 * Time: 6:32 PM
 */

header('Content-type: text/json');

/**
 * Computes the Fibonacci sequence
 * @param int $tot number of iterations of the Fibonacci sequence to compute
 * @return array $arr contains Fibonacci numbers and the corresponding indices
 */
function fib($tot)
{
    $a = 0;
    $b = 1;
    $arr = array();
    for($i = 0; $i <= $tot; $i++)
    {
        $arr[$i] = $a;
        $temp = $b;
        $b = $a;
        $a = $a + $temp;
    }
    return $arr;
}

$numbers = [];

$numbers["Version"] = "Version 0.1";
$numbers["status"] = http_response_code();
$numbers["Fibonacci"] = $_SERVER['QUERY_STRING'];
$numbers["Success"] = $numbers["Fibonacci"] > 0;
$numbers["numbers"] = fib($numbers["Fibonacci"]);

$numbers = json_encode($numbers, JSON_PRETTY_PRINT + JSON_FORCE_OBJECT);

print_r($numbers);
echo "\n";