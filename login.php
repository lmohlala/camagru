<?php
    include_once "config/database.php";
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <div class="reg-container">
            <h1  class="reg-h1">LOGIN</h1>
            <?php
            if ($_SESSION['username'] != "") {
                header("Location: gallery.php");
            } 
            ?>
                    <span class="reg-error">
                        <?php
                            if ($_SESSION["error"] != "") {
                                echo $_SESSION["error"];
                                echo "<br>";
                            }
                            $_SESSION["error"] = "";
                        ?>
                    </span>
                    <form action="includes/login.inc.php" method="POST">
                        <span class="reg-label">USERNAME</span><input  class="reg-input" type="text" name="username" placeholder="Username..."><br>
                        <span class="reg-label">UNIQUE</span><input  class="reg-input" type="text" name="okay" placeholder="Enter Your unique name..."><br>
                        <span class="reg-label">PASSWORD</span><input class="reg-input" type="password" name="password" placeholder="Passowrd..."><br>
                        <input  class="reg-button" type="submit" name="login" value="Login"><br><br>
                        <a href="Forgotpasswd.php" >Forgot Password</a>
                    </form>
                    
        </div>
    </body>
</html>    
<?