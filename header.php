<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title> Furniture House </title>
  <meta charset="utf-8">
  <meta name="description" content="" >
  <meta name="keywords" content="" >
  <meta name="author" content="" >
  <link rel="stylesheet" type="text/css" href="css/furniture.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/slider.css" />
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Lobster" rel="stylesheet">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/jquery.bxslider.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="js/jquery.eislideshow.js"></script>
  <script type="text/javascript" src="js/jquery.bxSlider.min.js"></script>
  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
  <script async="" type="text/javascript" src="js/script.js"></script>

  <style>
    /* Navbar Layout */
    #navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      background: #f2f2f2;
    }

    #menu {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      gap: 15px;
    }

    #menu li {
      display: inline;
    }

    #menu li a {
      text-decoration: none;
      padding: 10px 16px;
      color: #333;
      font-weight: bold;
      border-radius: 5px;
      transition: all 0.3s ease;
      position: relative;
    }

    /* Beautiful hover underline animation */
    #menu li a::after {
      content: "";
      position: absolute;
      width: 0%;
      height: 3px;
      left: 0;
      bottom: 0;
      background: #ff6600;
      transition: width 0.3s;
      border-radius: 2px;
    }

    #menu li a:hover::after {
      width: 100%;
    }

    #menu li a:hover {
      color: #ff6600;
    }

    /* Search Bar Styling */
    .search-form {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .search-input {
      padding: 8px 12px;
      border: 2px solid #555;
      border-radius: 20px;
      outline: none;
      transition: 0.3s;
      width: 200px;
    }

    .search-input:focus {
      border-color: #ff6600;
      box-shadow: 0 0 5px rgba(255, 102, 0, 0.6);
      width: 250px;
    }

    .search-btn {
      padding: 8px 15px;
      background: #ff6600;
      border: none;
      color: #fff;
      border-radius: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .search-btn:hover {
      background: #e65c00;
    }
  </style>
</head>

<body>
  <!--Main Container starts -->
  <div class="main_wrapper">

    <!--Header Starts from here-->
    <div class="header_wrapper">
      <a href="index.php"><img src="images/logo.jpg" width="200px" height="100px" style="float:left"></a>
      <img src="images/ad_banner.jpg" width="800px" height="100px" style="float:right">
    </div>
    <!--Header ends here-->

    <!--Navigation Bar starts -->
    <div id="navbar">
      <ul id="menu">
        <li><a href="index.php" >Home</a></li>
        <li><a href="all_products.php" >All Products</a></li>
        <?php
          if(!isset($_SESSION['customer_email'])){
            echo "<li><a href='customer_register.php'>Sign up</a></li>";
          }else{
            echo "<li><a href='customer/my_account.php'>My Account</a></li>";
          }
        ?>
        <li><a href="cart.php" >Shopping Cart</a></li>
        <li><a href="contact.php" >Contact Us</a></li>
        <?php
          if(!isset($_SESSION['customer_email'])){
            echo "<li><a href='checkout.php' class='login-btn'>Login</a></li>";
          } else {
            echo "<li><a href='logout.php' class='logout-btn'>Logout</a></li>";
          }
        ?>
      </ul>

      <form method="get" action="results.php" enctype="multipart/form-data" class="search-form">
        <input type="text" name="user_query" placeholder="🔍 Search products..." class="search-input" required>
        <button type="submit" name="search" class="search-btn">Search</button>
      </form>
    </div>
    <!--Navigation Bar ends -->
  </div>
</body>
</html>
