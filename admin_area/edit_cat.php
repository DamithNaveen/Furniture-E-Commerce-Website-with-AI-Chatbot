<?php
//session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
 ?>
<?php
include ("includes/db.php");
if (isset($_GET['edit_cat'])){
  $cat_id=$_GET['edit_cat'];
  $edit_cat="select * from categories where cat_id='$cat_id'";
  $run_edit=mysqli_query($con,$edit_cat);
  $row_edit=mysqli_fetch_array($run_edit);
  $cat_title=$row_edit['cat_title'];
  $cat_edit_id=$row_edit['cat_id'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Category</title>
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
      box-shadow: 0 3px 12px rgba(0,0,0,0.15);
      text-align: center;
    }
    .form-container h2 {
      margin-bottom: 20px;
      font-size: 22px;
      color: #16a085;
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
      border-color: #16a085;
    }
    .form-container input[type="submit"] {
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      background: #16a085;
      color: #fff;
      font-size: 15px;
      transition: 0.3s;
      margin-top: 10px;
    }
    .form-container input[type="submit"]:hover {
      background: #138d75;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Category</h2>
    <form action="" method="post">
      <input type="text" name="cat_title1" value="<?php echo $cat_title; ?>" required/>
      <input type="submit"  name="update_cat" value="Update Category" />
    </form>
  </div>
</body>
</html>

<?php
if(isset($_POST['update_cat'])){
  $cat_title123=$_POST['cat_title1'];
  $update_cat="update categories set cat_title='$cat_title123' where cat_id='$cat_edit_id'";
  $run_update=mysqli_query($con,$update_cat);
  if($run_update){
    echo "<script>alert('Category has been updated successfully.')</script>";
    echo "<script>window.open('index.php?view_cats','_self')</script>";
  }
}
?>
<?php } ?>
