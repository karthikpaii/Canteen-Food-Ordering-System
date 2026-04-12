<?php 
session_start();
include "db.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user_type'] != "admin") {
    echo "Access Denied!";
    exit();
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // File upload
    $image = $_FILES['image']['name'];
    $temp_location = $_FILES['image']['tmp_name'];

    $target_folder = "image/";   
    $target_file = $target_folder . basename($image);

    $sql = "INSERT INTO menu_items (image, name, price, category) 
            VALUES ('$image', '$name', '$price', '$category')";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error!: {$conn->error}";
    } else {
        if (move_uploaded_file($temp_location, $target_file)) {
            $message="Item added successfully";
        } else {
            echo "<h3 style='color:red;'>File upload failed</h3>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Items</title>

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

/* Form Card */
.form-container{
    max-width:500px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* Form Title */
.form-container h2{
    text-align:center;
    margin-bottom:20px;
}

/* Inputs */
.form-container input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
    transition:0.3s;
}

.form-container input:focus{
    border-color:#2a5298;
}

/* Button */
.submitBtn{
    background:linear-gradient(45deg,#1e3c72,#2a5298);
    color:white;
    border:none;
    cursor:pointer;
    font-weight:600;
}

.submitBtn:hover{
    background:linear-gradient(45deg,#00c6ff,#0072ff);
}

/* Success Message */
.message{
    background:#d4edda;
    color:#155724;
    padding:10px;
    border-radius:6px;
    text-align:center;
    margin-bottom:10px;
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
    <div class="form-container">

        <h2>Add Menu Item</h2>

        <form method="post" action="add_items.php" enctype="multipart/form-data">

        <?php if(isset($message)){ ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <label>Upload Product Image</label>
        <input type="file" name="image" required>

        <label>Enter Product Name</label>
        <input type="text" name="name" required>

        <label>Enter Product Price</label>
        <input type="number" name="price" step="any" required>

        <label>Enter Product Category</label>
        <input type="text" name="category" required>

        <input class="submitBtn" type="submit" name="submit" value="Add Items">

        </form>

    </div>
</div>

</body>
</html>