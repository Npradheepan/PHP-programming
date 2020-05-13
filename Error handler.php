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
