<?php
include("includes/db.php");

$ip = getRealIpAddr();
$get_customer = "SELECT * FROM customers WHERE customer_ip='$ip'";
$run_customer = mysqli_query($con, $get_customer);
$customer = mysqli_fetch_array($run_customer);
$customer_id = $customer['customer_id'];

// You might also have order_id here, depending on your database structure
$get_order = "SELECT * FROM customer_orders WHERE customer_id='$customer_id' AND order_status='Pending' LIMIT 1";
$run_order = mysqli_query($con, $get_order);
$order = mysqli_fetch_array($run_order);
$order_id = $order['order_id'];
?>

<div align="center" style="padding:0px;width: 120%;">
  <h2>Payment Options for you</h2>
  <hr>
  <b>Pay with </b><br>
  <a href="http://www.paypal.com"><img src="images/paypal.png" width="200" height="80"></a> 
  <br><b>Or Cash On Delivery: </b>
  <a href="order.php?c_id=<?php echo $customer_id; ?>">
    <button style="padding:10px 20px; font-size:16px; background-color:#28a745; color:white; border:none; border-radius:5px; transition: 0.3s;">
      Place Order
    </button>
  </a>
  <br><br>
  <!-- Button to confirm offline payment -->
  <b>Already Paid? Confirm your payment:</b><br>
  <a href="customer/confirm.php?order_id=<?php echo $order_id; ?>">
    <button style="padding:10px 20px; font-size:16px; background-color:#007bff; color:white; border:none; border-radius:5px; transition: 0.3s;">
      Confirm Payment
    </button>
  </a>
  <br><br>
  <b>If you selected "Pay Offline", please check your email or account to find the Invoice No. for your order.</b>
</div>

<script>
  // Add hover animations
  const buttons = document.querySelectorAll('button');
  buttons.forEach(btn => {
    btn.addEventListener('mouseover', () => {
      btn.style.transform = 'scale(1.05)';
      btn.style.filter = 'brightness(110%)';
    });
    btn.addEventListener('mouseout', () => {
      btn.style.transform = 'scale(1)';
      btn.style.filter = 'brightness(100%)';
    });
  });
</script>
