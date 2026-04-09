<?php

include "db.php";

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // safer query
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . $conn->error;
    } else {

        if ($result->num_rows > 0) {

            $row = mysqli_fetch_assoc($result);

            if ($row['password'] == $password) {
                header("Location:admin_dashboard.php");
            } else {
                echo "<h1 style='position:fixed; left:40%; top:25%;'>Password is wrong</h1>";
            }

        } else {
            echo "<h1 style='position:fixed; left:40%; top:25%; color:red'>Email not found</h1>";
        }
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
            top: 35%;
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
            width: 100%;
        }
    </style>
</head>

<body>

<form action="login.php" class="form" method="post">
    Enter Your Email:
    <input type="email" name="email" required>

    Enter Your Password:
    <input type="password" name="password" required>

    <input type="submit" class="logbutton" name="submit" value="Login">

    <p>Register Now <a href="#">Register</a></p>
</form>

</body>
</html>