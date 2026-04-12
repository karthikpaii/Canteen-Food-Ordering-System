<?php 

session_start();
if(isset($_SESSION['user_id']))
{
    if($_SESSION['user_id'])
    {
        if($_SESSION['user_type']=="admin")
        {
           
        }

        if($_SESSION['user_type']=="user")
        {
            header("Location:user_dashboard.php"); 
        } 
    }
    else{
        header("Location:login.php");
    }
}
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


.main{
    margin-left:250px;
    margin-top:80px;
    padding:20px;
}

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


.main p{
    margin-top:20px;
    line-height:1.6;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="add_items.php">Add Menu Items</a>
    <a href="view_items.php">View Menu Items</a>
    <a href="view_orders.php">View Orders</a>
</div>

<!-- Header -->
<div class="header">
     <h2>Pallakki Canteen</h2>
    <a href="logout.php">Logout</a>
</div>

<!-- Main Content -->
<div class="main">

   
    <div class="card-container">
        <div class="card">
            <h3>Total Items</h3>
            <p>Manage your menu items</p>
        </div>

        <div class="card">
            <h3>Orders</h3>
            <p>View customer orders</p>
        </div>

        <div class="card">
            <h3>Update</h3>
            <p>Update Order Status</p>
        </div>
    </div>

    

</div>

</body>
</html>