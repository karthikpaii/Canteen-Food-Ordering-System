<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    *{
        margin:0;
        padding:0;
        overflow-x:hidden;
    }
    .header{
        background:lightcoral;
        padding:40px;
        text-align:center;
    }

    .navbar
    {
        display:flex;
        padding:10px;
        background:gray;
        justify-content:space-between;
        align-items:center;
        
    }

.navbar a{
    text-decoration:none;
    padding:10px;
   
    color:white;

}

.navbar a:hover{
    color:gold;
}
    .navbar ul li
    {
        list-style:none;
        padding:10px;
        display:inline-block;
    }
    .navbar  ul li a
    {
        text-decoration:none;
       display:inline-block;
       color:white;
        
    }

    .header h1
    {
        margin-bottom:10px;
    }

.card img
{
   width:300px;
   border-radius:5px;
}

.product
{
    display:flex;
    flex-wrap:wrap;
   padding:20px;

}
.card:hover
{
    transform:translateY(-5px);
}
.card a {
    text-decoration:none;
    display:inline-block;
    background-color:red;
    padding:10px;
    color:white;
}
</style>
</head>
<body>
    <nav class="navbar">
         <li><a href="index.php">Home</a></li>
        <ul>
           
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="#">Dashboard</a></li>
        </ul>
    </nav>
<header class="header">
    <h1>Order Your Favourite Item</h1>
    <hr>
</header>

<section class="product">
   
    <div class="card">
   <img  src="image/chicken.png">
   <h3>Product 1</h3>
   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, saepe?</p>
    <a href="#">Buy Now</a>

   </div>
   
</section>
</body>
</html>