<?php
//session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
 ?>
<?php
include("includes/db.php");

//Getting specific products
if(isset($_GET['edit_pro'])){
  $edit_id=$_GET['edit_pro'];
  $get_edit="select * from products where product_id='$edit_id'";
  $run_edit=mysqli_query($con,$get_edit);
  $row_edit=mysqli_fetch_array($run_edit);

  $update_id=$row_edit['product_id'];
  $p_title=$row_edit['product_title'];
  $cat_id=$row_edit['cat_id'];
  $brand_id=$row_edit['brand_id'];
  $p_image1=$row_edit['product_img1'];
  $p_image2=$row_edit['product_img2'];
  $p_image3=$row_edit['product_img3'];
  $p_price=$row_edit['product_price'];
  $p_desc=$row_edit['product_desc'];
  $p_keywords=$row_edit['product_keywords'];
}

//Get category
$get_cat="select * from categories where cat_id='$cat_id'";
$run_cat=mysqli_query($con,$get_cat);
$cat_row=mysqli_fetch_array($run_cat);
$cat_edit_title=$cat_row['cat_title'];

//Get brand
$get_brand="select * from brands where brand_id='$brand_id'";
$run_brand=mysqli_query($con,$get_brand);
$brand_row=mysqli_fetch_array($run_brand);
$brand_edit_title=$brand_row['brand_title'];
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    form {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 20px;
    }
    .form-group {
      margin-bottom: 18px;
    }
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
      color: #2c3e50;
    }
    input[type="text"], 
    textarea, 
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #dcdcdc;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
    }
    input[type="text"]:focus, 
    textarea:focus, 
    select:focus {
      border-color: #3498db;
    }
    textarea {
      resize: vertical;
    }
    img {
      margin-top: 8px;
      border-radius: 5px;
      border: 1px solid #eee;
    }
    .btn-group {
      text-align: center;
      margin-top: 20px;
    }
    .btn {
      padding: 12px 22px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      margin: 0 10px;
      transition: 0.3s;
    }
    .btn-update {
      background: #3498db;
      color: #fff;
    }
    .btn-update:hover {
      background: #2980b9;
    }
    .btn-delete {
      background: #e74c3c;
      color: #fff;
    }
    .btn-delete:hover {
      background: #c0392b;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center; color:#27ae60; margin:20px 0;">Update or Edit Product</h2>
  <form method="post" action="" enctype="multipart/form-data">

    <div class="form-group">
      <label>Product Title</label>
      <input type="text" name="product_title" value="<?php echo $p_title; ?>">
    </div>

    <div class="form-group">
      <label>Product Category</label>
      <select name="product_cat">
        <option value="<?php echo $cat_id; ?>"><?php echo $cat_edit_title; ?></option>
        <?php
          $get_cats="select * from categories";
          $run_cats=mysqli_query($con, $get_cats);
          while ($row_cats=mysqli_fetch_array($run_cats)) {
            $cat_id=$row_cats['cat_id'];
            $cat_title=$row_cats['cat_title'];
            echo "<option value='$cat_id'>$cat_title</option>";
          }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label>Product Brand</label>
      <select name="product_brand">
        <option value="<?php echo $brand_id; ?>"><?php echo $brand_edit_title; ?></option>
        <?php
          $get_brands="select * from brands";
          $run_brands=mysqli_query($con, $get_brands);
          while ($row_brands=mysqli_fetch_array($run_brands)) {
            $brand_id=$row_brands['brand_id'];
            $brand_title=$row_brands['brand_title'];
            echo "<option value='$brand_id'>$brand_title</option>";
          }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label>Product Image 1</label>
      <input type="file" name="product_img1">
      <br><img src="product_images/<?php echo $p_image1; ?>" width="90" height="90">
    </div>

    <div class="form-group">
      <label>Product Image 2</label>
      <input type="file" name="product_img2">
      <br><img src="product_images/<?php echo $p_image2; ?>" width="90" height="90">
    </div>

    <div class="form-group">
      <label>Product Image 3</label>
      <input type="file" name="product_img3">
      <br><img src="product_images/<?php echo $p_image3; ?>" width="90" height="90">
    </div>

    <div class="form-group">
      <label>Product Price (LKR)</label>
      <input type="text" name="product_price" value="<?php echo $p_price; ?>">
    </div>

    <div class="form-group">
      <label>Product Description</label>
      <textarea name="product_desc" rows="6"><?php echo $p_desc; ?></textarea>
    </div>

    <div class="form-group">
      <label>Product Keywords</label>
      <input type="text" name="product_keywords" value="<?php echo $p_keywords; ?>">
    </div>

    <div class="btn-group">
      <input type="submit" name="update_product" class="btn btn-update" value="Update Product">
      <a href="delete_product.php?delete_pro=<?php echo $update_id; ?>" class="btn btn-delete">Delete Product</a>
    </div>
  </form>
</body>
</html>

<?php
if(isset($_POST['update_product'])) {
  $product_title=$_POST['product_title'];
  $product_cat=$_POST['product_cat'];
  $product_brand=$_POST['product_brand'];
  $product_price=$_POST['product_price'];
  $product_desc=$_POST['product_desc'];
  $status='on';
  $product_keywords=$_POST['product_keywords'];

  $product_img1=$_FILES['product_img1']['name'];
  $product_img2=$_FILES['product_img2']['name'];
  $product_img3=$_FILES['product_img3']['name'];

  $temp_name1=$_FILES['product_img1']['tmp_name'];
  $temp_name2=$_FILES['product_img2']['tmp_name'];
  $temp_name3=$_FILES['product_img3']['tmp_name'];

  $location='product_images/';
  if($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_desc=='' OR $product_keywords=='' OR $product_price=='') {
    echo "<script>alert('Please fill all the fields.')</script>";
    exit();
  }
  else{
    if($temp_name1) {
      $p_image1=$product_img1;
      move_uploaded_file($temp_name1,$location.$product_img1);
    }
    if($temp_name2) {
      $p_image2=$product_img2;
      move_uploaded_file($temp_name2,$location.$product_img2);
    }
    if($temp_name3) {
      $p_image3=$product_img3;
      move_uploaded_file($temp_name3,$location.$product_img3);
    }

    $update_product="update products set cat_id='$product_cat', brand_id='$product_brand',date=NOW(),product_title='$product_title',product_img1='$p_image1',product_img2='$p_image2',product_img3='$p_image3',product_price='$product_price',product_desc='$product_desc',product_keywords='$product_keywords' where product_id='$update_id'";

    $run_update=mysqli_query($con,$update_product);
    if($run_update) {
      echo "<script>alert('Product Updated successfully.')</script>";
      echo "<script>window.open('index.php?view_products','_self')</script>";
    }
  }
}
?>
<?php } ?>
