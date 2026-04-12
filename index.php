<?php 
session_start();
include "db.php";

$sql = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

/* Background */
body{
    background: linear-gradient(135deg, #667eea, #764ba2);
    min-height:100vh;
    color:#333;
}

/* Navbar */
.navbar{
    display:flex;
    padding:15px 40px;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(10px);
    justify-content:space-between;
    align-items:center;
}

.navbar ul{
    list-style:none;
}

.navbar ul li{
    display:inline-block;
}

.navbar a{
    text-decoration:none;
    padding:10px 15px;
    color:white;
    font-weight:500;
    transition:0.3s;
}

.navbar a:hover{
    color:#ffd700;
}

/* Header */
.header{
    text-align:center;
    padding:50px 20px;
    color:white;
}

.header h1{
    font-size:2.5rem;
    margin-bottom:10px;
}

/* Product Section */
.product{
    display:flex;
    flex-wrap:wrap;
    gap:25px;
    padding:30px;
    justify-content:center;
}

/* Card Design */
.card{
    width:260px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(12px);
    border-radius:15px;
    padding:15px;
    text-align:center;
    color:white;
    box-shadow:0 8px 25px rgba(0,0,0,0.2);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-10px) scale(1.03);
}

/* Image */
.card img{
    width:100%;
    height:160px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:10px;
}

/* Title */
.card h3{
    margin:10px 0;
    font-size:1.2rem;
}

/* Price */
.card p{
    font-size:1.1rem;
    font-weight:600;
    margin-bottom:10px;
}

/* Button */
.card a{
    text-decoration:none;
    display:inline-block;
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    padding:10px 15px;
    color:white;
    border-radius:25px;
    font-size:0.9rem;
    transition:0.3s;
}

.card a:hover{
    background: linear-gradient(45deg, #00c6ff, #0072ff);
}

/* No Items */
h2{
    color:white;
    text-align:center;
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
</style>
</head>

<body>

<nav class="navbar">
    <ul>
        <li><a href="index.php"><h2>PALAKKI CANTEEN</h2></a></li>
    </ul>

    <ul>
        <?php if(!isset($_SESSION['user_id'])) {?>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <?php }?>

        <?php if(isset($_SESSION['user_id'])) {?>
        <li><a href="index.php">Home</a></li>
        <li><a href="user_dashboard.php">Dashboard</a></li>
        <?php } ?>
    </ul>
</nav>

<header class="header">
    <h1>🍽️ Order Your Favourite Item</h1>
</header>
<?php if(isset($_GET['added_message'])){
                
                $message=$_GET['added_message'];
                ?>
                <p> <?php echo $message; ?></p>
                
                <?php } ?>
<section class="product">

<?php 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="card">
            
            <img src="image/<?php echo $row['image']; ?>">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>₹<?php echo htmlspecialchars($row['price']); ?></p>

            <?php if(isset($_SESSION['user_id'])){?>
                <a href="order_item.php?user_id=<?php echo $_SESSION['user_id'] ?> & menu_id=<?php echo $row['id']; ?>">Order Now</a>
            <?php } ?>

            <?php if(!isset($_SESSION['user_id'])){?>
                <a href="login.php">Order Now</a>
            <?php } ?>
        </div>

<?php 
    }
} else {
    echo "<h2>No items found</h2>";
}
?>

</section>
<footer>
    © 2026 Pallakki Canteens | All Rights Reserved
</footer>
</body>
</html>