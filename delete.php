<?php
    session_start();
    var_dump($_SESSION['username']);
    include_once ('config/setup.php');
    include_once ('config/database.php');
    $id = $_GET['imgId'];
    var_dump($id);
    try{
        $pdo = "DELETE FROM images WHERE img = ? AND username = ?";
        $stmt = $conn->prepare($pdo);
        $result = $stmt->execute([$id, $_SESSION['username']]);
        if($result === TRUE){
           header ("Location: gallery.php");
           exit();
        }else{
            echo "data not stored";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>