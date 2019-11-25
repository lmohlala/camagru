<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New password</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
    <div class="reg-container">
        <h1 class="reg-h1">Forgot password</h1>
            <form action="includes/newpasswd.inc.php" method="POST">
                <span class="reg-label">ENTER NEW PASSWORD</span><br> <input class="reg-input" type="password" name="npassword" placeholder="Password..."><br><br>
                <span class="reg-label">CONFIRM PASSWORD</span><br> <input class="reg-input" type="password" name="cpassword" placeholder="Confirm Password...">
                <input  class="reg-button" type="submit" name="submit"  value="Submit"><br><br>
            </form>            
    </div>
</body>
</html>