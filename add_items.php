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
    <title>Document</title>
    <style>
        *{
            padding:0;
            margin:0;
        }

        .header{
            padding:30px;
            background:black;
            color:white;
            text-align:right;
;
        }

        .sidebar{
            background:black;
            color:white;
            position:fixed;
            top:0;
            height:100%;
            width:20%;
            border:1px solid blue;
            text-align:center;
        }

        .sidebar a{
            text-decoration:none;
            display:block;
            padding:30px 10px;
            margin:0;
            color:white;
            
        }

        .sidebar  a:hover{
            background:green;   
        }

        .header a{
            text-decoration:none;
            color:white;
            padding:20px;
            background:red;
        }

        .main{
            margin-left:300px;
            margin-top:20px;l
        }

        .main form
        {
            background:lightcyan;
            padding:30px;
            margin-right:20px;
            text-align:center;
        }

        .main input{
            margin-left:200px;
            margin-top:10px;
            padding:20px;
            border:2px solid blue; 
            display:block;
            
        }
        .submitBtn
        {
            background:blue;
            color:white;
        }

    </style>
</head>
<body>
    <div class="header">
        <a href="logout.php">Log Out</a>
    </div>

    <div class="sidebar">
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="add_items.php">Add Menu Items</a>
        <a href="view_items.php">View Menu Items</a>
    </div>


    <div class="main">
       <form method="post" action="add_items.php" enctype="multipart/form-data">

       <?php if(isset($message)){
        ?>
        <p class="message"><?php echo $message;
        ?></p>
        <?php }?>
    Upload Product Image  
    <input type="file" name="image" required>

    Enter Product Name  
    <input type="text" name="name" required>

    Enter Product Price  
    <input type="number" name="price" step="any" required>

    Enter Product Category  
    <input type="text" name="category" required>

    <input class="submitBtn" type="submit" name="submit" value="Add Items">

</form>


     </div>


</body>
</html>