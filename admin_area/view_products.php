<?php
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
} else {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f2f5;
    }

    h2 {
      text-align: center;
      color: #16a085;
      margin: 30px 0 20px 0;
      font-size: 28px;
      font-weight: 700;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      overflow: hidden;
      margin-bottom: 50px;
    }

    th, td {
      padding: 15px 10px;
      text-align: center;
      font-size: 16px;
      color: #34495e;
    }

    th {
      background: #16a085;
      color: #fff;
      font-weight: 600;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    img {
      border-radius: 8px;
      max-width: 60px;
      height: auto;
    }

    a {
      text-decoration: none;
      padding: 6px 12px;
      border-radius: 6px;
      color: #fff;
      transition: 0.3s;
      font-size: 14px;
      display: inline-block;
    }

    a.edit {
      background: linear-gradient(135deg,#3498db,#2980b9);
    }

    a.edit:hover {
      background: linear-gradient(135deg,#2980b9,#3498db);
    }

    a.delete {
      background: linear-gradient(135deg,#e74c3c,#c0392b);
    }

    a.delete:hover {
      background: linear-gradient(135deg,#c0392b,#e74c3c);
    }

    @media(max-width:768px){
      th, td {
        padding: 10px 5px;
        font-size: 14px;
      }
      img { max-width: 40px; height: auto; }
      a { font-size: 12px; padding: 5px 10px; }
    }
  </style>
</head>
<body>

  <?php if(isset($_GET['view_products'])) { ?>
    <h2>View All Products</h2>
    <table>
      <tr>
        <th>Product No.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Price (LKR)</th>
        <th>Total Sold</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php
        include("includes/db.php");
        $i=0;
        $get_pro="SELECT * FROM products";
        $run_pro=mysqli_query($con,$get_pro);
        while($row_pro=mysqli_fetch_array($run_pro)){
          $p_id=$row_pro['product_id'];
          $p_title=$row_pro['product_title'];
          $p_img=$row_pro['product_img1'];
          $p_price=$row_pro['product_price'];
          $status=$row_pro['status'];
          $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $p_title; ?></td>
        <td><img src="product_images/<?php echo $p_img; ?>" alt="<?php echo $p_title; ?>"></td>
        <td><?php echo "LKR ".$p_price; ?></td>
        <td>
          <?php
            $get_sold="SELECT * FROM pending_order WHERE product_id='$p_id'";
            $run_sold=mysqli_query($con,$get_sold);
            $count=mysqli_num_rows($run_sold);
            echo $count;
          ?>
        </td>
        <td><?php echo $status; ?></td>
        <td><a class="edit" href="index.php?edit_pro=<?php echo $p_id; ?>"><i class="fas fa-edit"></i> Edit</a></td>
        <td><a class="delete" href="delete_pro.php?delete_pro=<?php echo $p_id; ?>"><i class="fas fa-trash-alt"></i> Delete</a></td>
      </tr>
      <?php } ?>
    </table>
  <?php } ?>

</body>
</html>
<?php } ?>
