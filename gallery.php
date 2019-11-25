<?php
    require_once('config/setup.php');
§?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<h1 class="reg-h1">GALLERY</h1>
    <header>
        <a href=index.php></a>
            <div>
                <nav class="gallery-col">
                    <tr>
                        <ul>
                            <a href="camera.php"><td>Camera</td></a>
                            <a href="notification.php"><td>Notification</td></a>
                            <a href="gallery.php"><td>Gallery</td></a>
                            <a href="login.php"><td>Logout</td></a>
                        </ul>
                    </tr>
                </nav>
            </div>
    </header>
    <main>

        <section class="gallery-links">
            <div>

    <?php
    $pageno = 0;
    $images_pp = 5;
    $stmnt = $conn->prepare("SELECT * FROM 'image'");
    $stmnt->execute();
    $row = $stmnt->fetch();
    $total_rows = sizeof($row);
    $total_pages = ceil($total_rows/$images_pp);
    
    $sql = $conn->prepare("SELECT * FROM `image` ORDER BY `id` DESC LIMIT $pageno, 5");
    
    $sql->execute();
    
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        
        echo '<DIV style= "background-image: url(images/'.$row['image'].');"></DIV>';
        //    echo '<A href= "commentsf.php?imgId='.$row['id'].'">
        //     <DIV class="gallery-image" style= "background-image: url(uploads/'.$row['image'].');"></DIV>
        //     <h3>comments</h3>
        //     </A>';
         
    }
    echo $total_pages;
    echo $total_rows;
    for ($i=1;$i<= $total_pages;$i++)
    {
        echo '<a href= "gallery.php?pageno='.$i.'"> '.$i.'</a>';
    }
    ?>

</body>
</html>