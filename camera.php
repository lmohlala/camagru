

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width>, initial-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camera</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div>
        <video id="video" playsnline autoplay></video>
    </div>
    
    <div>
        <img src="stickers/login.png" alt="USa" id="flag1" width="50" height="50"/>
        <img src="stickers/index.jpeg" alt="GER" id="flag2" width="50" height="50"/>
    </div>

    <div>
        <button id="snap">Capture</button>
        <button id="upload">Save and Upload</button>
        
    </div>

    <canvas id="canvas" class="move" width="500" height="480"></canvas>

    <script>
       'use strict';
       
       const video              = document.getElementById('video');
       const canvas             = document.getElementById('canvas');
       const snap               = document.getElementById('snap');
       const errorMsgElement    = document.getElementById('span#ErrorMsg');

       const constraints = {
           video: {
               width: 420, height: 420
           }
       };

       async function init(){
           try{
               const stream = await navigator.mediaDevices.getUserMedia(constraints);
               handleSuccess(stream);
           }
           catch(e){
               'errorMsgElement.innerHTML = navigator.getUserMedia.error:$(e.toString())}';
           }
       }

       function handleSuccess(stream){
           window.stream = stream;
           video.srcObject = stream;
       }
       function sticker(){
            context.drawImage(flag1, 80, 80, 80, 80);
       }
       function sticker2(){
            context.drawImage(flag2, 80, 200, 80, 80);
       }

       init();

       var context = canvas.getContext('2d');
       snap.addEventListener("click", function(){
        context.drawImage(video, 0, 0, 640, 480);
        flag1.addEventListener("click", sticker)
        flag2.addEventListener("click", sticker2)
       });

        document.getElementById("upload").addEventListener("click", function() {
        var canvas = document.getElementById("canvas");
        var dataURL = canvas.toDataURL("image/png");
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
        console.log(xhr.status, xhr.responseText);
    };
    xhr.open('POST', './includes/upload_data.inc.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("img=" + dataURL);
 })
    </script>
    <title>Upload Files</title>
    </head>
    <body>
        <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file"/>
            <button type="submit" name="submit">UPLOAD</button>
           
        </form>
        <!-- <script src="upload.js"></script> -->
</body>
</html>