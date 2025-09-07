<?php
session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Global */
        body { margin:0; font-family:'Segoe UI',sans-serif; background:#f0f2f5; overflow-x:hidden; }
        .wrapper { display:flex; min-height:100vh; }

        /* Sidebar */
        .sidebar { width:260px; background:linear-gradient(180deg,#1abc9c,#16a085); color:#fff; padding:20px; box-sizing:border-box; }
        .sidebar h2 { text-align:center; margin-bottom:25px; font-weight:600; }
        .sidebar a { display:flex; align-items:center; color:#fff; text-decoration:none; padding:12px 15px; margin:8px 0; border-radius:8px; transition:0.3s; }
        .sidebar a i { margin-right:12px; }
        .sidebar a:hover { background:rgba(255,255,255,0.2); transform:translateX(5px); }
        .sidebar .dashboard-btn { background:#e74c3c; font-weight:bold; margin-bottom:20px; }

        /* Main content */
        .main { flex:1; padding:30px; }

        /* Welcome message */
        .welcome { text-align:center; font-size:32px; font-weight:bold; color:#34495e; margin-bottom:40px; opacity:0; animation: fadeIn 1.5s forwards; }
        @keyframes fadeIn { to { opacity:1; } }

        /* Dashboard cards */
        .dashboard-cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:25px; margin-bottom:40px; }
        .card { background:#fff; border-radius:15px; padding:25px; text-align:center; box-shadow:0 10px 25px rgba(0,0,0,0.1); transition: all 0.3s; }
        .card:hover { transform:translateY(-10px); box-shadow:0 15px 30px rgba(0,0,0,0.15); }
        .card h3 { font-size:18px; margin:0; font-weight:600; color:#16a085; }
        .card p { font-size:28px; margin:10px 0 0 0; font-weight:bold; color:#2c3e50; }

        /* Chart container */
        .chart-container { background:#fff; border-radius:15px; padding:25px; box-shadow:0 10px 25px rgba(0,0,0,0.1); margin-bottom:20px; }

        @media(max-width:768px){ 
            .wrapper { flex-direction:column; } 
            .sidebar { width:100%; display:flex; overflow-x:auto; padding:10px; } 
            .sidebar a { flex:1 0 auto; margin:5px; text-align:center; } 
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="index.php" class="dashboard-btn"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        <a href="index.php?insert_product"><i class="fas fa-box"></i>Insert Product</a>
        <a href="index.php?view_products"><i class="fas fa-eye"></i>View Products</a>
        <a href="index.php?insert_cat"><i class="fas fa-plus"></i>Insert Category</a>
        <a href="index.php?view_cats"><i class="fas fa-list"></i>View Categories</a>
        <a href="index.php?insert_brand"><i class="fas fa-plus-circle"></i>Insert Brand</a>
        <a href="index.php?view_brands"><i class="fas fa-tags"></i>View Brands</a>
        <a href="index.php?view_customers"><i class="fas fa-users"></i>View Customers</a>
        <a href="index.php?view_orders"><i class="fas fa-shopping-cart"></i>View Orders</a>
        <a href="index.php?view_payments"><i class="fas fa-credit-card"></i>View Payments</a>
        <a href="index.php?view_customizations"><i class="fas fa-cogs"></i>View Customizations</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>

    <!-- Main content -->
    <div class="main">
        <?php
        include("includes/db.php");

        $get_products  = mysqli_num_rows(mysqli_query($con, "SELECT * FROM products"));
        $get_cats      = mysqli_num_rows(mysqli_query($con, "SELECT * FROM categories"));
        $get_brands    = mysqli_num_rows(mysqli_query($con, "SELECT * FROM brands"));
        $get_customers = mysqli_num_rows(mysqli_query($con, "SELECT * FROM customers"));
        $get_orders    = mysqli_num_rows(mysqli_query($con, "SELECT * FROM customer_orders"));
        $get_payments  = mysqli_num_rows(mysqli_query($con, "SELECT * FROM payments"));

        $total_revenue_query = mysqli_query($con, "SELECT SUM(amount) AS total FROM payments");
        $row_rev = mysqli_fetch_array($total_revenue_query);
        $total_revenue = $row_rev['total'];

        // Show Dashboard only when no GET parameter is set
        if(empty($_GET)) {
        ?>
            <div class="welcome">Welcome to the Admin Dashboard</div>

            <!-- Dashboard cards including Revenue Stats -->
            <div class="dashboard-cards">
                <div class="card"><h3>Total Products</h3><p><?php echo $get_products; ?></p></div>
                <div class="card"><h3>Categories</h3><p><?php echo $get_cats; ?></p></div>
                <div class="card"><h3>Brands</h3><p><?php echo $get_brands; ?></p></div>
                <div class="card"><h3>Customers</h3><p><?php echo $get_customers; ?></p></div>
                <div class="card"><h3>Total Orders</h3><p><?php echo $get_orders; ?></p></div>
                <div class="card"><h3>Total Payments</h3><p><?php echo $get_payments; ?></p></div>
                <div class="card"><h3>Total Revenue</h3><p>$<?php echo $total_revenue; ?></p></div>
            </div>

            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>

            <script>
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Products','Categories','Brands','Customers','Orders','Payments'],
                    datasets: [{
                        label: 'Website Stats',
                        data: [
                            <?php echo $get_products; ?>,
                            <?php echo $get_cats; ?>,
                            <?php echo $get_brands; ?>,
                            <?php echo $get_customers; ?>,
                            <?php echo $get_orders; ?>,
                            <?php echo $get_payments; ?>
                        ],
                        backgroundColor: 'rgba(26,188,156,0.2)',
                        borderColor: '#16a085',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#1abc9c'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true, position: 'top' },
                        title: { display: true, text: 'Website Statistics Overview', font: { size: 20 } }
                    },
                    scales: { y: { beginAtZero: true } }
                }
            });
            </script>
        <?php
        } else {
            // Include other admin pages only when GET parameter is set
            if(isset($_GET['insert_product'])) { include("insert_product.php"); }
            if(isset($_GET['view_products']))  { include("view_products.php"); }
            if(isset($_GET['edit_pro']))       { include("edit_pro.php"); }
            if(isset($_GET['insert_cat']))     { include("insert_cat.php"); }
            if(isset($_GET['view_cats']))      { include("view_cats.php"); }
            if(isset($_GET['edit_cat']))       { include("edit_cat.php"); }
            if(isset($_GET['delete_cat']))     { include("delete_cat.php"); }
            if(isset($_GET['insert_brand']))   { include("insert_brand.php"); }
            if(isset($_GET['view_brands']))    { include("view_brands.php"); }
            if(isset($_GET['edit_brand']))     { include("edit_brand.php"); }
            if(isset($_GET['delete_brand']))   { include("delete_brand.php"); }
            if(isset($_GET['view_customers'])) { include("view_customers.php"); }
            if(isset($_GET['view_orders']))    { include("view_orders.php"); }
            if(isset($_GET['view_payments']))  { include("view_payments.php"); }
             if(isset($_GET['view_customizations']))  { include("view_customizations.php"); }
        }
        ?>
    </div>
</div>
</body>
</html>
<?php } ?>
