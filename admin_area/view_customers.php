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
  <title>View All Customers</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    table {
      width: 90%;
      margin: 40px auto;
      border-collapse: collapse;
      box-shadow: 0 3px 12px rgba(0,0,0,0.15);
      background: #fff;
    }
    th {
      background-color: #16a085;
      color: #fff;
      padding: 12px;
      font-size: 16px;
    }
    td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    img {
      border-radius: 50%;
      border: 2px solid #16a085;
    }
    a.delete-btn {
      padding: 6px 12px;
      background: #e74c3c;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-size: 13px;
      transition: 0.3s;
    }
    a.delete-btn:hover {
      background: #c0392b;
    }
    h2 {
      text-align: center;
      color: #16a085;
      margin-top: 40px;
      margin-bottom: 20px;
      font-size: 22px;
    }
  </style>
</head>
<body>
  <h2>View All Customers</h2>
  <table>
    <tr>
      <th>S.N</th>
      <th>Name</th>
      <th>Email</th>
      <th>Image</th>
      <th>Country</th>
      <th>Delete</th>
    </tr>
    <?php
      include ("includes/db.php");
      $get_c="select * from customers";
      $run_c=mysqli_query($con,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){
        $c_id=$row_c['customer_id'];
        $c_name=$row_c['customer_name'];
        $c_email=$row_c['customer_email'];
        $c_image=$row_c['customer_image'];
        $c_country=$row_c['customer_country'];
        $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $c_name; ?></td>
      <td><?php echo $c_email; ?></td>
      <td><img src="../customer/customer_photos/<?php echo $c_image; ?>" width="60" height="60"/></td>
      <td><?php echo $c_country; ?></td>
      <td><a href="delete_customer.php?delete_c=<?php echo $c_id; ?>" class="delete-btn">Delete</a></td>
    </tr>
  <?php } ?>
  </table>
</body>
</html>
<?php } ?>
