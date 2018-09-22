<?php
    function validateFormData($post) {
        if(!isset($post['posts']) || !isset($post['rails'])) {
            return false;
        }
        return true;
    }//end validateFormData()

    function validateFormValues($post) {
        $posts = floatval($post['posts']);
        $rails = floatval($post['rails']);

        if ($posts == 0 || $rails == 0) {
            return false;
        }

        if($posts == intval($posts)) {
            $posts = intval($posts);
        }

        if($rails == intval($rails)) {
            $rails = intval($rails);
        }

        if(!is_int($posts) || !is_int($rails)) {
            return false;
        }

        return true;
    }//end validateFormValues()

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts and Railings</title>
</head>
<body>
<?php
    if(!validateFormData($_POST) || !validateFormValues($_POST)) {
        echo 'Please enter an integer value, greater than 0, for the number of posts and the number of rails';
    }else{
        echo 'proceed to do something';
    }//end validate if

?>



</body>
</html>