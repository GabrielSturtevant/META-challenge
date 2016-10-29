<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 10/28/16
 * Time: 6:32 PM
 */
    function fib($tot)
    {
        $a = 0;
        $b = 1;
        for($i = 0; $i <= $tot; $i++)
        {
            $temp = $b;
            $b = $a;
            $a = $a + $temp;
            echo $a . "<br>";
        }
    }
    $itterations = $_SERVER['QUERY_STRING'];
    fib($itterations);
?>