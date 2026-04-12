<?php 

session_start();

include "db.php";

if(isset($_SESSION['user_id']))
    {
        if($_SESSION['user_type']=="user")
            {

               if(isset($_GET['user_id']) && isset($_GET['menu_id']))
                {
                    $user_id=$_GET['user_id'];
                    $item_id=$_GET['menu_id'];
                    $status="pending";


                    $sql="INSERT INTO orders (customer_id,item_id,status) values('$user_id','$item_id','$status')";

                    $result=mysqli_query($conn,$sql);
                    if(!$result)
                        {
                            echo "Error!: $conn->error";
                        }else
                        {
                            $message="order Added Succesfully";
                            header("Location: index.php?added_message=".urlencode($message));
                        }

                }

            }

        if($_SESSION['user_type']=="admin")
            {
                  header("Location:admin_dashboard.php");
            }


    }
    else{
        header("Location:login.php");
        exit();
    }

?>