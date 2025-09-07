<?php
session_start();
include("../includes/db.php");
include("../functions/functions.php");
include("header.php");

// Redirect if not logged in
if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
}

$customer_name = "";
?>

<div class="content_wrapper">

    <!-- Left Sidebar -->
    <div id="left_sidebar">
        <div id="sidebar_title"> Manage Account : </div>
        <ul id="cats">
            <?php
            if(isset($_SESSION['customer_email'])){
                $customer_session = $_SESSION['customer_email'];
                $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_session'";
                $run_customer = mysqli_query($con, $get_customer);
                $row_customer = mysqli_fetch_array($run_customer);
                $customer_pic = $row_customer['customer_image'];
                $customer_name = $row_customer['customer_name'];
                echo "<img src='customer_photos/$customer_pic' width='150' height='150'>";
            }
            ?>
            <li><a href="my_account.php?my_orders">My Orders</a></li>
            <li><a href="my_account.php?edit_account">Edit Account</a></li>
            <li><a href="my_account.php?change_pass">Change Password</a></li>
            <li><a href="my_account.php?delete_account">Delete Account</a></li>
            <li><a href="my_account.php?my_customizations">My Customizations</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Right Content -->
    <div id="right_content">

        <div id="headline">
            <div id="headline_content">
                <?php
                if(!isset($_SESSION['customer_email'])){
                    echo "<b>Welcome: Guest </b>";
                    echo "<a href='../checkout.php' style='color:rgb(223, 165, 51);'> Login</a>";
                } else {
                    echo "<b>Welcome: </b><b style='color:yellow;'>".$customer_name."</b>";
                }
                ?>
            </div>
        </div>

        <div>
            <?php
            // Include the page based on GET parameters
            if(isset($_GET['my_orders'])) {
                include("my_orders.php");
            }
            elseif(isset($_GET['edit_account'])) {
                include("edit_account.php");
            }
            elseif(isset($_GET['change_pass'])) {
                include("change_pass.php");
            }
            elseif(isset($_GET['delete_account'])) {
                include("delete_account.php");
            }
            elseif(isset($_GET['my_customizations'])) {
                include(__DIR__ . "/my_customizations.php"); // My Customizations page
            }
            else {
                // Default welcome message instead of getDefault()
                echo "<h2 style='text-align:center; margin-top:50px;'>Welcome to your account, $customer_name!</h2>
                      <p style='text-align:center;'>Use the links on the left to manage your account, view orders, or check your customizations.</p>";
            }
            ?>
        </div>

    </div>
</div>

<?php include("footer.php"); ?>
