<?php
session_start();
include_once('config/connect.php');
if($_GET['okay']){
    $_SESSION['okay'] = $_GET['okay'];
}

if(isset($_POST['new']))
{
    $okay = $_SESSION['okay'];
    $password   = $_POST['npassword'];
    $hashed     = hash("whirlpool", $password);
    $cpassword  = $_POST['cpassword'];
    try
    {
        if ($password != $cpassword) {
            $_SESSION["error"] = "passwords don't match";
            header("Location: newpasswd.php");
            return ;
        }

        if (strlen($_POST["npassword"]) <= 6) {
            $_SESSION["error"] = "Your Password Must Contain At Least 6 Characters!";
            header("Location: newpasswd.php");
            return ;
        }

        if(!preg_match("#[0-9]+#",$password)) {
            $_SESSION["error"] = "Your Password Must Contain At Least 1 Number!";
            header("Location: newpasswd.php");
            return ;
        }

        if(!preg_match("#[A-Z]+#",$password)) {
            $_SESSION["error"] = "Your Password Must Contain At Least 1 Capital Letter!";
            header("Location: newpasswd.php");
            return ;
        }

        if(!preg_match("#[a-z]+#",$password)) {
            $_SESSION["error"] = "Your Password Must Contain At Least 1 Lowercase Letter!";
            header("Location: newpasswd.php");
            return ;
        }
        $sql=$connection->prepare("UPDATE camagru.user_info SET passwd= '$hashed' WHERE okay= '$okay'");
        $sql->execute();
        $result = $sql->execute();
        if($result === TRUE)
        {
            header("location: login.php");
        }
        else
        {
            echo "data not stored";
        }
    
    }
    catch(PDOException $e)
    {
        echo "failed".$e->getMEssage();
    }
   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New password</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
    <div class="reg-container">
        <h1 class="reg-h1">Forgot password</h1>
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
                    <span class="reg-success">
                        <?php
                            if ($_SESSION["success"] != "") {
                                echo $_SESSION["success"];
                                echo "<br>";
                            }
                            $_SESSION["success"] = "";
                        ?>
            <form action="newpasswd.php" method="POST">
                <span class="reg-label">ENTER NEW PASSWORD</span><br> <input class="reg-input" type="password" name="npassword" placeholder="Password..."><br><br>
                <span class="reg-label">CONFIRM PASSWORD</span><br> <input class="reg-input" type="password" name="cpassword" placeholder="Confirm Password...">
                <input  class="reg-button" type="submit" name="new"  value="Submit"><br><br>
            </form>            
    </div>
</body>
</html>