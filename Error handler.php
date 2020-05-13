<?php


if(isset($_POST['subnit'])){
    include_once 'dbh.inc.php';
    $first=   $_POST['first'];
    $last =   $_POST['last'];
    $email=   $_POST['email'];
    $pwd  =   $_POST['pwd'];
    if(empty($first)|| empty($last)|| empty($email)|| empty($pwd)){
        header("Location:../index.php?signup=empty");
        exit();

    }else {
        if(!preg_match ("/^[]a-zA-Z*$/", $first) || !preg_match("/^[a-zA-Z]*$/",$last)){
            header("Location:../index.php?signup=char");
            exit();
        }else{
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location:../index.php?signup=invalid_email");
                exit();
            }else{
                header("Location:../index.php?signup=succcess");
                exit();
            }
        }
    }
}else{
header("Location:../index.php");
exit();
}

second method
------------
    <!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    </head>
<body>
    <div class="container">
        <div class="formBx">
            <form action="include/signup.inc.php" method="POST">
                <h2>Registation</h2>
                <div class="inputBox"> 
                    <input type="text" name="first" required="required">
                    <span>Full Name</span>
                </div>
                <div class="inputBox">
                    <input type="text" name="last" required="required">
                    <span>Last Name</span>
                </div>
                <div class="inputBox">
                    <input type="text" name="email" required="required">
                    <span>Mail Address</span>
                </div>
                <div class="inputBox">
                    <input type="text" name="pwd" required="required">
                    <span>password</span>
                </div>
                    <div class=" inputBox">
                    <input type="submit" value="signup" name="submit">
                </div>
            </form>
        </div>
        <div class="imgBx">
        <img src="hamburger_0.png" alt="">
        </div>
    </div>
<?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(strpos($fullUrl,"signup=empty")==true){
        echo "<p class='error'>you don't fill in all fields</p> ";
        exit();
    }
    elseif(strpos($fullUrl,"signup=char")==true){
        echo "<p class='error'>you write in invalied corrector </p> ";
        exit();
    }
    elseif(strpos($fullUrl,"signup=char")==true){
        echo "<p class='error'>you used Invalied E-mail</p> ";
        exit();
    }
    elseif(strpos($fullUrl,"signup=success")==true){
        echo "<p class='success'>you have Sign-up</p> ";
        exit();
    }
?>
</body>
</html>
