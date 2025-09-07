<?php
include("includes/db.php");

$msg = strtolower($_POST['msg']);
$response = "I'm here to help! Ask about our products or contact info.";

// Show products if user asks about furniture/products
if(strpos($msg,'product') !== false || strpos($msg,'furniture') !== false){
    $sql = "SELECT product_id, product_title, product_img1, status, 
                   c.cat_title, b.brand_title
            FROM products p
            LEFT JOIN categories c ON p.cat_id = c.cat_id
            LEFT JOIN brands b ON p.brand_id = b.brand_id
            ORDER BY p.date DESC";
    
    $result = mysqli_query($con, $sql);

    if(!$result){
        $response = "Database query failed: " . mysqli_error($con);
    } else {
        $products = [];
        while($row = mysqli_fetch_assoc($result)){
            $product_title = htmlspecialchars($row['product_title']);
            $cat_title = $row['cat_title'] ? htmlspecialchars($row['cat_title']) : "Uncategorized";
            $brand_title = $row['brand_title'] ? htmlspecialchars($row['brand_title']) : "No Brand";

            $products[] = "
            <div style='margin-bottom:10px; border-bottom:1px solid #ddd; padding-bottom:5px;'>
                <a href='all_products.php?id={$row['product_id']}' target='_blank' style='text-decoration:none;color:#d35400;'>
                    <img src='admin_area/product_images/{$row['product_img1']}' width='50' height='50' style='vertical-align:middle;border:1px solid #ccc;border-radius:5px;margin-right:5px;'>
                    <strong>{$product_title}</strong><br>
                    Category: {$cat_title} | Brand: {$brand_title} | Status: {$row['status']}
                </a>
            </div>
            ";
        }
        $response = count($products) > 0 ? "Here are our products:<br>".implode("",$products) : "No products available at the moment.";
    }
}

// Show categories if user asks about categories
elseif(strpos($msg,'category') !== false || strpos($msg,'categories') !== false){
    $sql = "SELECT cat_id, cat_title FROM categories ORDER BY cat_title ASC";
    $result = mysqli_query($con, $sql);

    if(!$result){
        $response = "Failed to fetch categories: " . mysqli_error($con);
    } else {
        $categories = [];
        while($row = mysqli_fetch_assoc($result)){
            $cat_title = htmlspecialchars($row['cat_title']);
            $categories[] = "ID: {$row['cat_id']} | Name: {$cat_title}";
        }
        $response = count($categories) > 0 ? "Available categories:<br>" . implode("<br>", $categories) : "No categories found.";
    }
}

// Contact info
elseif(strpos($msg,'contact') !== false || strpos($msg,'phone') !== false){
    $response = "You can contact us at: +94 11 2345678";
}
elseif(strpos($msg,'email') !== false){
    $response = "Our email is: info@furniturehouse.lk";
}
elseif(strpos($msg,'address') !== false || strpos($msg,'location') !== false){
    $response = "Our showroom is located at: 45, Galle Road, Colombo 03, Sri Lanka";
}
elseif(strpos($msg,'thank') !== false){
    $response = "You're welcome! 😊";
}

echo $response;
?>
