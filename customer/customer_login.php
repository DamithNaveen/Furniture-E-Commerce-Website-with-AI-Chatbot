<?php
include("includes/db.php");

// function to get IP address
?>

<head>
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<div class="payment_login">
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">

        <!-- Login Form -->
        <form action="checkout.php" method="post">
          <table width="750" align="center">
            <tr align="center">
              <td colspan="4">
                <h1>Login or Register</h1>
                <hr>
              </td>
            </tr>

            <!-- Email -->
            <tr>
              <td align="right"></td>
              <td>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="c_email" placeholder="Email" required>
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                  </span>
                </div>
              </td>
            </tr>

            <!-- Password -->
            <tr>
              <td align="right"></td>
              <td>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                  <input class="input100" type="password" name="c_pass" placeholder="Password" required>
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                  </span>
                </div>
              </td>
            </tr>

            <!-- Submit -->
            <tr align="center">
              <td colspan="4">
                <div class="container-login100-form-btn">
                  <input type="submit" name="c_login" value="Login" class="login100-form-btn">
                </div>
              </td>
            </tr>

            <!-- Forgot Password -->
            <tr align="center">
              <td colspan="4">
                <a href="checkout.php?forgot_pass">Forgot Password?</a>
              </td>
            </tr>
          </table>
        </form>

        <!-- Forgot Password Section -->
        <?php
        if(isset($_GET['forgot_pass'])){
            echo '
            <div align="center" style="margin-top:15px;">
                <b>Enter your email below, we\'ll send your password to your email.</b><br>
                <form action="" method="post">
                    <input type="text" name="c_email" placeholder="Enter Your Email" required/><br><br>
                    <input type="submit" name="forgot_pass" value="Send me Password"/>
                </form>
            </div>
            ';

            if(isset($_POST['forgot_pass'])){
                $c_email = $_POST['c_email'];
                $sel_c = "SELECT * FROM customers WHERE customer_email='$c_email'";
                $run_c = mysqli_query($con, $sel_c);
                $check_c = mysqli_num_rows($run_c);

                if($check_c == 0){
                    echo "<script>alert('This email does not exist in Database.')</script>";
                } else {
                    $row_c = mysqli_fetch_array($run_c);
                    $c_name = $row_c['customer_name'];
                    $c_pass = $row_c['customer_pass'];

                    // Email details
                    $from = "admin@mysite.com";
                    $subject = "Your Password";
                    $message = "
                        <html>
                            <h3>Dear $c_name,</h3>
                            <p>You requested your password at www.localhost.com</p>
                            <b>Your Password is:</b> <span style='color:red;'>$c_pass</span>
                            <h3>Thank you for using our website.</h3>
                        </html>
                    ";
                    mail($c_email, $subject, $message, "From:$from");
                    echo "<script>alert('Password was sent to $c_email. Please check your inbox.')</script>";
                    echo "<script>window.open('checkout.php','_self')</script>";
                }
            }
        }
        ?>

        <!-- Register Link -->
        <h1 style="float:right; padding:10px;">
          <a href="customer_register.php">New? Register Here</a>
        </h1>

      </div>
    </div>
  </div>
</div>

<?php
// Login logic
if(isset($_POST['c_login'])){
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];

    $sel_customer = "SELECT * FROM customers WHERE customer_email='$customer_email' AND customer_pass='$customer_pass'";
    $run_customer = mysqli_query($con, $sel_customer);
    $check_customer = mysqli_num_rows($run_customer);

    $get_ip = getRealIpAddr();
    $sel_cart = "SELECT * FROM cart WHERE ip_add='$get_ip'";
    $run_cart = mysqli_query($con, $sel_cart);
    $check_cart = mysqli_num_rows($run_cart);

    if($check_customer == 0){
        echo "<script>alert('Email or Password is incorrect, try again.')</script>";
        exit();
    }

    $_SESSION['customer_email'] = $customer_email;

    if($check_cart == 0){
        echo "<script>window.open('all_products.php','_self')</script>";
    } else {
        echo "<script>window.open('cart.php','_self')</script>";
    }
}
?>
