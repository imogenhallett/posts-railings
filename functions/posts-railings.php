<?php

define('POST_LENGTH',0.1);
define('RAIL_LENGTH', 1.5);
/*
 * validates that the parameter is an array with expected keys
 *
 * @param array $railings the array to validate
 *
 * @return array if array validates return the original array with an extra key of status true, if false an array with status false and error message to display
 */
function validateArray(array $railings):array {
    //check $railings is valid array with correct keys
    if((gettype($railings) != 'array') || (!array_key_exists('posts', $railings) || !array_key_exists('rails', $railings)) ){
        $returnValues = [
            'status' => false,
            'message' => 'ERROR! You have entered an invalid selection. Programme requires valid data type to execute.'
        ];
        return $returnValues;
    }
    //array validates - return $railings with a status key set to true
    $railings['status'] = true;
    return $railings;
}//end validateArray()

function validateIntValues($railings) {
    $posts = floatval($railings['posts']);
    $rails = floatval($railings['rails']);

    //if casting to a float = 0 we cannot calculate the railings ($railings maybe a string or a 0 value) - set status to false
    if ($posts == 0 || $rails == 0) {
        $returnValues = [
            'status' => false,
            'message' => 'ERROR! You have entered an invalid selection. Please enter an integer value, greater than 0, for the number of posts and the number of rails'
        ];
        return $returnValues;
    }

    //check if the $posts value is equivalent to an int, if it is, cast it to an integer
    if($posts == intval($posts)) {
        $posts = intval($posts);
    }

    //check if the $rails value is equivalent to an int, if it is, cast it to an integer
    if($rails == intval($rails)) {
        $rails = intval($rails);
    }

    //if either $posts or $rails are not integers set status to false
    if(!is_int($posts) || !is_int($rails)) {
        $returnValues = [
            'status' => false,
            'message' => 'ERROR! You have entered an invalid selection. Please enter an integer value, greater than 0, for the number of posts and the number of rails'
        ];
        return $returnValues;
    }
    //success - $post and $rails are integers - pass them back
    $returnValues = [
        'status' => true,
        'posts'=> $posts,
        'rails' => $rails,
    ];
    return $returnValues;
}//end validateIntValues()

function checkMinReqs($railings) {
    //check $railings is valid array with correct keys
    $railings = validateArray($railings);
    if (!$railings['status']){
        return $railings;
    }

    //$railings array exists and has correct keys - check for int key values (again)
    $railings = validateIntValues($railings);
    if (!$railings['status']){
        return $railings;
    }

    //the array exists, has the correct keys and keys have int values
    $rails = $railings['rails'];
    $posts = $railings['posts'];

    // now check if they are greater than the min amount of posts/rails required
    if($rails === 0 || $posts < 2) {
        $returnValues = [
            'status' => false,
            'message' => 'ERROR! You have entered an invalid selection. Programme requires a min of 1 rail and 2 posts.'
        ];
        return $returnValues;
    }

    //everything has passed - return the $railings array unchanged
    return $railings;
}//end checkMinReqs

function doCalculation($railings) {
    //check $railings is valid array with correct keys (again)
    $railings = validateArray($railings);
    if (!$railings['status']){
        return $railings;
    }

    //$railings array exists and has correct keys - check for int key values (again)
    $railings = validateIntValues($railings);
    if (!$railings['status']){
        return $railings;
    }

    //the array exists, has the correct keys and keys have int values assign vars
    $rails = $railings['rails'];
    $posts = $railings['posts'];

    if($posts <= $rails) {
        $postsRequired = $posts;
        $railsRequired = $posts - 1;
        $railsLeftOver = $rails - $railsRequired;

        $postsCalcLength = $postsRequired*POST_LENGTH;
        $railsCalcLength = $railsRequired*RAIL_LENGTH;
        $totalLength = $postsCalcLength+$railsCalcLength;

        $returnValues = [
            'status' => true,
            'message' => 'Congratulations you have enough materials to build a fence. <br/>  
                                With ' . $rails . ' rails and ' . $posts . ' posts you can build a fence that is ' . $totalLength . '(meters)
                                long.<br/> You will use ' . $railsRequired . ' rails and ' . $postsRequired . ' posts. <br/> 
                                That means you will have ' . $railsLeftOver . ' rail(s) left over and 0 post(s) left over.'
        ];
        return $returnValues;

    }else{ //when rails are < posts
        $railsRequired = $rails;
        $postsRequired = $railsRequired + 1;
        $postsLeftOver = $posts - $postsRequired;

        $postsCalcLength = $postsRequired*POST_LENGTH;
        $railsCalcLength = $railsRequired*RAIL_LENGTH;
        $totalLength = $postsCalcLength+$railsCalcLength;

        $returnValues = [
            'status' => true,
            'message' => 'Congratulations you have enough materials to build a fence. <br/>  
                                With ' . $rails . ' rails and ' . $posts . ' posts you can build a fence that is ' . $totalLength . '(meters)
                                long.<br/> You will use ' . $railsRequired . ' rails and ' . $postsRequired . ' posts. <br/> 
                                That means you will have ' . $postsLeftOver . ' post(s) left over and 0 rail(s) left over.'
        ];
        return $returnValues;
    }
}//end doCalculation

//function calculateLength($railings) {
//    $railings = validateIntValues($railings);
//    if($railings['status']) {//if railings i.e $_POST has passed basic validation check min length requirements
//        $checkMinReqs = checkMinReqs($railings);
//        if($checkMinReqs['status']){//if checkMinReqs passes then calculate the railings
//            $calculation = doCalculation($checkMinReqs);
//            return $calculation;//success
//        }else{
//            return $checkMinReqs;//does not have enough rails or posts
//        }
//    } else {
//        return $railings;//does not contain integers
//    }
//}//end calculateLength()


function calculateLength($railings) {
    $railings = validateArray($railings);
    if($railings['status']){//if railings is an array with correct keys

        $railings = validateIntValues($railings);
        if($railings['status']) {//if railings has passed basic array validation check for int values

            $checkMinReqs = checkMinReqs($railings);
            if($checkMinReqs['status']){//if checkMinReqs passes then calculate the railings

                $calculation = doCalculation($checkMinReqs);
                return $calculation;//success - we have a success message to output

            }else{
                return $checkMinReqs;//does not have enough rails or posts
            }
        } else {
            return $railings;//does not contain integers
        }
    }else{
        return $railings;//is not an array
    }
}//end calculateLength()


?>
