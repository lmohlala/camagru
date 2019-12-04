<?php
	session_start();
    if (!isset($_SESSION['id'])){
        header("location: login.php");
    }
    require_once "config/connect.php";
    $id = $_SESSION['id'];
    
    try{
        if(isset($_POST['update'])){
            $passwd = $_POST['password'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            echo $email.":EMAIL\n";
            $pass = hash("whirlpool", $passwd);
       
            $sql=$connection->prepare("UPDATE camagru.user_info SET `username`='$username', `email`= '$email', `passwd`='$pass' WHERE okay='$id'");
       
		    $sql->execute();
            $alert = "<h5 style='text-align:center;' class='text-default'>Password reset</h5>";
        
        }
    }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div class="reg-container">
        <h1 class="reg-h1">Update Details</h1>
        <?php
        echo $_SESSION['id'];
        ?>
            <form action="update.php" method="POST">
                <span class="reg-label">USERNAME</span><br> <input class="reg-input" type="text" name="username" placeholder="Username..." required><br>
                <span class="reg-label">EMAIL</span><br>   <input class="reg-input" type="email" name="email" placeholder="Email..." required><br>
                <span class="reg-label">PASSWORD</span><br> <input class="reg-input" type="password" name="password" placeholder="Password..." required><br>
                <input class="reg-button" type="submit" name="update" value="Update"><br><br>
               <a href="gallery.php">Home</a>
            </form>
        </div>
    </body>
</html>