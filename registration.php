<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>REGISTRATION</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <div class="reg-container">
            <form action="includes/registration.inc.php" method="POST">
               
                    <h1 class="reg-h1">Registration</h1>
                    <span class="reg-error">
                        <?php
                            if ($_SESSION["error"] != "") {
                                echo $_SESSION["error"];
                                echo "<br>";
                            }
                            $_SESSION["error"] = "";
                        ?>
                    </span>
                    <span class="reg-success">
                        <?php
                            if ($_SESSION["success"] != "") {
                                echo $_SESSION["success"];
                                echo "<br>";
                            }
                            $_SESSION["success"] = "";
                        ?>
                    </span>
                   <span class="reg-label">USERNAME</span><br> <input class="reg-input" type="text" name="username" placeholder="Username..."><br><br>
                   <span class="reg-label">EMAIL </span><br>   <input class="reg-input" type="email" name="email" placeholder="Email..."><br><br>
                   <span class="reg-label">PASSWORD</span><br> <input class="reg-input" type="password" name="password" placeholder="Password..."><br><br>
                   <span class="reg-label">CONFIRM PASSWORD</span><br> <input class="reg-input" type="password" name="cpassword" placeholder="Confirm Password...">
                
                <input class="reg-button" type="submit" name="register" value="Sign up"><br><br>
                Already have an account? <a href="login.php" target="_blank">Sign in</a>
            </form>
        </div>
    </body>
</html>