<?php 
session_start();
if(isset($_POST['submitlogin'])){
    $_SESSION['id'] = 1;
    header ("Location:index.php");
}