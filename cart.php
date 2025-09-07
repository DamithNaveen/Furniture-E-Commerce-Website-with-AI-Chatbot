<?php
include("includes/db.php");
include("functions/functions.php");
include("header.php");
?>

<!--Content starts-->
<div class="content_wrapper">
    <div id="left_sidebar">
        <div id="sidebar_title"> Categories </div>
        <ul id="cats">
          <?php getCats(); ?>
        </ul>

        <div id="sidebar_title"> Brands </div>
        <ul id="cats">
          <?php getBrands(); ?>
        </ul>
    </div>

    <div id="right_content">
        <?php cart(); ?>
        <div id="headline">
            <div id="headline_content">
                <?php
                    if(!isset($_SESSION['customer_email'])){
                        echo "<b>Welcome Guest !</b> <b style='color:yellow;'>Shopping Cart</b>";
                    } else {
                        echo "<b>Welcome: <span style='color:pink;'>".$_SESSION['customer_email']."</span></b> <b style='color:yellow;'>Your Shopping Cart</b>";
                    }
                ?>
                <span>- Total Items: <?php items(); ?> - Total Price: LKR <?php echo total_price(); ?>
                    <a href="all_products.php" style="color:yellow;"> Back to Shopping</a>
                </span>
            </div>
        </div>
        <!--Headline ends here-->

        <div id="products_box" class='cart_box'>
            <form action="cart.php" method="post" enctype="multipart/form-data">
                <table id="table_orders" bgcolor="antiquewhite">
                    <tr align="center">
                        <td><b>Remove</b></td>
                        <td><b>Product Image</b></td>
                        <td><b>Product(s)</b></td>
                        <td><b>Quantity</b></td>
                        <td><b>Total Price (LKR)</b></td>
                    </tr>

                    <?php
                    $total = 0;
                    $ip_add = getRealIpAddr();
                    $sel_price = "SELECT * FROM cart WHERE ip_add='$ip_add'";
                    $run_price = mysqli_query($con,$sel_price);

                    while($record = mysqli_fetch_array($run_price)){
                        $pro_id = $record['p_id'];
                        $quantity = $record['qty'];

                        $pro_price = "SELECT * FROM products WHERE product_id='$pro_id'";
                        $run_pro_price = mysqli_query($con,$pro_price);

                        while($p_price = mysqli_fetch_array($run_pro_price)){
                            $product_price = $p_price['product_price'];
                            $product_title = $p_price['product_title'];
                            $product_image = $p_price['product_img1'];
                            $only_price = $product_price * $quantity;
                            $total += $only_price;
                    ?>
                    <tr align="center">
                        <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                        <td><img src="admin_area/product_images/<?php echo $product_image; ?>" height="80" width="80" style="border:3px solid #fff;border-radius:50%;"></td>
                        <td><?php echo $product_title; ?></td>
                        <td><input type="text" name="qty[<?php echo $pro_id; ?>]" value="<?php echo $quantity; ?>" size="3"></td>
                        <td>LKR <?php echo $only_price; ?></td>
                    </tr>
                    <?php }} ?>

                    <tr>
                        <td colspan="4" align="right"><b>Sub Total:</b></td>
                        <td><b>LKR <?php echo $total; ?></b></td>
                    </tr>

                    <tr align="center">
                        <td colspan="3"><a id='detail_link' href='all_products.php' style='float:left;'>Continue Shopping</a></td>
                        <td><input type="submit" id="btn_update" name="update" value="Update Cart"/></td>
                        <td><a id='add_cart_link' href="checkout.php" style="text-decoration:none;"><span>Checkout</span></a></td>
                    </tr>
                </table>
            </form>
        </div>

        <?php
        // Update cart function
        function updatecart(){
            global $con;
            $ip_add = getRealIpAddr();

            if(isset($_POST['update'])){
                if(isset($_POST['remove'])){
                    foreach($_POST['remove'] as $remove_id){
                        $delete_products = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip_add'";
                        $run_delete = mysqli_query($con, $delete_products);
                    }
                    echo "<script>window.open('cart.php','_self');</script>";
                }

                if(isset($_POST['qty'])){
                    foreach($_POST['qty'] as $pro_id => $qty){
                        $update_qty = "UPDATE cart SET qty='$qty' WHERE p_id='$pro_id' AND ip_add='$ip_add'";
                        mysqli_query($con, $update_qty);
                    }
                    echo "<script>window.open('cart.php','_self');</script>";
                }
            }
        }

        echo @$up_cart = updatecart();
        ?>
    </div>
</div>
<!--Content ends-->

<?php include("footer.php"); ?>
