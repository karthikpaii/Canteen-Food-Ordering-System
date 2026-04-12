<?php 
session_start();
include "db.php";

$sql = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<?php 
session_start();
include "db.php";

/* ✅ ORDER LOGIC (same page) */
if(isset($_GET['menu_id']) && isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
    $menu_id = $_GET['menu_id'];

    $insert = "INSERT INTO orders (customer_id, item_id, status) 
               VALUES ('$user_id','$menu_id','pending')";

    if(mysqli_query($conn,$insert)){
        $message = "Item added successfully ✅";
    } else {
        $message = "Error adding item ❌";
    }
}

/* FETCH ITEMS */
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
<title>Items</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

/* Body */
body{
 
    background:#f4f6f9;
}

/* Sidebar (same as dashboard) */
.sidebar{
    width:250px;
    height:100vh;
    background:linear-gradient(180deg,#1e3c72,#2a5298);
    color:white;
    position:fixed;
    top:0;
    left:0;
    padding-top:20px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    text-decoration:none;
    display:block;
    padding:15px 20px;
    color:white;
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
    padding-left:30px;
}

/* Header */
.header{
    position:fixed;
    left:250px;
    top:0;
    width:calc(100% - 250px);
    height:60px;
    background:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 20px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.header h2{
    color:#333;
}

.header a{
    text-decoration:none;
    color:white;
    background:linear-gradient(45deg,#ff416c,#ff4b2b);
    padding:8px 15px;
    border-radius:20px;
}

/* Main */
.main{
    margin-left:250px;
    margin-top:80px;
    padding:20px;
    width:100%;
}

/* Products */
.product{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

/* Card */
.card{
    width:220px;
    background:white;
    border-radius:10px;
    padding:15px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
  
}

.card:hover{
    transform:translateY(-5px);
}

.card img{
    width:100%;
    height:140px;
    object-fit:cover;
    border-radius:8px;
}

.card h3{
    margin-top:10px;
}

.card p{
    margin:5px 0;
}

/* Button */
.card a{
    display:inline-block;
    margin-top:10px;
    padding:8px 12px;
    background:#ff416c;
    color:white;
    border-radius:20px;
    text-decoration:none;
}

.card a:hover{
    background:#0072ff;
}

/* Message */
.message{
    margin-bottom:15px;
    color:green;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>User Panel</h2>
    <a href="user_dashboard.php">Dashboard</a>
    <a href="view_user_orders.php">View Orders</a>
    <a href="items.php">Menu Items</a>
</div>

<!-- Header -->
<div class="header">
    <h2>Pallakki Canteen</h2>
    <a href="logout.php">Logout</a>
</div>
<?php if(isset($_GET['added_message'])){
                
                $message=$_GET['added_message'];
                ?>
                <p> <?php echo $message; ?></p>
                
                <?php } ?>
<!-- Main -->
<div class="main">

<?php if(isset($message)){ ?>
    <p class="message"><?php echo $message; ?></p>
<?php } ?>
<div class="product">

<?php 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="card">
        <img src="image/<?php echo $row['image']; ?>">
        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
        <p>₹<?php echo htmlspecialchars($row['price']); ?></p>

        <?php if(isset($_SESSION['user_id'])){ ?>
            <a href="items.php?user_id=<?php echo $_SESSION['user_id']; ?>&menu_id=<?php echo $row['id']; ?>">
                Order Now
            </a>
        <?php } else { ?>
            <a href="login.php">Order Now</a>
        <?php } ?>
    </div>

<?php 
    }
} else {
    echo "<h2>No items found</h2>";
}
?>

</div>

</div>
<script>
setTimeout(() => {
    const msg = document.querySelector('.message');
    if(msg) msg.style.display = 'none';
}, 3000);
</script>
</body>
</html>