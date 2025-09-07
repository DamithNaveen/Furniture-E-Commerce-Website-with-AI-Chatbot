<?php
session_start();
include("../includes/db.php");
include("../functions/functions.php");
include("header.php");

// Redirect if not logged in
if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
}
$customer_email = $_SESSION['customer_email'];
?>

<div class="content_wrapper" style="padding:30px; min-height:600px; background:#f9f9f9;">
    <h2 style="text-align:center; margin-bottom:30px;">Furniture Customization</h2>

    <div style="max-width:800px; margin:0 auto; background:#fff; padding:30px; border-radius:15px; box-shadow:0 8px 25px rgba(0,0,0,0.2);">

        <form action="customization_process.php" method="post" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:20px;">
            <label>Furniture Name:</label>
            <input type="text" name="furniture_name" placeholder="e.g. Dining Table" required>

            <label>Furniture Type:</label>
            <select name="furniture_type" required>
                <option value="">Select Type</option>
                <option value="Table">Table</option>
                <option value="Chair">Chair</option>
                <option value="Sofa">Sofa</option>
                <option value="Bed">Bed</option>
                <option value="Cabinet">Cabinet</option>
                <option value="Shelf">Shelf</option>
                <option value="Custom">Custom</option>
            </select>

            <label>Wood Type:</label>
            <select name="wood_type" required>
                <option value="">Select Wood</option>
                <option value="Teak">Teak</option>
                <option value="Mahogany">Mahogany</option>
                <option value="Oak">Oak</option>
                <option value="Rosewood">Rosewood</option>
                <option value="Pine">Pine</option>
                <option value="Walnut">Walnut</option>
                <option value="Other">Other</option>
            </select>

            <label>Size (L x W x H in cm):</label>
            <input type="text" name="size" placeholder="e.g. 200 x 100 x 75" required>

            <label>Color / Finish:</label>
            <input type="text" name="color" placeholder="e.g. Natural, Walnut">

            <label>Additional Notes / Requirements:</label>
            <textarea name="notes" rows="4" placeholder="Special instructions..."></textarea>

            <label>Reference Image (Optional):</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit" name="submit_customization" style="padding:15px; background:#ff6600; color:#fff; border:none; border-radius:25px;">
                Submit Customization
            </button>
        </form>

    </div>
</div>

<?php include("footer.php"); ?>
