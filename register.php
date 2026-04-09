<?php

include "db.php";

if (isset($_POST['submit'])) {
    $name=$_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $type="user";

    $sql = "INSERT INTO users(name,email,password,type,address,phone) values('$name','$email','$password','$type','$address','$phone')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . $conn->error;
    } else {

        echo "<h1 style='margin-top:0; margin-left:300px; color:green;'>Registered</h1>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen</title>

    <style>
        .form {
            position: fixed;
            margin:30px 100px;
            left: 40%;
            padding: 30px;
            background: lightblue;
        }

        .form input {
            display: block;
            padding: 10px;
            margin: 5px;
        }

        .logbutton {
            background: blue;
            color:white;
           
        }

        .textarea{
            display:block;
            width:100%;
            height:40%;
        }
    </style>
</head>

<body>

<form action="register.php" class="form" method="post">
    Enter Your Name:
    <input type="text" name="name" required>

    Enter Your Email:
    <input type="email" name="email" required>

     Enter Your Password:
    <input type="password" name="password" required>


    Enter Your Address:
    <textarea name="address" class ="textarea"></textarea>

     Enter Your Phone Number:
    <input type="text" name="phone" required>
   

    <input type="submit" class="logbutton" name="submit" value="Register">

    <p>Register Login <a href="login.php">Login</a></p>
</form>

</body>
</html>