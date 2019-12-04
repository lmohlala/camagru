<!--This is the index page styled using bootstrap and css (stylesheet:index.css)-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style/style.css">
<body>

<?php
    require_once('config/connect.php');
    session_start();
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
<a class="btn btn-default btn-lg" href="registration.php"><h2 class="reg-button">login or sign up</h2></a>

</body>
</html> 
