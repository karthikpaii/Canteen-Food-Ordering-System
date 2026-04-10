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
            disply:block;
            padding:10px;
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
    </style>
</head>
<body>
    <div class="header">
        <a href="#">Log Out</a>
    </div>

    <div class="sidebar">
        <a href="admin_dashboard.php">Admin Dashboard</a>
    </div>


    <div class="main">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat quas ipsum vero esse fugit, recusandae suscipit aut adipisci cum corrupti nobis maxime culpa fugiat soluta tempore iure neque dolore facere?
    </div>
</body>
</html>