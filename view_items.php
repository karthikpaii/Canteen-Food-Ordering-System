<?php 

session_start();
include "db.php";

if(isset($_GET['delete_id']))
{
    $id = $_GET['delete_id'];

    // Optional: delete image also
    $getImg = mysqli_query($conn,"SELECT image FROM menu_items WHERE id='$id'");
    $imgData = mysqli_fetch_assoc($getImg);

    if($imgData){
        $imgPath = "image/" . $imgData['image'];
        if(file_exists($imgPath)){
            unlink($imgPath); // delete image file
        }
    }

    $delete = "DELETE FROM menu_items WHERE id='$id'";
    mysqli_query($conn,$delete);

    header("Location:view_items.php?msg=Item Deleted Successfully");
    exit();
}

/* FETCH ITEMS */
if(isset($_SESSION['user_id']))
{
    if($_SESSION['user_type']=="admin")
    {
        $sql="SELECT * from menu_items";
        $result=mysqli_query($conn,$sql);

        if(!$result)
        {
            die("Error!: {$conn->error}");
        }
    }

    if($_SESSION['user_type']=="user")
    {
        header("Location:user_dashboard.php"); 
        exit();
    } 
}
else{
    header("Location:login.php");
    exit();
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
     <a href="view_orders.php">View Orders</a>
</div>

<!-- Header -->
<div class="header">
     <h2>Pallakki Canteen</h2>
    <a href="logout.php">Logout</a>
</div>

<!-- Main -->
<div class="main">

    <div class="table-container">
        <div class="title">Menu Items</div>
<?php if(isset($_GET['msg'])){ ?>
    <p style="color:green; margin-bottom:10px;">
        <?php echo $_GET['msg']; ?>
    </p>
<?php } ?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Category</th>    
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

<?php 
if($result && mysqli_num_rows($result) > 0){
while($row=mysqli_fetch_assoc($result)) { 
?>

<tr>
    <td><?php echo $row['id'];?></td>
    <td><img src="image/<?php echo $row['image'];?>"></td>
    <td><?php echo $row['name'];?></td>
    <td>₹<?php echo $row['price'];?></td>
    <td><?php echo $row['category'];?></td>

    <td>
        <a href="view_items.php?delete_id=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure to delete this item?')"
           style="background:red; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">
           Delete
        </a>
    </td>
</tr>

<?php 
}
}else{
    echo "<tr><td colspan='6'>No items found</td></tr>";
}
?>

</tbody>
        </table>
    </div>

</div>

</body>
</html>