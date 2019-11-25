<?php

if(isset($_POST['new']))
{
    include_once('connect.php');
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    try
    {
        $pdo = "UPDATE `camagru`.`user_info` SET passwd= ? WHERE email = ?";
        $stmt = $conn->prepare($pdo);
        $result = $stmt->execute([$passwd, $email]);
        if($result === TRUE)
        {
            header("location:../newpasswd.php");
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