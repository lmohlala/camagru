<?php

    require_once("../config/database.php");
   // session_start();
    
    //When the upload button is clicked the image is uploaded into the uploads file. Only jpg, png and gif extensions are accepted.
    if (isset($_POST['submit'])) {
        $filename = $_FILES['file']['name'];
        $file_ext = explode('.', $filename);
        $file_act_ext = strtolower($file_ext[1]);
        //$file_act_ext = strtolower(end($file_ext));
        $ext = array('jpg', 'jpeg', 'gif', 'png');
       
        //if the file does not have the specified extensions "Format not accepted"
        if (!in_array($file_act_ext, $ext)){
            $alert = "<h5>Format not accepted: Please upload<br>jpg, jpeg, png or gif</h5>";
        }
        
        //if an error has occured
        elseif ($_FILES['file']['error']){
            $alert = "An error occured";
        }

        //create a random name for the image to prevent image overwriting. Upload image to folder and insert image name into the database.
        else {
            $fileNameNew = uniqid('', true).".".$file_act_ext;
            
            move_uploaded_file($_FILES['file']['tmp_name'], '../images/'.$fileNameNew);
            $alert = "<h5>File Uploaded successfully</h5>";
            $sql = "INSERT INTO image (img,article_likes) VALUES ('../images/'.$fileNameNew', 0)";
	        $conn->exec($sql);
        }
    }
?>