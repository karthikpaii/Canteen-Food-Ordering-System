<?php 

session_start();

include "db.php";
if(isset($_SESSION['user_id']))
{
    if($_SESSION['user_type']=="admin")
    {
        $sql="SELECT * from menu_items";

        $result=mysqli_query($conn,$sql);

        if(!$result)
        {
            echo "Error!: {$conn->error}";
        }
        else{

        }
    }

    if($_SESSION['user_type']=="user")
    {
        header("Location:user_dashboard.php"); 
    } 
}
else{
    header("Location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Items</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

*{
    padding:0;
    margin:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    display:flex;
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
    justify-content:flex-end;
    align-items:center;
    padding:0 20px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.header a{
    text-decoration:none;
    color:white;
    background:linear-gradient(45deg,#ff416c,#ff4b2b);
    padding:8px 15px;
    border-radius:20px;
    transition:0.3s;
}

.header a:hover{
    background:linear-gradient(45deg,#00c6ff,#0072ff);
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

/* Header */
th{
    background:linear-gradient(45deg,#1e3c72,#2a5298);
    color:white;
    padding:12px;
}

/* Rows */
td{
    padding:12px;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f1f1f1;
}

/* Image */
td img{
    width:80px;
    height:60px;
    object-fit:cover;
    border-radius:6px;
}

/* Title */
.title{
    margin-bottom:15px;
    font-size:20px;
    font-weight:600;
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
</div>

<!-- Header -->
<div class="header">
    <a href="logout.php">Logout</a>
</div>

<!-- Main -->
<div class="main">

    <div class="table-container">
        <div class="title">Menu Items</div>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Category</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row=mysqli_fetch_assoc($result)) { ?>
                
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><img src="image/<?php echo $row['image'];?>"></td>
                <td><?php echo $row['name'];?></td>
                <td>₹<?php echo $row['price'];?></td>
                <td><?php echo $row['category'];?></td>
            </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>

</div>

</body>
</html>