<?php
include "db.php";

if(isset($_POST['submit']))
{
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status='$status' WHERE id='$order_id'";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo "Error: " . mysqli_error($conn);
    } else {
        header("Location: view_orders.php");
        exit();
    }
}
?>