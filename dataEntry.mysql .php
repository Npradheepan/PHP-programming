<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DataEntery to register form</title>
</head>
<body>
    <form action="insert.php" method="POST">
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><input type="radio" name="gender" value="m" required>Male</td>
                <td><input type="radio" name="gender" value="f" required>Female</td>
            </tr>
            <tr>
                <td>Mail-ID</td>
                <td><input type="email" value="mail" required></td>
            </tr>
            <tr>
                <td>phone-Number</td>
                <td>
                    <select name="phonecode">
                        <option selected hidden value="">Select code</option>
                        <option value="977">977</option>
                        <option value="978">978</option>
                        <option value="979">979</option>
                        <option value="973">973</option>
                        <option value="983">983</option>
                    </select>
                    <input type="phone" name="phone" required>
                </td>
            </tr>
            <td><input type="submit" value="submit"></td>
        </table>
    </form>
</body>
</html>

/*________________________*/
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender =$_POST['gender'];
$email = $_POST['email'];
$phoneCode = $_POST['phoneCode'];
$phone = $_POST['phone'];

if(!empty($username)|| !empty($password)||!empty($gender) || !empty($email)|| !empty($phoneCode)|| !empty($phone))
{
    $host ="localhost";
    $dbUsername ="root";
    $dbpassword ="root";
    $dbname= "customers";

    //Connection to creat
    $conn = new mysqli($host,$dbUsername, $dbpassword,$dbname);
    if(mysqli_connect_error())
    {
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    }
    else
    {
        $SELECT = "SELECT email Form register Where Email = ? Limit 1";
        $INSERT = "INSERT Into register (username,password,gender,email,phoneCode,phone)value (?,?,?,?,?,?,?)";
   
        // Prepare statements
        $stmt = $conn ->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt ->num_rows;

        if($rnum == 0)
        {
            $stmt ->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_parem("sssii",$username, $password, $gender, $email, $phoneCode, $phone);
            $stmt->execute();
            echo "New record inserted sucessfully";
        }
        else
        {
            echo"Someone already register using this email";
        }

        $stmt->close();
        $conn->close();
    }
}
else
{
    echo"All Failed are request";
    die();
}
?>
