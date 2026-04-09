<?php

$servername="localhost";
$user="root";
$password="";
$dbname="restaurent_db";


$conn=new mysqli($servername,$user,$password,$dbname);


if(!$conn)
    {
        echo "Error: {$conn->connect_error}";
    }

?>