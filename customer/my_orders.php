<?php
// Ensure session is started
// session_start();

if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - View Customer Orders</title>
  <style>
    table { border-collapse: collapse; width: 95%; margin: auto; }
    th, td { border: 2px solid black; padding: 8px; text-align: center; }
    th { background-color: #E8AE68; color: #fff; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    tr:hover { background-color: #d1e0e0; }
    a { color: red; text-decoration: none; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>

<h2 style="text-align:center; color:#E8AE68;">My Orders</h2>

<table>
  <tr>
    <th>Order No.</th>
    <th>Invoice No.</th>
    <th>Total Products</th>
    <th>Order Date</th>
    <th>Status</th>
  </tr>

  <?php
  include("includes/db.php");

  // Get all orders with customer details
  $get_orders = "
    SELECT o.*, c.customer_name, c.customer_email 
    FROM customer_orders o
    JOIN customers c ON o.customer_id = c.customer_id
    ORDER BY o.order_id DESC
  ";
  $run_orders = mysqli_query($con, $get_orders);

  $i = 0;
  while($row = mysqli_fetch_array($run_orders)){
      $i++;
      $order_id = $row['order_id'];
      $customer_name = $row['customer_name'];
      $customer_email = $row['customer_email'];
      $invoice_no = $row['invoice_no'];
      $total_products = $row['total_products'];
      $order_date = $row['order_date'];
      $status = ($row['order_status'] == 'Pending') ? 'Unpaid' : 'Paid';
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $invoice_no; ?></td>
    <td><?php echo $total_products; ?></td>
    <td><?php echo $order_date; ?></td>
    <td><?php echo $status; ?></td>
   
  </tr>
  <?php } ?>
</table>

</body>
</html>
