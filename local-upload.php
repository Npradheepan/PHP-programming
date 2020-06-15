index.php
---------
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file_uploads</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">UPLOAD</button>
    </form>
</body>
</html>
upload.php
----------
<?php

if(isset($_POST['submit'])){
    $file = $_FILES['file'];
  
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode ('.',$fileName); 
    $fileActualExt = strtolower(end($fileExt));

    $allowed =  array('jpg','jpeg','png','pdf');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize <1000000){
                 $fileNameNew = uniqid('', true).".".$fileActualExt ;
                 $fileDestination ='uploads/'.$fileNameNew;
                 move_uploaded_file($fileTmpName, $fileDestination);
                 //header("Location:/index.php?uploadsuccess!");
            }else{
                echo" there Was you Uploads file bigger than 100MB!";
            }

        }else {
            echo"There is Error Please check the file!";
        }

    }else{
        echo"This Type file not Allowed";
    }
   
}
