<?php
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
} else {
 ?>
<?php
include("includes/db.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Insert Product</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f2f5;
    }

    .content-wrapper {
      max-width: 900px;
      margin: 50px auto;
      padding: 0 20px;
    }

    h2 {
      text-align: center;
      color: #16a085;
      margin-bottom: 40px;
      font-size: 28px;
      font-weight: 700;
    }

    form table {
      width: 100%;
      border-collapse: collapse;
    }

    form td {
      padding: 12px 10px;
      vertical-align: middle;
    }

    form td:first-child {
      text-align: right;
      width: 25%;
      font-weight: 600;
      color: #34495e;
    }

    form input[type="text"],
    form select,
    form textarea,
    form input[type="file"] {
      width: 100%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
      box-sizing: border-box;
    }

    form textarea { resize: none; }

    form input[type="submit"] {
      background: #16a085;
      color: #fff;
      padding: 12px 25px;
      font-size: 18px;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
    }

    form input[type="submit"]:hover {
      background: #1abc9c;
    }

    @media(max-width:768px){
      form td { display: block; width: 100%; text-align: left; padding: 10px 0; }
      form td:first-child { margin-bottom: 5px; }
    }
  </style>
</head>
<body>

<div class="content-wrapper">
  <h2>Insert New Product</h2>
  <form method="post" action="" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Product Title</td>
        <td><input type="text" name="product_title" required></td>
      </tr>
      <tr>
        <td>Product Category</td>
        <td>
          <select name="product_cat" required>
            <option>Select a Category</option>
            <?php
                $get_cats="SELECT * FROM categories";
                $run_cats=mysqli_query($con, $get_cats);
                while ($row_cats=mysqli_fetch_array($run_cats)) {
                  $cat_id=$row_cats['cat_id'];
                  $cat_title=$row_cats['cat_title'];
                  echo "<option value='$cat_id'>$cat_title</option>";
                }
             ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Product Brand</td>
        <td>
          <select name="product_brand" required>
            <option>Select Brand</option>
            <?php
                $get_brands="SELECT * FROM brands";
                $run_brands=mysqli_query($con, $get_brands);
                while ($row_brands=mysqli_fetch_array($run_brands)) {
                  $brand_id=$row_brands['brand_id'];
                  $brand_title=$row_brands['brand_title'];
                  echo "<option value='$brand_id'>$brand_title</option>";
                }
             ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Product Image 1</td>
        <td><input type="file" name="product_img1" required></td>
      </tr>
      <tr>
        <td>Product Image 2</td>
        <td><input type="file" name="product_img2"></td>
      </tr>
      <tr>
        <td>Product Image 3</td>
        <td><input type="file" name="product_img3"></td>
      </tr>
      <tr>
        <td>Product Price</td>
        <td><input type="text" name="product_price" required></td>
      </tr>
      <tr>
        <td>Product Description</td>
        <td><textarea name="product_desc" cols="30" rows="6" required></textarea></td>
      </tr>
      <tr>
        <td>Product Keywords</td>
        <td><input type="text" name="product_keywords" required></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" name="insert_product" value="Insert Product">
        </td>
      </tr>
    </table>
  </form>
</div>

</body>
</html>

<?php
if(isset($_POST['insert_product'])){
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

  if($product_title=='' || $product_cat=='' || $product_brand=='' || $product_desc=='' || $product_keywords=='' || $product_price=='' || $product_img1==''){
    echo "<script>alert('Please fill all the fields.')</script>";
    exit();
  } else {
    $location='product_images/';
    move_uploaded_file($temp_name1,$location.$product_img1);
    move_uploaded_file($temp_name2,$location.$product_img2);
    move_uploaded_file($temp_name3,$location.$product_img3);

    $insert_product="INSERT INTO products (cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,status,product_keywords) 
    VALUES ('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$status','$product_keywords')";

    $run_product=mysqli_query($con,$insert_product);
    if($run_product){
      echo "<script>alert('Product inserted successfully.')</script>";
      echo "<script>window.open('index.php?insert_product','_self')</script>";
    } else {
      echo "<script>alert('Product insertion failed.')</script>";
    }
  }
}
?>
<?php } ?>
