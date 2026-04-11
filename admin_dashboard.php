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
        Lorem, Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente ut, recusandae illum assumenda voluptatem alias id repellendus, reprehenderit tenetur consectetur, excepturi nesciunt quo? Dicta sed culpa temporibus cupiditate, aspernatur officiis at dolorem veniam voluptatem, dolor maiores eius, debitis labore? At suscipit dicta dolorem voluptates vitae incidunt tempora velit adipisci. Voluptatibus nesciunt corrupti similique quos itaque! Deserunt sapiente error tenetur commodi repellendus minus est aspernatur delectus nisi laborum iusto ad rerum, molestiae quasi odio. Voluptates nulla eaque commodi exercitationem culpa alias aut dolore necessitatibus, consectetur eos distinctio odit ea debitis sapiente fugit fuga consequuntur illum voluptatum vel delectus maxime molestias hic vitae. Unde dignissimos quisquam aut rem vitae reprehenderit quod cupiditate pariatur. Ullam quis harum distinctio eum quisquam ab! Fuga deleniti nesciunt nobis dolore blanditiis nam veniam distinctio eum earum, tempora quisquam repudiandae nihil, commodi animi labore quidem nisi dicta magnam repellendus beatae reprehenderit sequi, quas asperiores corporis? Velit magnam rerum inventore dignissimos, qui voluptatibus, autem, perferendis voluptatem aperiam facilis cupiditate omnis eligendi quam deleniti laudantium ducimus consequuntur consectetur dolore molestias maxime. Praesentium, doloremque nesciunt. Ducimus ex ipsum, sit velit consequatur labore ipsam nisi rerum deserunt dolore vitae eligendi quasi, exercitationem quos assumenda laudantium laboriosam. Illo impedit culpa, nesciunt maxime explicabo ipsam facere, perferendis commodi voluptates facilis eaque distinctio cum, enim laudantium labore sunt libero! Et voluptatum vel tenetur modi minima corporis sed possimus? Corporis perspiciatis, similique consectetur iste quisquam nihil, commodi distinctio dignissimos neque alias ab odio voluptatem. Facere quaerat iste eius, voluptas aspernatur earum, ipsam nihil dolorem, corrupti possimus recusandae. Quas expedita quasi voluptate ab velit nisi totam doloremque eligendi voluptatibus ea, quae repellendus repellat ipsa quia fugiat, mollitia excepturi minima dolore tempora ducimus est deleniti itaque adipisci! Aliquam nam vitae incidunt nihil est? Repudiandae voluptas, sequi distinctio vitae aut esse doloremque voluptate sunt veritatis rerum eum! Aspernatur ut maiores tempore? Laboriosam autem incidunt atque quasi, id explicabo totam neque pariatur et sunt, dicta quaerat tempora ullam. Iusto repudiandae molestias iste voluptatum repellat inventore reprehenderit esse quod rem illum quos excepturi, qui quisquam accusamus delectus distinctio, nihil tempora.um dolor sit amet consectetur adipisicing elit. Repellat quas ipsum vero esse fugit, recusandae suscipit aut adipisci cum corrupti nobis maxime culpa fugiat soluta tempore iure neque dolore facere?
    </div>


</body>
</html>