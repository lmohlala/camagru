<?php
   $dbhost = "localhost; charset=utf8";
   $dbname = "camagru";
   $dbuser = "root";
   $dbpass = "lesedi";
   $connection;
    //create a connection'
    try
    {
        //create the connection using PHP DATA OBJECTS
        $connection = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //create the database with all the tables needed. (config.php)
        include_once("setup.php");
    }
    //if there is an error with the connection output an error message
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
?>