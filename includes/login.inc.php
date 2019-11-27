<?php
include "../config/database.php";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $passwd = $_POST['password'];
    $hashed = hash("whirlpool", $passwd);
    $_SESSION["error"] = "";

    try
    {

        if (empty($username) || empty($passwd)) {
            $_SESSION["error"] = "fill in all fields";
            header("Location: ../login.php");
            return ;
        }

        $conn = new PDO("mysql:$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM user_info WHERE username = '$username' AND verification = '1' AND passwd = '$hashed'");
        session_start();
        $_SESSION['id'] = $_POST['username'];
        $id = $_SESSION['id'];
        $stmt->execute(array(':username' => $id, ':passwd' => $hashed, ':verification' => 1));

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count == 1) {
            $_SESSION["username"] = $row['username'];
            $_SESSION["email"] = $row['email'];
            header("Location: ../gallery.php");
            return ;
        }
        else {
            $_SESSION["error"] = "incorrect password or username or Verifiy your email!!";
            header("Location: ../login.php");
            return ;
        }
    }
    catch(PDOException $e)
    {
        echo "failed".$e->getMessage();
    }
} 