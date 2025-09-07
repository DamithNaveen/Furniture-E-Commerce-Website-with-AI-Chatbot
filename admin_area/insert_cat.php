<?php
//session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
 ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Insert Category</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    .form-container {
      max-width: 450px;
      margin: 60px auto;
      background: #fff;
      padding: 30px 25px;
      border-radius: 10px;
      box-shadow: 0px 3px 12px rgba(0,0,0,0.15);
      text-align: center;
    }
    .form-container h2 {
      margin-bottom: 20px;
      font-size: 22px;
      color: #16a085; /* updated green */
    }
    .form-container input[type="text"] {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
    }
    .form-container input[type="text"]:focus {
      border-color: #16a085; /* updated green */
    }
    .form-container input[type="submit"] {
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      background: #16a085; /* updated green */
      color: #fff;
      font-size: 15px;
      transition: 0.3s;
      margin-top: 10px;
    }
    .form-container input[type="submit"]:hover {
      background: #138d75; /* slightly darker shade for hover */
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Insert New Category</h2>
    <form action="" method="post">
      <input type="text" name="cat_title" placeholder="Enter Category Title" required/>
      <input type="submit"  name="insert_cat" value="Insert Category" />
    </form>
  </div>

  <?php
  include ("includes/db.php");
  if (isset($_POST['insert_cat'])){
    $cat_title=$_POST['cat_title'];
    $insert_cat="insert into categories (cat_title) values ('$cat_title')";
    $run_cat=mysqli_query($con,$insert_cat);
    if($run_cat){
      echo "<script>alert('New Category has been added successfully.')</script>";
      echo "<script>window.open('index.php?view_cats','_self')</script>";
    }
  }
   ?>
</body>
</html>
<?php } ?>
