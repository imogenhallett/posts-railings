<?php
    include_once('functions/posts-railings.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts and Railings</title>
</head>
<body>
<?php
    $validateArray = validateArray($_POST);
    if(!$validateArray['status']) {
        echo 'Error! Invalid input. Please enter an integer value, greater than 0, for the number of posts and the number of rails';
    }else{
        $railings = calculateLength($_POST);
        echo $railings['message'];
    }//end validate if
?>
</body>
</html>