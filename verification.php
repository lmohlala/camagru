<?php
    session_start();

    require_once('config/database.php');
    try{
        $email = $_GET['email'];
        $conn = new PDO("mysql:$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $verifi = "UPDATE user_info SET verification=1 WHERE email = '$email'";
        $conn->exec($verifi);

        header('Location: login.php');
    }
        catch(PDOException $e)
    {
        echo $e->getMessage();
    }

?>