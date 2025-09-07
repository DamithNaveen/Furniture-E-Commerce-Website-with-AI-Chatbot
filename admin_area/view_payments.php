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
  <title>View All Payments</title>
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
  <h2>View All Payments</h2>
  <table>
    <tr>
      <th>Payment No.</th>
      <th>Invoice No.</th>
      <th>Amount Paid</th>
      <th>Payment Method</th>
      <th>Ref No</th>
      <th>Code</th>
      <th>Payment Date</th>
    </tr>
    <?php
      include ("includes/db.php");
      $get_payments="select * from payments";
      $run_payments=mysqli_query($con,$get_payments);
      $i=0;
      while($row_payments=mysqli_fetch_array($run_payments)){
        $payment_id = $row_payments['payment_id'];
        $invoice    = $row_payments['invoice_no'];
        $amount     = $row_payments['amount'];
        $payment_m  = $row_payments['payment_mode']; // corrected key
        $ref_no     = $row_payments['ref_no'];
        $code       = $row_payments['code'];
        $date       = $row_payments['payment_date'];
        $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $invoice; ?></td>
      <td><?php echo "LKR " . number_format($amount,2); ?></td>
      <td><?php echo $payment_m; ?></td>
      <td><?php echo $ref_no; ?></td>
      <td><?php echo $code; ?></td>
      <td><?php echo $date; ?></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
<?php } ?>
