<?php
include("includes/db.php");
include("functions/functions.php");

// Getting customer details
if(isset($_GET['c_id'])){
  $customer_id = $_GET['c_id'];
  $c_email_query = "SELECT * FROM customers WHERE customer_id='$customer_id'";
  $run_email = mysqli_query($con, $c_email_query);
  $r_email = mysqli_fetch_array($run_email);
  $customer_email = $r_email['customer_email'];
  $customer_name = $r_email['customer_name'];
}

// Getting products from cart
$ip_add = getRealIpAddr();
$total = 0;
$sel_price = "SELECT * FROM cart WHERE ip_add='$ip_add'";
$run_price = mysqli_query($con, $sel_price);
$status = 'Pending';
$invoice_no = mt_rand(1000,9999); // Random invoice number
$count_pro = mysqli_num_rows($run_price);

$order_details = ""; // To store products for email
$sub_total = 0;
$i = 1;

while($record = mysqli_fetch_array($run_price)){
  $pro_id = $record['p_id'];
  $pro_qty = $record['qty'];

  $pro_price_query = "SELECT * FROM products WHERE product_id='$pro_id'";
  $run_pro_price = mysqli_query($con, $pro_price_query);
  $p_price = mysqli_fetch_array($run_pro_price);

  $product_name = $p_price['product_title'];
  $product_price = $p_price['product_price'];
  $total_price = $product_price * $pro_qty;

  $sub_total += $total_price;

  // Append to email table
  $order_details .= "
    <tr>
      <td>$i</td>
      <td>$product_name</td>
      <td>$pro_qty</td>
      <td>$total_price</td>
      <td>$invoice_no</td>
    </tr>
  ";

  // Insert each product into pending_order
  $insert_to_pending_orders = "
    INSERT INTO pending_order (customer_id, invoice_no, product_id, qty, order_status)
    VALUES ('$customer_id','$invoice_no','$pro_id','$pro_qty','$status')
  ";
  mysqli_query($con, $insert_to_pending_orders);

  $i++;
}

// Insert order into customer_orders
$insert_order = "
  INSERT INTO customer_orders (customer_id, due_amount, invoice_no, total_products, order_date, order_status)
  VALUES ('$customer_id','$sub_total','$invoice_no','$count_pro',NOW(),'$status')
";
mysqli_query($con, $insert_order);

// Empty the cart
$empty_cart = "DELETE FROM cart WHERE ip_add='$ip_add'";
mysqli_query($con, $empty_cart);

// Prepare email
$subject = "Order Details from mysite.com";
$headers = "From: admin@mysite.com\r\n";
$headers .= "Content-type: text/html\r\n";

$message = "
<html>
  <body>
    <p>Hello $customer_name,</p>
    <p>You have ordered the following products on our website. Please find your order details below and pay the dues as soon as possible.</p>
    <table width='600' align='center' bgcolor='#E3A587' border='2' cellpadding='5' cellspacing='0'>
      <tr>
        <th>S.N</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Invoice No.</th>
      </tr>
      $order_details
    </table>
    <h3>Please go to your account and pay the dues.</h3>
    <h2><a href='https://mysite.com'>Click here</a> to login to your account.</h2>
    <h3>Thank you for ordering on www.mysite.com</h3>
  </body>
</html>
";

// Send email
mail($customer_email, $subject, $message, $headers);

// Alert and redirect customer
echo "<script>alert('Your order has been placed successfully. Order details have been sent to $customer_email.');</script>";
echo "<script>window.location.href='customer/my_account.php';</script>";
exit();
?>
