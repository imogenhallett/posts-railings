<?php

define('POST_LENGTH', 0.1);
define('RAIL_LENGTH', 1.5);

function validateFloat(array $fence):bool {
    $length = $fence['length'];

    if($length != floatval($length) || floatval($length)<=0) {
        return false;
    }
    return true;
}

function doCalculation(float $length) {

    $rails = ceil(($length-1.7)/1.6)+1;
    $posts = $rails + 1;

    $postsCalcLength = $posts*POST_LENGTH;
    $railsCalcLength = $rails*RAIL_LENGTH;
    $totalLength = $postsCalcLength+$railsCalcLength;



    return 'rails: ' . $rails . ' / posts:' . $posts . ' / total length: ' . $totalLength;




}

function returnLength(array $fence) {

    if(!validateFloat($fence)) {
        return 'Error! Invalid input.  Please enter a positive value to calculate requirements';
    } else {
        $length = floatval($fence['length']);
        echo doCalculation($length);
    }


}

?>
