<?php
include("includes/db.php");
include("functions/functions.php");
include("header.php");
?>

</head>

<!--Content starts-->
<div id="right_content_2">
  <?php cart(); ?>
  <div id="headline">
    <div id="headline_content">
      <b>Welcome Guest</b>
      <b style="color:yellow;">Shopping Cart</b>
      <span>-  Total Items: <?php items(); ?> - Total Price: LKR <?php total_price(); ?>
        <a class="cart_img" href="cart.php" style="float:right;margin-left: 5px;"><img src="images/Cart-Icon.png" width="30px" height="30px"></a></span>
    </div>
  </div>
  <!--Headline ends here-->

  <div class="container">
    <form id="register_form" action="" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-25">
          <label for="fname">Customer Name</label>
        </div>
        <div class="col-75">
          <input type="text" name="c_name" required placeholder="Your name..">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="lname">Customer E-mail</label>
        </div>
        <div class="col-75">
          <input type="text" name="c_email" required placeholder="Your email Address..">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="lname">Customer Password</label>
        </div>
        <div class="col-75">
          <input type="password" name="c_pass" required placeholder="Choose your password..">
        </div>
      </div>

      <!-- Province Dropdown -->
      <div class="row">
        <div class="col-25">
          <label for="province">Province</label>
        </div>
        <div class="col-75">
          <select name="c_country" id="province" required>
            <option value="">Select a Province</option>
            <option>Central</option>
            <option>Eastern</option>
            <option>Northern</option>
            <option>North Central</option>
            <option>North Western</option>
            <option>Sabaragamuwa</option>
            <option>Southern</option>
            <option>Uva</option>
            <option>Western</option>
          </select>
        </div>
      </div>

      <!-- City Dropdown -->
      <div class="row">
        <div class="col-25">
          <label for="city">Customer City</label>
        </div>
        <div class="col-75">
          <select name="c_city" id="city" required>
            <option value="">Select a City</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="lname">Customer Mobile No.</label>
        </div>
        <div class="col-75">
          <input type="text" name="c_contact" required placeholder="Your Mobile No..">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="lname">Customer Address</label>
        </div>
        <div class="col-75">
          <input type="text" name="c_address" required placeholder="Your Address..">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="lname">Customer Image</label>
        </div>
        <div class="col-75">
          <input type="file" name="c_image" required>
        </div>
      </div>

      <div class="row">
        <input type="submit" name="register" value="Submit">
      </div>
    </form>
  </div>
</div>
<!--Content ends-->

<?php include("footer.php"); ?>
<!-- Footer of site Ends Here-->
</div>
<!--Main Container ends -->
</body>
</html>

<!-- Province → Cities Script -->
<script>
  const cityOptions = {
    "Central": ["Kandy", "Matale", "Nuwara Eliya"],
    "Eastern": ["Trincomalee", "Batticaloa", "Ampara"],
    "Northern": ["Jaffna", "Kilinochchi", "Mannar", "Mullaitivu", "Vavuniya"],
    "North Central": ["Anuradhapura", "Polonnaruwa"],
    "North Western": ["Kurunegala", "Puttalam"],
    "Sabaragamuwa": ["Ratnapura", "Kegalle"],
    "Southern": ["Galle", "Matara", "Hambantota"],
    "Uva": ["Badulla", "Monaragala"],
    "Western": ["Colombo", "Gampaha", "Kalutara"]
  };

  document.getElementById("province").addEventListener("change", function () {
    const province = this.value;
    const citySelect = document.getElementById("city");
    citySelect.innerHTML = "<option value=''>Select a City</option>";
    if (province && cityOptions[province]) {
      cityOptions[province].forEach(city => {
        const option = document.createElement("option");
        option.value = city;
        option.textContent = city;
        citySelect.appendChild(option);
      });
    }
  });
</script>

<?php
// Registration handler
if(isset($_POST['register'])){
  $c_name = $_POST['c_name'];
  $c_email = $_POST['c_email'];
  $c_pass = $_POST['c_pass'];
  $c_country = $_POST['c_country'];
  $c_city = $_POST['c_city'];
  $c_contact = $_POST['c_contact'];
  $c_address = $_POST['c_address'];
  $c_image = $_FILES['c_image']['name'];
  $c_image_tmp = $_FILES['c_image']['tmp_name'];
  $c_ip = getRealIpAddr();

  // Insert customer into database
  $insert_customer = "INSERT INTO customers 
  (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip) 
  VALUES 
  ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";

  $run_customer = mysqli_query($con, $insert_customer);

  // Move uploaded image
  move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");

  if($run_customer){
    // Show alert and redirect to login page
    echo "<script>alert('Account created successfully! Please login to continue.')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
  } else {
    echo "<script>alert('Registration failed. Please try again.')</script>";
  }
}
?>
