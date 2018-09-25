<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts and Railings</title>
</head>
<body>
<h1>Posts and railings</h1>


<form action="length.php" method="post" target="_self">
    <label for="length">How long would you like your fence to be (in meters)?</label>
    <input type="text" id="length" name="length"/>
    <input type="submit" value="Calculate"/>
</form>

<hr>OR<hr>

<form action="posts-railings-2.php" method="post" target="_self">
    <h2>How many posts/railings do you have?</h2>
    <div>
        <label for="posts">Posts</label>
        <input type="number" id="posts" name="posts"/>
    </div>
    <div>
        <label for="rails">Railings</label>
        <input type="number" id="rails" name="rails"/>
    </div>
    <div>
        <input type="submit" value="Calculate"/>
    </div>
</form>

</body>
</html>