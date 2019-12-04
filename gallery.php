<?php
    require_once('config/setup.php');
    session_start();
?>

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
<?php 
if ($_SESSION['id'] == "") {
    header("Location: registration.php");
}
?>
  
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
                                <a href="includes/logout.inc.php"><td>Logout <?php echo $_SESSION['id']?></td></a>
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
        $files = glob("images/*.*");
                usort($files,"date_sort");
        while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {

           $image_url = $results['img'];
           echo "
           
           <img width='300px' height='300px' src='images/$image_url' alt='image'>
                <form action='includes/comment.inc.php?image=".$results['id']."' method='POST'>
                    <div class='form-group purple-border'>
                        <textarea rows='3' style='width:650px;margin-left:auto;margin-right:auto;' class='form-control' name='content' required></textarea>
                        </div>
                        <input type='hidden' name='image' value=''.$image_url.'>
                    <button class='btn btn-info center-block' type='submit' name='comment'>Comment</button>
                </form>
                <form action='includes/likes.inc.php?image=".$results['id']."' method='POST'>
                    <input class='likes' type='submit' name='like' value='like'><br><br>
                </form>
           ";

           $getComments = $conn->prepare("SELECT count(*) FROM likes");
           $getComments->execute();
           $users = $getComments->fetchAll();
           foreach ($users as $user){
               if ($user['img'] == $files[$i])
               {
                echo '<h6 class="">'.$user['user'].' likes</h6>'. '<br/>';
               }
           }
           
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