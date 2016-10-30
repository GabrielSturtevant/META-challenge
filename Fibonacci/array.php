<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Sturtevant
 * Date: 10/28/16
 * Time: 6:32 PM
 */

header('Content-type: text/json');

/**
 * Number of iterations of the Fibonacci sequence to compute
 * @param int $tot
 */
function fib($tot)
{
    $a = 0;
    $b = 1;
    $arr = array();
    for($i = 0; $i <= $tot; $i++)
    {
        $temp = $b;
        $b = $a;
        $a = $a + $temp;
        $arr[$i] = $a;
    }
    return $arr;

}
$numbers = [];

$numbers["status"] = http_response_code();
$numbers["Fibonacci"] = $_SERVER['QUERY_STRING'];
$numbers["numbers"] = fib($numbers["Fibonacci"]);

$numbers = json_encode($numbers, JSON_PRETTY_PRINT+JSON_FORCE_OBJECT);

print_r($numbers);