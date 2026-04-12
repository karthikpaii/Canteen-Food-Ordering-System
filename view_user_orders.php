<?php 

session_start();
include "db.php";

if(isset($_SESSION['user_id']))
{
    if($_SESSION['user_id'])
    {
        if($_SESSION['user_type']=="user")
        {
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT 
                users.id AS user_id,
                users.name AS user_name,
                users.email,
                users.address,
                users.phone,

                menu_items.id AS item_id,
                menu_items.image,
                menu_items.name AS item_name,
                menu_items.price,
                menu_items.category,

                orders.id AS order_id,
                orders.status,
                orders.order_date

                FROM orders 
                JOIN users ON orders.customer_id = users.id  
                JOIN menu_items ON orders.item_id = menu_items.id
                WHERE orders.customer_id='$user_id'";

            $result = mysqli_query($conn, $sql);

            if(!$result)
            {
                die("SQL Error: " . mysqli_error($conn));
            }
        }

        if($_SESSION['user_type']=="admin")
        {
            header("Location:admin_dashboard.php"); 
            exit();
        } 
    }
    else{
        header("Location:login.php");
        exit();
    }
}
else{
    header("Location:login.php");
    exit();
}

if(isset($_GET['delete_id'])){
    $order_id = $_GET['delete_id'];

    $delete = "DELETE FROM orders WHERE id='$order_id'";

    if(mysqli_query($conn, $delete)){
        header("Location:view_user_orders.php");
        exit();
    } else {
        echo "Error deleting order";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Orders</title>

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

/* Table Container */
.table-container{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    overflow-x:auto;
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    text-align:center;
}

th{
    background:linear-gradient(45deg,#1e3c72,#2a5298);
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f1f1f1;
}

/* ✅ FIXED IMAGE SIZE */
td img{
    width:70px;
    height:50px;
    object-fit:cover;
    border-radius:6px;
}

/* Status */
.status{
    padding:5px 10px;
    border-radius:10px;
    color:white;
    font-size:12px;
}

.pending{
    background:orange;
}

.delivered{
    background:green;
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
     <h2> Pallakki Canteen</h2>
    <a href="logout.php">Logout</a>
</div>

<!-- Main -->
<div class="main">

<div class="table-container">
<h3>Your Orders</h3>

<table>
<thead>
<tr>
    <th>Customer ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Address</th>
    <th>Phone</th>

    <th>Item ID</th>
    <th>Image</th>
    <th>Item Name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Order Date</th>
    <th>Order ID</th>
    <th>Status</th>
    <th>Cancel</th>
</tr>
</thead>

<tbody>

<?php 
if($result && mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_assoc($result)) { 
?>

<tr>
    <td><?php echo $row['user_id'];?></td>
    <td><?php echo $row['user_name'];?></td>
    <td><?php echo $row['email'];?></td>
    <td><?php echo $row['address'];?></td>
    <td><?php echo $row['phone'];?></td>

    <td><?php echo $row['item_id'];?></td>
    <td><img src="image/<?php echo $row['image'];?>"></td>
    <td><?php echo $row['item_name'];?></td>
    <td><?php echo $row['category'];?></td>
    <td>₹<?php echo $row['price'];?></td>
    <td>
     <?php echo date("d-m-Y h:i A", strtotime($row['order_date'])); ?>
</td>
    <td><?php echo $row['order_id'];?></td>
    <td>
        <span class="status <?php echo strtolower($row['status']); ?>">
            <?php echo ucfirst($row['status']); ?>
        </span>
    </td>
    <td>
<?php if($row['status'] == 'pending'){ ?>
    
    <a href="view_user_orders.php?delete_id=<?php echo $row['order_id']; ?>" 
       onclick="return confirm('Are you sure to cancel this item?')"
       style="background:red; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">
       Cancel
    </a>

<?php } else { ?>

    <button disabled 
        style="background:gray; color:white; padding:5px 10px; border-radius:5px; border:none; cursor:not-allowed;">
        Cancel
    </button>

<?php } ?>
</td>
</tr>

<?php 
}
}else{
    echo "<tr><td colspan='12'>No Orders Found</td></tr>";
}
?>

</tbody>
</table>

</div>

</div>

</body>
</html>