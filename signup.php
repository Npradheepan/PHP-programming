<?php
include_once 'dbh.php';

$first =$_POST['first'];
$last =$_POST['last'];
$uid =$_POST['uid'];
$pwd =$_POST['pwd'];

$sql = "INSERT INTO users(firstName,lastName,userName,password)
VALUE ('$first','$last','$uid','$pwd')";
msqli_query($conn, $sql);

$sql = "SELECT * FORM WHERE userName='$uid' AND first='$first'";
$result = msqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_assoc($result)){
    $userid = $row['id']; 
    $sql = "INSERT INTO profileimg(userid,status)
    VALUE ('$userid',1)";
    msqli_query($conn, $sql);
    header("Location:index.php");
    }
}else {
    echo"You have an error!";
}
?>