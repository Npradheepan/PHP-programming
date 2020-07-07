upload.php
----------
<?php
session_start();
$id = $_SESSION['id'];

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
                 $fileNameNew ="profile".$id.".".$fileActualExt ;
                 $fileDestination ='uploads/'.$fileNameNew;
                 move_uploaded_file($fileTmpName, $fileDestination);
                   $sql = "UPDATE profileimg SET status =0 WHERE userid ='$id';";
                   $result = mysqli_query($conn, $sql);
                 //  header("Location:/index.php?uploadsuccess!");
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
index.php
-----------
<?php
session_start();
include_once 'dbh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $sql ="SELECT * FROM users";
    $result = mysqli_query($conn, $sql); 
    if(mysqli_num_rows($result) > 0 ){  
        while($row = mysqli_fetch_array($result)){
            $id =$row['id'];
            $sqlImg = "SELECT * FROM profileimg WHERE userid ='$id'";
            $resultImg = mysqli_query($conn, $sqlImg);

            while($rowImg = mysqli_fetch_assoc($resultImg)){
                echo"<div class='user-container'>";
                if($rowImg['status']== 0){
                    echo"<img scr='uploads/profile".$id.".jpg'>";
                }else{
                    echo"<img scr='uploads/profiledefault.jpg'>";
                }
                echo "<p>".$row['userName']."<p>";
                echo"</div>";
            }

        }

    }else {
        echo"There are no users Yet!";
    }
/*Form to  signup*/
    if(isset($_SESSION['id'])){
        if ($_SESSION['id']== 1){
            echo "You are Logged in as User #1";
        }
        echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>
        <input type='file' name='file'>
        <button type='submit' name='submit'>Upload</button> 
        </form>";
    }else { 
        echo "You are not logged in!";
        echo "<form action='login.php' method='POST'>
            <input type ='text' name='first' placeholder='FirstName'>
            <input type ='text' name='last' placeholder='LastName'>
            <input type ='text' name='uid' placeholder='UserName'>
            <input type ='password' name='pwd' placeholder='Password'>
            <button type='submit' name='submitSignup'>Signup</button>
        </form>";
    }
?>  


<P>Login as a User!</P>
<form action="login.php" method= "POST">
    <button type ="submit" name="submitLogin">Login</button>
</form>
 
<P>Logout as a User!</P>
<form action="logout.php" method= "POST">
    <button type ="submit" name="submitLogout">logout</button>
</form>
</body>
</html>

signup.php
----------
<?php
include_once 'dbh.php';

$first =$_POST['first'];
$last =$_POST['last'];
$uid =$_POST['uid'];
$pwd =$_POST['pwd'];

$sql = "INSERT INTO users(firstName,lastName,userName,password)
VALUE ('$first','$last','$uid','$pwd')";
mysqli_query($conn, $sql);

$sql = "SELECT * FORM WHERE userName='$uid' AND firstName='$first'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_assoc($result)){
    $userid = $row['id']; 
    $sql = "INSERT INTO profileimg (userid,status)
    VALUE ('$userid',1)";
    mysqli_query($conn, $sql);
    header("Location:index.php");
    }
}else {
    echo"You have an error!";
}
?> 


login.php
---------
<?php 
session_start();

if(isset($_POST['submitLogin'])){
    $_SESSION['id'] = 1;
    header ("Location:index.php");
}

logout.php
----------
<?php
session_start();

 session_unset();
 session_destroy();
 header("Location: index.php");
