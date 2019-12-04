<?php

    session_start();
    include_once ('../config/connect.php');
    $id = $_GET['image'];
    //$img = $_GET['img'];
    //var_dump($id);
    $username = $_SESSION["username"];
    try{
            $pdo= "INSERT INTO `likes`(`img_id`, `user`, `likes`) VALUES (?,?,?)";
            
            $stmt = $conn->prepare($pdo);
            
            $result = $stmt->execute([$id, $username, 1]);

            // $headers = 'FROM: lesedi';
			//         $message = "Someone commented on your photo. 
			        
			//         <a href='http://127.0.0.1:8080/CAMAGRU/gallery.php'>Click Here</a>";
			//         mail("$email", "Verify Camagru account", "$message", "$headers");
            //         $_SESSION["success"] = "You have been registered! Please verify your email!";
            
            header ("Location: ../gallery.php");
        }
        catch(PDOException $e){
        echo $e->getMessage();
    }

?>