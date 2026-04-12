<?php 

session_start();
if(isset($_SESSION['user_id']))
{
    if($_SESSION['user_id'])
    {
        if($_SESSION['user_type']=="user")
        {
           
        }

        if($_SESSION['user_type']=="admin")
        {
            header("Location:admin_dashboard.php"); 
        } 
    }
    else{
        header("Location:login.php");
    }
}

?>

<?php
include "db.php";

$user_id = $_SESSION['user_id'];

// Total Menu Items
$item_sql = "SELECT COUNT(*) AS total_items FROM menu_items";
$item_result = mysqli_query($conn, $item_sql);
$item_data = mysqli_fetch_assoc($item_result);
$total_items = $item_data['total_items'];

// Total Orders (for logged-in user)
$order_sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE customer_id='$user_id'";
$order_result = mysqli_query($conn, $order_sql);
$order_data = mysqli_fetch_assoc($order_result);
$total_orders = $order_data['total_orders'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

*{
    padding:0;
    margin:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

/* Body */
body{
   
    background:#f4f6f9;
}

/* Sidebar */
.sidebar{
    width:250px;
    height:100vh;
    background:linear-gradient(180deg,#1e3c72,#2a5298);
    color:white;
    position:fixed;
    top:0;
    left:0;
    padding-top:20px;
    box-shadow:2px 0 10px rgba(0,0,0,0.2);
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
    font-size:15px;
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

/* Main Content */
.main{
    margin-left:250px;
    margin-top:80px;
    padding:20px;
}

/* Cards (optional dashboard blocks) */
.card-container{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    flex:1;
    min-width:200px;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h3{
    margin-bottom:10px;
}

/* Content text */
.main p{
    margin-top:20px;
    line-height:1.6;
}



</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>User Panel</h2>
    <a href="user_dashboard.php">Dashboard</a>
    <a href="view_user_orders.php">view Orders</a>
    <a href="items.php">Items</a>
    
</div>

<!-- Header -->
<div class="header">
    <h2>Pallakki Canteen</h2>
    <a href="logout.php">Logout</a>
</div>

<!-- Main Content -->
<div class="main">

    <!-- Optional Dashboard Cards -->
    <div class="card-container">
        <div class="card">
    <h3>Total Items</h3>
    <p><?php echo $total_items; ?> Items Available</p>
</div>

<div class="card">
    <h3>Your Orders</h3>
    <p><?php echo $total_orders; ?> Orders Placed</p>
</div>
<?php
$delivered_sql = "SELECT COUNT(*) AS delivered_orders 
                  FROM orders 
                  WHERE customer_id='$user_id' AND status='delivered'";
$delivered_result = mysqli_query($conn, $delivered_sql);
$delivered_data = mysqli_fetch_assoc($delivered_result);
$delivered_orders = $delivered_data['delivered_orders'];
?>

<div class="card">
    <h3>Delivered Orders</h3>
    <p><?php echo $delivered_orders; ?> Completed</p>
</div>
        </div>
    </div>

</div>
</div>

</body>
</html>