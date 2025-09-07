<?php
session_start();
include("../includes/db.php");

if(isset($_POST['submit_customization'])){
    $customer_email = $_SESSION['customer_email'];
    $furniture_name = mysqli_real_escape_string($con, $_POST['furniture_name']);
    $furniture_type = mysqli_real_escape_string($con, $_POST['furniture_type']);
    $wood_type = mysqli_real_escape_string($con, $_POST['wood_type']);
    $size = mysqli_real_escape_string($con, $_POST['size']);
    $color = mysqli_real_escape_string($con, $_POST['color']);
    $notes = mysqli_real_escape_string($con, $_POST['notes']);

    // Handle file upload
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    if($image != ""){
        move_uploaded_file($tmp_image, "../customer_images/$image");
    } else {
        $image = NULL;
    }

    $insert = "INSERT INTO furniture_customizations 
        (customer_email, furniture_name, furniture_type, wood_type, size, color, notes, image) 
        VALUES ('$customer_email','$furniture_name','$furniture_type','$wood_type','$size','$color','$notes','$image')";

    $run_insert = mysqli_query($con, $insert);

    if($run_insert){
        echo "<script>alert('Your customization request has been submitted!');</script>";
        echo "<script>window.open('my_account.php','_self');</script>";
    } else {
        echo "<script>alert('Error! Try again.');</script>";
    }
}
?>
