<?php
    session_start();

    require_once('../config/database.php');
    try{
    if(isset($_POST['reset']))
    {
        $email = $_POST['email'];
        // $email = $_SESSION['email'];
        {
            $conn = new PDO("mysql:$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = ?"); 
            // $stmt->execute(array(':email' => $email));
            $result = $stmt->execute([$mail]);
            // $result = $stmt->fetchAll();
            if(!$result)
            {
                echo "incorrect email or email does not exists";
            }
            else
            {
                $msg = "click the link verifiy your account : http://localhost:8080/CAMAGRU/newpasswd.php?email=$email";    
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