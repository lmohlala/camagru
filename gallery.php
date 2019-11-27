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
                                <a href="gallery.php"><td>Gallery</td></a>
                                <a href="update.php"><td>Update info</td></a>
                                <a href="login.php"><td>Logout</td></a>
                            </ul>
                        </tr>
                    </nav>
                </div>
        </header>

    <?php
        $limit = 5;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $sql = "SELECT * FROM images ORDER BY id DESC LIMIT $start, $limit";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {

           $image_url = $results['img'];

           echo "
           
           <img width='300px' height='300px' src='images/$image_url' alt='image'>
           <div class='uploader'>$posted_by</div>
           
           ";
           
       }

    
        $stmt = $conn->prepare("SELECT count(*) FROM images");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $pages = ceil($count / $limit);

       //previous pager
        if ($page == 1)
            $prev = $page;
        else
            $prev = $page - 1;

        //next pager
        if ($page == $pages)
            $next = $page;
        else
            $next = $page + 1;

    ?>

    <ul class="pager">
		<li><a href="gallery.php?page=<?php echo $prev; ?>">«</a></li>
		<?php $i = 1; ?>
		<?php while ($i <= $pages) : ?>
			<li><a href="gallery.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php $i++; ?>
		<?php endwhile; ?>
		<li><a href="gallery.php?page=<?php echo $next; ?>">»</a></li>
	</ul>


</body>
</html>