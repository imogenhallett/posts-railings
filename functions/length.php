<?php

define('POST_LENGTH', 0.1);
define('RAIL_LENGTH', 1.5);
/*
 * validates that the parameter is an array with expected keys
 *
 * @param array $fence the array containing posts and rails
 *
 * @return bool if array has correct keys then return true if not return false
 */
function validateArray(array $fence):bool {
    if(!array_key_exists('posts', $fence) || !array_key_exists('rails', $fence) ){
        return false;
    }
    return true;
}

/*
 * validates if $fence array contains positive integers
 *
 * @param array $fence the array containing posts and rails
 *
 * @return bool return true if rails and posts are integer values otherwise return false
 */
function validateInt(array $fence):bool {

    $posts = $fence['posts'];
    $rails = $fence['rails'];

    if($posts != intval($posts) || $rails != intval($rails) || intval($posts)<=0 || intval($rails)<=0) {
        return false;
    }
    return true;
}

/*
 * checks if the minimum number of posts (2) and rails (1) are present
 *
 * @param array $fence the array containing posts and rails
 *
 * @return bool true if we have enough rails and posts to make a fence, otherwise false
 */
function validateMinReq(array $fence):bool {

    $rails = intval($fence['rails']);
    $posts = intval($fence['posts']);

    if($rails === 0 || $posts < 2) {
        return false;
    }
    return true;
}

/* A function that calls all validation functions
 *
 * @param array $fence the array containing posts and rails
 *
 * @return bool true if array passes all validation tests, false if it fails any single test
 */
function doValidation(array $fence):bool {
    if(!validateArray($fence) || !validateInt($fence) || !validateMinReq($fence)){
        return false;
    }
    return true;
}

/*
 * calculates the length of a fence with the given number of posts and railings
 *
 * @param int $posts contains number of posts to use
 * @param int $rails contains the number of rails to use
 *
 * return string the message to output
 */
function doCalculation(int $posts, int $rails):string {

    if($posts <= $rails) {
        $postsRequired = $posts;
        $railsRequired = $posts - 1;
        $railsLeftOver = $rails - $railsRequired;

        $postsCalcLength = $postsRequired*POST_LENGTH;
        $railsCalcLength = $railsRequired*RAIL_LENGTH;
        $totalLength = $postsCalcLength+$railsCalcLength;

        $message = 'Congratulations you have enough materials to build a fence. <br/>  
                                With ' . $rails . ' rails and ' . $posts . ' posts you can build a fence that is ' . $totalLength . '(meters)
                                long.<br/> You will use ' . $railsRequired . ' rails and ' . $postsRequired . ' posts. <br/> 
                                That means you will have ' . $railsLeftOver . ' rail(s) left over and 0 post(s) left over.';
        return $message;

    }else{ //when rails are < posts
        $railsRequired = $rails;
        $postsRequired = $railsRequired + 1;
        $postsLeftOver = $posts - $postsRequired;

        $postsCalcLength = $postsRequired*POST_LENGTH;
        $railsCalcLength = $railsRequired*RAIL_LENGTH;
        $totalLength = $postsCalcLength+$railsCalcLength;

        $message = 'Congratulations you have enough materials to build a fence. <br/>  
                                With ' . $rails . ' rails and ' . $posts . ' posts you can build a fence that is ' . $totalLength . '(meters)
                                long.<br/> You will use ' . $railsRequired . ' rails and ' . $postsRequired . ' posts. <br/> 
                                That means you will have ' . $postsLeftOver . ' post(s) left over and 0 rail(s) left over.';
        return $message;
    }
}

/*
 * A function to validate form input - if input passes calculate the length of the fence you can make
 *
 * @param array $fence contains number of posts and rails
 *
 * return string the message to output
 */
function calculateLength(array $fence):string {
    if(!doValidation($fence)){
        $fence = 'Error! Invalid entry.  You require a minimum of 2 posts and 1 rail to make a fence.';
        return $fence;
    }else{
        $posts = $fence['posts'];
        $rails = $fence['rails'];
        $fence = doCalculation($posts, $rails);
        return $fence;
    }
}
?>
