<?php
    session_start();

    require_once('../config/database.php');
    try{
    if(isset($_POST['reset']))
    {
        $email = $_POST['email'];
        $okay = $_POST['okay'];
        {
            $conn = new PDO("mysql:$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE okay = ?"); 
            
            $result = $stmt->execute([$okay]);
           
            if(!$result)
            {
                echo "incorrect email or email does not exists";
            }
            else
            {
                $msg = "click the link verifiy your account : http://localhost:8080/camagru/newpasswd.php?okay=$okay";    
                $headers = array('From: noreply');
                mail($email, "Verificatin email", $msg, implode("\r\n", $headers));
                echo "Check your email and change password <br>";
            }
        }
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>