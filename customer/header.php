<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Furniture House</title>
  <link rel="stylesheet" href="../css/furniture.css" />
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/slider.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab|Lobster">
  <link rel="stylesheet" href="../css/jquery.bxslider.css">

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="../js/jquery.eislideshow.js"></script>
  <script src="../js/jquery.bxSlider.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script async src="../js/script.js"></script>

  <style>
    /* Navbar Layout */
    #navbar { display:flex; justify-content:space-between; align-items:center; padding:10px 20px; background:#f2f2f2; }
    #menu { list-style:none; margin:0; padding:0; display:flex; gap:15px; }
    #menu li { position:relative; }
    #menu li a { text-decoration:none; padding:10px 16px; color:#333; font-weight:bold; border-radius:5px; transition:all 0.3s ease; }
    #menu li a::after { content:""; position:absolute; width:0%; height:3px; left:0; bottom:0; background:#ff6600; transition:width 0.3s; border-radius:2px; }
    #menu li a:hover::after { width:100%; }
    #menu li a:hover { color:#ff6600; }

    /* Search Bar */
    .search-form { display:flex; align-items:center; gap:5px; }
    .search-input { padding:8px 12px; border:2px solid #555; border-radius:20px; outline:none; width:200px; transition:0.3s; }
    .search-input:focus { border-color:#ff6600; box-shadow:0 0 5px rgba(255,102,0,0.6); width:250px; }
    .search-btn { padding:8px 15px; background:#ff6600; border:none; color:#fff; border-radius:20px; cursor:pointer; transition:0.3s; }
    .search-btn:hover { background:#e65c00; }
  </style>
</head>
<body>
<div class="main_wrapper">
  <!--Header-->
  <div class="header_wrapper">
    <a href="../index.php"><img src="../images/logo.jpg" width="200px" height="100px" style="float:left"></a>
    <img src="../images/ad_banner.jpg" width="800px" height="100px" style="float:right">
  </div>

  <!--Navigation Bar-->
  <div id="navbar">
    <ul id="menu">
      <li><a href="../index.php">Home</a></li>
      <li><a href="../all_products.php">All Products</a></li>

      <?php if(!isset($_SESSION['customer_email'])){ ?>
        <li><a href="../customer_register.php">Sign Up</a></li>
      <?php } else { ?>
        <li><a href="../customer/my_account.php">My Account</a></li>
      <?php } ?>

      <li><a href="../cart.php">Shopping Cart</a></li>
      <li><a href="../contact.php">Contact Us</a></li>

      <?php if(!isset($_SESSION['customer_email'])){ ?>
        <li><a href="../checkout.php">Login</a></li>
      <?php } else { ?>
        <li><a href="../logout.php">Logout</a></li>
        <li><a href="../customer/customization.php">Customization</a></li>
      <?php } ?>
    </ul>

    <!-- Search Form -->
    <form method="get" action="../results.php" class="search-form">
      <input type="text" name="user_query" placeholder="🔍 Search products..." class="search-input" required>
      <button type="submit" name="search" class="search-btn">Search</button>
    </form>
  </div>
</div>
