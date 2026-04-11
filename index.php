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
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

.header{
    background:lightcoral;
    padding:40px;
    text-align:center;
}

.navbar{
    display:flex;
    padding:10px;
    background:gray;
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
    padding:10px;
    color:white;
}

.navbar a:hover{
    color:gold;
}

.product{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    padding:20px;
    justify-content:center;
}

.card{
    border:1px solid #ddd;
    padding:15px;
    text-align:center;
    border-radius:8px;
    transition:0.3s;
}

.card img{
    width:200px;
    height:150px;
    object-fit:cover;
    border-radius:5px;
}

.card:hover{
    transform:translateY(-5px);
}

.card a{
    text-decoration:none;
    display:inline-block;
    background-color:red;
    padding:10px;
    color:white;
    margin-top:10px;
    border-radius:5px;
}
</style>
</head>

<body>

<nav class="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
    </ul>

    <ul>
        <?php if(!isset($_SESSION['user_id'])) {?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <?php }?>

        <?php if(isset($_SESSION['user_id'])) {?>
        <li><a href="user_dashboard.php">Dashboard</a></li>
        <?php } ?>
    </ul>
</nav>

<header class="header">
    <h1>Order Your Favourite Item</h1>
    <hr>
</header>

<section class="product">

<?php 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="card">
    <img src="image/<?php echo $row['image']; ?>" width="200">
        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>₹<?php echo htmlspecialchars($row['price']); ?></p>
            <?php if(isset($_SESSION['user_id'])){?>
            <a href="#">Order Now</a>
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

</body>
</html>