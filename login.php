<?php 

include "db.php";

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // safer query
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        $message = "Something went wrong!";
        $message_type = "error";
    } else {

        if ($result->num_rows > 0) {

            $row = mysqli_fetch_assoc($result);

            if ($row['password'] == $password) {
                session_start();
                $_SESSION['user_id']=$row['id'];
                $_SESSION['user_type']= $row['type'];


                if($_SESSION['user_id'])
                    {
                         if($_SESSION['user_type']=="admin")
                            {
                                header("Location:admin_dashboard.php");
                            }

                           if($_SESSION['user_type']=="user")
                            {
                              header("Location:user_dashboard.php");
                            } 
                    }
                
            } else {
                 $message = "Email or Password is wrong";
                 $message_type = "error";
            }

        } else {
             $message = "Email not found";
             $message_type = "error";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System</title>

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

        /* Login Card */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0d47a1;
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
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

     
        .error {
            text-align: center;
            color: red;
            margin-top: 10px;
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
    <div class="logo">🍽️ Canteen Management System</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="#">About</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Contact</a>
    </nav>
</header>

<div class="container">
    <form action="login.php" class="form" method="post">

    <?php if (!empty($message)) { ?>
    <div class="message <?php echo $message_type; ?>">
        <?php echo $message; ?>
    </div>
<?php } ?>


        <h2>Login</h2>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" class="logbutton" name="submit" value="Login">

        <p>Don't have an account? <a href="register.php">Register</a></p>
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
    }, 3000); >
</script>
</body>
</html>