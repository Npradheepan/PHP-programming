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
        while($row = mysqli_fetch_assoc($result)){
            $id =$row['id'];
            $sqlImg = "SELECT * FROM Profileimg WHERE userid ='$id'";
            $resultImg = mysqli_query($conn, $sqlImg);

            while($rowImg = mysqli_fetch_assoc($resultImg)){
                echo"<div>";
                if($rowImg['status']== 0){
                    echo"<img scr='uploads/profile".$id.".jpg'>";
                }else{
                    echo"<img scr='uploads/profiledefault.jpg'>";
                }
                echo $row['username'];
                echo"</div>";
            }

        }

    }else {
        echo" There are no users yets!";
    }

    if(isset($_SESSION['id'])){
        if ($_SESSION['id']== 1){
            echo "You are Logged in as User #1";
        }
        echo "<form action='upload.php' method='POST' enctype='multypart/form-data'>
        <input type='file' name='file'>
        <button type='submit' name='submit'>Upload</button> 
        </form>";
    }else { 
        echo "You are not logged in!";
        echo "<form action='login.php' method='POST'>
            <input type ='text' name='first' placeholder='firstName'>
            <input type ='text' name='last' placeholder='LastName'>
            <input type ='text' name='uid' placeholder='UserName'>
            <input type ='password' name='pwd' placeholder='Password'>
            <button type='submit' name='submitSignup'>Signup</button>
        </form>";
    }
?>  


<P>Login as a User!</P>
<form action="login.php" method= "POST">
    <button type ="submit" name="submitlogin">login</button>
</form>

<P>Logout as a User!</P>
<form action="logout.php" method= "POST">
    <button type ="submit" name="submitlogout">logout</button>
</form>
</body>
</html>