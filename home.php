<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<h1> HELLO <?php echo $_SESSION["username"]; ?> </h1>
    <div>
        <form action="includes/login.inc.php" method="POST">
            <input  class="reg-button" type="submit" name="login" value="Logout"><br><br> 
        </form>
    </div>
</body>
</html>