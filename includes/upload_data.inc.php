<?php

  session_start();
 
  include_once('../config/database.php');
  include_once('../config/setup.php');

  $user = $_SESSION['username'];
 
  $img = $_POST['img'];
   $img = str_replace('data:image/png;base64,', '', $img);
   $img = str_replace(' ', '+', $img);
   $data = base64_decode($img);
   $upload = imagecreatefromstring($data);
   $file = "camagru".uniqid().".png";
   
   $filedest = "../images/".$file;
   $success = imagepng($upload, $filedest);
   
  
    try
    {
       
        $sql = "INSERT INTO images (`user` ,`img`, article_likes) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        var_dump($stmt);
        $stmt->execute([$user, $file, '0']);
        if($stmt)
        {
            echo "Post added successful";
        }
        else
            echo "Failed to add a post";
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
