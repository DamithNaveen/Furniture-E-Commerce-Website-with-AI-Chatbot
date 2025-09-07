<?php
session_start();
include("includes/db.php");
if(isset($_GET['order_id'])){
  $order_id=$_GET['order_id'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>Confirm Payment</title>
  <style>
    body {
      background-color: #1a1a1a;
      font-family: Arial, sans-serif;
      color: #fff;
    }
    form {
      margin: 30px auto;
      width: 600px;
      background: #2c2c2c;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.5);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td {
      padding: 10px;
    }
    input[type=text], select {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #555;
      background-color: #3a3a3a;
      color: #fff;
      box-sizing: border-box;
    }
    input[type=text]:focus, select:focus {
      border-color: #00bfff;
      outline: none;
      box-shadow: 0 0 5px #00bfff;
    }
    input[type=submit] {
      background-color: #28a745;
      color: #fff;
      padding: 12px 25px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    input[type=submit]:hover {
      background-color: #218838;
      transform: scale(1.05);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #00bfff;
    }
    option {
      background-color: #3a3a3a;
      color: #fff;
    }
  </style>
</head>
<body>
  <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post">
    <table border="0">
      <tr align="center">
        <td colspan="2"><h2>Please Confirm Your Payment</h2></td>
      </tr>
      <tr>
        <td align="right">Invoice No.</td>
        <td><input type="text" name="invoice_no"/></td>
      </tr>
      <tr>
        <td align="right">Amount Sent:</td>
        <td><input type="text" name="amount"/></td>
      </tr>
      <tr>
        <td align="right">Select Payment Mode:</td>
        <td>
          <select name="payment_method">
            <option>Select Payment</option>
            <option>Bank Transfer</option>
            <option>Easypay/UBL Transfer</option>
            <option>Western Union</option>
            <option>Paypal</option>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right">Transaction Reference ID:</td>
        <td><input type="text" name="tr"/></td>
      </tr>
      <tr>
        <td align="right">Easypay/UBLOMNI Code:</td>
        <td><input type="text" name="code"/></td>
      </tr>
      <tr>
        <td align="right">Payment Date:</td>
        <td><input type="text" name="date"/></td>
      </tr>
      <tr align="center">
        <td colspan="2"><input type="submit" name="confirm" value="Confirm Payment"/></td>
      </tr>
    </table>
  </form>
</body>
</html>

<?php
if(isset($_POST['confirm'])){
  $update_id=$_GET['update_id'];
  $invoice=$_POST['invoice_no'];
  $amount=$_POST['amount'];
  $payment_method=$_POST['payment_method'];
  $ref_no=$_POST['tr'];
  $code=$_POST['code'];
  $date=$_POST['date'];
  $complete='Complete';

  $insert_payment="INSERT INTO payments (invoice_no, amount, payment_mode, ref_no, code, payment_date) 
                   VALUES ('$invoice', '$amount', '$payment_method', '$ref_no', '$code', '$date')";
  $run_payment=mysqli_query($con,$insert_payment);

  if($run_payment){
    echo "<h2 style='text-align:center;color:#00ff00;'>Payment received, your order will be completed within 24 hours.</h2>";
  }

  $update_order="UPDATE customer_orders SET order_status='$complete' WHERE order_id='$update_id'";
  mysqli_query($con,$update_order);

  $update_pending_order="UPDATE pending_order SET order_status='$complete' WHERE order_id='$update_id'";
  mysqli_query($con,$update_pending_order);
}
?>
