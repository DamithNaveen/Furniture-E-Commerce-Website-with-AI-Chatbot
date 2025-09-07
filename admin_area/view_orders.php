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
  <title>View All Orders</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    table {
      width: 95%;
      margin: 40px auto;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 3px 12px rgba(0,0,0,0.15);
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
  <h2>View All Orders</h2>
  <table>
    <tr>
      <th>Order No.</th>
      <th>Customer</th>
      <th>Invoice No.</th>
      <th>Product ID</th>
      <th>QTY</th>
      <th>STATUS</th>
      <th>Delete</th>
    </tr>
    <?php
      include ("includes/db.php");
      $get_orders="select * from pending_order";
      $run_orders=mysqli_query($con,$get_orders);
      $i=0;
      while($row_orders=mysqli_fetch_array($run_orders)){
        $order_id=$row_orders['order_id'];
        $c_id=$row_orders['customer_id'];
        $invoice=$row_orders['invoice_no'];
        $p_id=$row_orders['product_id'];
        $qty=$row_orders['qty'];
        $status=$row_orders['order_status'];
        $i++;
        $c_email="select customer_email from customers where customer_id='$c_id'";
        $run_customer=mysqli_query($con,$c_email);
        $customer_email=mysqli_fetch_array($run_customer);
        $cs_email=$customer_email['customer_email'];
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $cs_email; ?></td>
      <td><?php echo $invoice; ?></td>
      <td><?php echo $p_id; ?></td>
      <td><?php echo $qty; ?></td>
      <td><?php echo $status; ?></td>
      <td><a href="delete_order.php?delete_order=<?php echo $order_id; ?>" class="delete-btn">Delete</a></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
<?php } ?>
