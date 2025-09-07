<?php
//session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
?>
<?php
include ("includes/db.php");
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>View Brands</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    .table-container {
      max-width: 900px;
      margin: 50px auto;
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    }
    .table-container h2 {
      text-align: center;
      color: #16a085;
      margin-bottom: 25px;
      font-size: 24px;
      text-decoration: underline;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #16a085;
      color: #fff;
      border-radius: 6px 6px 0 0;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    a.edit-btn, a.delete-btn {
      text-decoration: none;
      padding: 6px 12px;
      border-radius: 5px;
      color: #fff;
      font-weight: bold;
      transition: 0.3s;
    }
    a.edit-btn {
      background-color: #27ae60;
    }
    a.edit-btn:hover {
      background-color: #1e8449;
    }
    a.delete-btn {
      background-color: #e74c3c;
    }
    a.delete-btn:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>
  <div class="table-container">
    <h2>View All Brands</h2>
    <table>
      <tr>
        <th>Brand ID</th>
        <th>Brand Title</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php
      $get_brands="select * from brands";
      $run_brands=mysqli_query($con,$get_brands);
      while($row_brands=mysqli_fetch_array($run_brands)){
        $brand_id=$row_brands['brand_id'];
        $brand_title=$row_brands['brand_title'];
      ?>
      <tr>
        <td><?php echo $brand_id; ?></td>
        <td><?php echo $brand_title; ?></td>
        <td><a class="edit-btn" href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
        <td><a class="delete-btn" href="index.php?delete_brand=<?php echo $brand_id; ?>">Delete</a></td>
      </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>
<?php } ?>
