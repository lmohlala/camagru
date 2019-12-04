<?php
    session_start();
    include "../config/database.php";

    if(isset($_POST['register']))
            {
                $username               = $_POST['username'];
                $email                  = $_POST['email'];
                $password               = $_POST['password'];
                $hashed                 = hash("whirlpool", $password);
                $cpassword              = $_POST['cpassword'];
                $okay              = $_POST['okay'];
                $verification           = 0;
                $_SESSION["error"]      = "";
                $_SESSION["success"]    = "";
                
                try
                {
                    if (empty($username) || empty($email) || empty($password) || empty($cpassword)) {
                        $_SESSION["error"] = "fill in all fields";
                        header("Location: ../registration.php");
                        return ;
                    }
                    
                    if (!(preg_match('/^[a-zA-Z0-9]{5,}$/', $username))) {
                        $_SESSION["error"] = "username must contain alphabets and numbers<br> and must be longer than 5 characters";
                        header("Location: ../registration.php");
                        return ;
                    }

                    if ($password != $cpassword) {
                        $_SESSION["error"] = "passwords don't match";
                        header("Location: ../registration.php");
                        return ;
                    }

                    if (strlen($_POST["password"]) <= 6) {
                        $_SESSION["error"] = "Your Password Must Contain At Least 6 Characters!";
                        header("Location: ../registration.php");
                        return ;
                    }

                    if(!preg_match("#[0-9]+#",$password)) {
                        $_SESSION["error"] = "Your Password Must Contain At Least 1 Number!";
                        header("Location: ../registration.php");
                        return ;
                    }

                    if(!preg_match("#[A-Z]+#",$password)) {
                        $_SESSION["error"] = "Your Password Must Contain At Least 1 Capital Letter!";
                        header("Location: ../registration.php");
                        return ;
                    }

                    if(!preg_match("#[a-z]+#",$password)) {
                        $_SESSION["error"] = "Your Password Must Contain At Least 1 Lowercase Letter!";
                        header("Location: ../registration.php");
                        return ;
                    }
                    $conn = new PDO("mysql:$dbhost;dbname=$dbname", $dbuser, $dbpass);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                    /** one email per user */
                    $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = :email");
                    $stmt->execute(array(':email' => $email));
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $_SESSION["error"] = "Email already exist, use another email!";
                        header("Location: ../registration.php");
                        return ;
                    }

                    /** inserting user into database */
                    $sql =$conn->prepare("INSERT INTO user_info (username, email, okay, passwd, verification) VALUES (:username, :email, :okay, :passwd, :verification)");
                    $sql->bindParam(':username', $username);
                    $sql->bindParam(':email', $email);
                    $sql->bindParam(':okay', $okay);
                    $sql->bindParam(':passwd', $hashed);
                    $sql->bindParam(':verification', $verification);
                    $sql->execute();

                        
                    $headers = 'FROM: lesedi';
			        $message = " Congratulations $username, you are now registered!! 
			        Please click on the link below to login
			        <a href='http://127.0.0.1:8080/CAMAGRU/verification.php?email=$email'>Click Here</a>";
			        mail("$email", "Verify Camagru account", "$message", "$headers");
                    $_SESSION["success"] = "You have been registered! Please verify your email!";
                    header("Location:../registration.php");
                    // header("Location:../login.php");
                    return ;
                }
                catch (PDOException $e)
                {
                    echo $e->getMessage();
                }
            }