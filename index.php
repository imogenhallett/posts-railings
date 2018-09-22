<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts and Railings</title>
</head>
<body>
<h1>Posts and railings</h1>

<form action="length.php" method="post" target="_self">
    <label>How long would you like your fence to be?</label>
</form>

<form action="posts-railings.php" method="post" target="_self">
    <h2>How many posts/railings do you have?</h2>
    <div>
        <label for="posts">Posts</label>
        <input type="text" id="posts" name="posts"/>
    </div>
    <div>
        <label for="railings">Railings</label>
        <input type="text" id="railings" name="railings"/>
    </div>
    <div>
        <input type="submit" value="Calculate"/>
    </div>
</form>

</body>
</html>