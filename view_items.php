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
                              echo "Go for User Dashboard";  
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
    <title>Document</title>
    <style>
        *{
            padding:0;
            margin:0;
            overflow-x:hidden;
        }

        .header{
            padding:30px;
            background:black;
            color:white;
            text-align:right;
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
            margin-top:20px;

        }

        .main tr:nth-child(even)
        {
            background:gray;
        }

        .main tr:nth-child(odd)
        {
            background:lightgray;
        }

        .main table
        {
            width:100px;
            border-collapse:collapse;
            text-align:center;

        }

        .main th,td
        {
            padding:10px;
        }

        .main th{

         background:lightblue;
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
    
    <table>
        <thead>
            <th>Id</th>
           <th>image</th>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Item Category</th>
        </thead>

        <tbody>

        <?php  while($row=mysqli_fetch_assoc($result))
            { ?>
                
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><img style="width:100px;" src="image/<?php echo $row['image'];?>"></td>
              <td><?php echo $row['name'];?></td>
              <td><?php echo $row['price'];?></td>
              <td><?php echo $row['category'];?></td>
            </tr>
                
        
           <?php } ?>
        </tbody>
    </table>
</div>


</body>
</html>