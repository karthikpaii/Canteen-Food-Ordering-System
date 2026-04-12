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
        $message = "Registration failed!";
        $message_type = "error";
    } else {
        $message = "Registered Successfully!";
        header("Location:user_dashboard.php"); 
        $message_type = "success";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System - Register</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }

        /* Header */
        header {
            background: #0d47a1;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-size: 14px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
        }

        /* Form Card */
        .form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .form h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #0d47a1;
        }

        .form input, .form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form textarea {
            resize: none;
            height: 60px;
        }

        .logbutton {
            background: #0d47a1;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .logbutton:hover {
            background: #1565c0;
        }

        .form p {
            text-align: center;
            margin-top: 10px;
        }

        .form a {
            color: #0d47a1;
            text-decoration: none;
        }

        .form a:hover {
            text-decoration: underline;
        }

       
        .success {
            text-align: center;
            color: green;
            margin-top: 10px;
        }

       
        footer {
            background: #0d47a1;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }


        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .message.error {
            background: #ffcccc;
            color: #b30000;
        }

        .message.success {
            background: #ccffcc;
            color: #006600;
        }
    </style>
</head>

<body>

<header>
    <div class="logo">🍽️ Pallakki Canteen</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="#">About</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Contact</a>
    </nav>
</header>

<div class="container">
    <form action="register.php" class="form" method="post">

    <?php if (!empty($message)) { ?>
    <div class="message <?php echo $message_type; ?>">
        <?php echo $message; ?>
    </div>
<?php } ?>
        <h2>Register</h2>

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Address</label>
        <textarea name="address"></textarea>

        <label>Phone Number</label>
        <input type="text" name="phone" required>

        <input type="submit" class="logbutton" name="submit" value="Register">

        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

<footer>
    © 2026 Canteen Management System | All Rights Reserved
</footer>


<script>
    setTimeout(() => {
        const msg = document.querySelector('.message');
        if (msg) {
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000); 
</script>
</body>
</html>