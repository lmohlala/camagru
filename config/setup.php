<?php

include_once 'database.php';

try 
{
    $conn = new PDO("mysql:$dbhost", $dbuser, $dbpass);
    // $conn->exec("DROP DATABASE IF EXISTS camagru;");
    $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname;") or die(print_r($conn->errorInfo(), true));
    $sql = "use $dbname";
    $conn->exec($sql);
    $user = "CREATE TABLE IF NOT EXISTS user_info (

        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username        VARCHAR(255) NOT NULL,
        email           VARCHAR(255) NOT NULL,
        okay          VARCHAR(255) NOT NULL,
        passwd          VARCHAR(255) NOT NULL,
        verification    TINYINT NOT NULL 
    )";
    $conn->exec($user);


    $img = "CREATE TABLE IF NOT EXISTS images (
        
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user            varchar(255) NOT NULL,
        img             varchar(255) NOT NULL,
        article_likes   INT(11) NOT NULL
    )";
    $conn->exec($img);


    $like = "CREATE TABLE IF NOT EXISTS likes (
        img_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user          varchar(255) NOT NULL,
        img           varchar(255) NOT NULL,
        likes         INT(1) NOT NULL
    )";
    $conn->exec($like);


    $com = "CREATE TABLE IF NOT EXISTS comment (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user        varchar(255) NOT NULL,
        img         varchar(255) NOT NULL,
        comment     varchar(255) NOT NULL
    )";
    $conn->exec($com);

 //   header("Location: ../registration.php");
    
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

?>