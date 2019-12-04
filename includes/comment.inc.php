<?php
session_start();
include_once('../config/connect.php');

include_once ('../config/connect.php');
$id = $_GET['image'];
$comment = $_POST['content'];
$username = $_SESSION["username"];
try{
        $pdo= "INSERT INTO `comment`(`user`, `img`, `comment`) VALUES (?,?,?)";
        
        $stmt = $conn->prepare($pdo);
        
        $result = $stmt->execute([$username, $id, $comment]);
        
        header ("Location: ../gallery.php");
    }
    catch(PDOException $e){
    echo $e->getMessage();
}

?>