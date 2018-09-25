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
    echo $fence = calculateLength($_POST);
?>
</body>
</html>