<?php
$db = mysqli_connect("localhost","root","","myshop");

if(isset($_POST['contacts'])){
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $u_email = $_POST['u_email'];
    $u_phone = $_POST['u_phone'];
    $u_msg = $_POST['u_msg'];

    $insertval = "INSERT INTO shopcontact (fname, lname, email, phone, msg) 
                  VALUES ('$f_name','$l_name', '$u_email', '$u_phone', '$u_msg')";
    $run_customer = mysqli_query($db,$insertval);

    if($run_customer) {
        echo "<script>
                alert('Your message has been submitted successfully. Thank You!');
                window.location.href='index.php';
              </script>";
    }
}

include("includes/db.php");
include("functions/functions.php");
include("header.php");
?>

<div id="right_content_2">
    <?php cart(); ?>
    
    <div id="headline" style="padding: 8px 6px;">
        <div id="headline_content">
            <?php
                if(!isset($_SESSION['customer_email'])){
                    echo "<b>Welcome Guest !</b> <b style='color:yellow;'>Shopping Cart</b>";
                } else {
                    echo "<b>Welcome: <span style='color:pink;'>".$_SESSION['customer_email']."</span></b> <b style='color:yellow;'>Your Shopping Cart</b>";
                }
            ?>
            <span>- Total Items: <?php items(); ?> - Total Price: LKR <?php total_price(); ?>
                <a class="cart_img" href="cart.php" style="float:right;margin-left: 5px;">
                    <img src="images/Cart-Icon.png" width="30px" height="30px" alt="Cart">
                </a>
            </span>
        </div>
    </div>

    <section class="sections_wraps" id="sec_fifth">
        <div class="sec_header">
            <h2>CONTACT US</h2>
            <p class="sub_title">Share your experience. Let's Talk!</p>
        </div>  

        <div class="contact_wrap contact_form">
            <div class="form_success"></div>
            <div class="form_errors"></div>
            <form action="" name="contact_form" id="contact_form" method="post" onsubmit="return showAlert();">
                <div class="full_one">
                    <div class="form_field">
                        <label for="first_name">First Name:</label>
                        <input type="text" name='f_name' tabindex="1" required autofocus>
                    </div>
                    <div class="form_field">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name='l_name' tabindex="2" required>
                    </div>
                </div>

                <div class="full_one">
                    <div class="form_field">
                        <label for="email">Email:</label>
                        <input type="email" name='u_email' tabindex="3" required>
                    </div>
                    <div class="form_field">
                        <label for="phone">Phone: (+94 XXXXXXXX)</label>
                        <input type="tel" name='u_phone' placeholder="+94 XXXXXXXX" tabindex="4" required>
                    </div>
                </div>

                <div class="form_field form_full">
                    <label for="comment">Share your thoughts:</label>
                    <textarea placeholder="Type your message here...." tabindex="5" name='u_msg' required></textarea>
                </div>

                <div class="form_field btn_submit">
                    <input name="contacts" type="submit" id="submit" value="Submit">
                </div>
            </form>
        </div>  
    </section>
</div>

<script>
function showAlert() {
    alert("Your message has been submitted successfully. Thank you!");
    return true; // Form will submit after alert
}
</script>

<?php include("footer.php"); ?>
