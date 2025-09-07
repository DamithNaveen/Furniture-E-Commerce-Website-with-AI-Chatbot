<?php
include("../includes/db.php");

// ✅ Approve customization
if (isset($_GET['approve_customization'])) {
    $id = intval($_GET['approve_customization']);
    $update = "UPDATE furniture_customizations SET status='Approved' WHERE id='$id'";
    mysqli_query($con, $update);
    echo "<script>alert('Customization Approved!'); window.location.href='view_customizations.php';</script>";
    exit();
}

// ✅ Reject customization
if (isset($_GET['reject_customization'])) {
    $id = intval($_GET['reject_customization']);
    $update = "UPDATE furniture_customizations SET status='Rejected' WHERE id='$id'";
    mysqli_query($con, $update);
    echo "<script>alert('Customization Rejected!'); window.location.href='view_customizations.php';</script>";
    exit();
}

// ✅ Update price
if (isset($_POST['set_price'])) {
    $id = intval($_POST['customization_id']);
    $price = floatval($_POST['admin_price']);
    $update = "UPDATE furniture_customizations SET admin_price='$price' WHERE id='$id'";
    mysqli_query($con, $update);
    echo "<script>alert('Price updated successfully!'); window.location.href='view_customizations.php';</script>";
    exit();
}

// ✅ Fetch customizations
$get_customizations = "SELECT * FROM furniture_customizations ORDER BY created_at DESC";
$run_customizations = mysqli_query($con, $get_customizations);
?>

<style>
/* Responsive wrapper */
.table-wrapper {
    width: 100%;
    overflow-x: auto;
    margin: 20px 0;
    -webkit-overflow-scrolling: touch;
    border-radius: 6px;
    border: 1px solid #eee;
}

/* Table */
.customizations-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Segoe UI', sans-serif;
    min-width: 1000px; /* ensures scroll on small screens */
}

/* Table header */
.customizations-table thead tr {
    background: linear-gradient(90deg, #1abc9c, #16a085);
    color: #fff;
    text-align: center;
}
.customizations-table th {
    padding: 12px 8px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
}

/* Table body */
.customizations-table td {
    padding: 10px 8px;
    text-align: center;
    font-size: 14px;
    color: #333;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

/* Hover */
.customizations-table tbody tr:hover {
    background: #f9fdfc;
    transition: 0.2s ease-in-out;
}

/* Status styles */
.status-pending { color: #e67e22; font-weight: 600; }
.status-approved { color: #27ae60; font-weight: 600; }
.status-rejected { color: #c0392b; font-weight: 600; }

/* Images */
.customizations-table img {
    border-radius: 6px;
    max-width: 70px;
    max-height: 70px;
    object-fit: cover;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

/* Action buttons */
.action-links {
    display: flex;
    justify-content: center;
    gap: 6px;
    flex-wrap: wrap; /* ✅ allows wrapping on small screens */
}

.action-links a {
    display: inline-block;
    font-weight: 600;
    padding: 6px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 13px;
    transition: all 0.2s;
    min-width: 80px;
    text-align: center;
}
.action-links a:hover { opacity: 0.85; }
.action-approve { background: #2ecc71; color: #fff !important; }
.action-reject { background: #e74c3c; color: #fff !important; }
.action-price { background: #16a085; color: #fff !important; }

/* Price form */
.price-form {
    background: #f9f9f9;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-top: 10px;
}

/* ✅ Responsive tweaks */
@media (max-width: 768px) {
    .customizations-table th,
    .customizations-table td {
        font-size: 12px;
        padding: 8px 6px;
    }
    .action-links a {
        font-size: 12px;
        padding: 5px 8px;
        min-width: 70px;
    }
}
</style>

<h2 style="text-align:center; color:#16a085; margin:20px 0;">Customer Furniture Customizations</h2>

<div class="table-wrapper">
<table class="customizations-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer Email</th>
            <th>Furniture Name</th>
            <th>Type</th>
            <th>Wood Type</th>
            <th>Size</th>
            <th>Color</th>
            <th>Status</th>
            <th>Admin Price</th>
            <th>Reference Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_array($run_customizations)){ ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['customer_email']) ?></td>
            <td><?= $row['furniture_name'] ?: '-' ?></td>
            <td><?= $row['furniture_type'] ?: '-' ?></td>
            <td><?= $row['wood_type'] ?: '-' ?></td>
            <td><?= $row['size'] ?: '-' ?></td>
            <td><?= $row['color'] ?: '-' ?></td>
            <td>
                <?php
                if($row['status']=='Pending'){
                    echo "<span class='status-pending'>Pending</span>";
                } elseif($row['status']=='Approved'){
                    echo "<span class='status-approved'>Approved</span>";
                } else {
                    echo "<span class='status-rejected'>Rejected</span>";
                }
                ?>
            </td>
            <td><?= $row['admin_price'] ? 'LKR '.$row['admin_price'] : '-' ?></td>
            <td>
                <?php if($row['image']){ ?>
                    <img src="../customer/customer_images/<?= $row['image'] ?>" alt="Reference Image">
                <?php } else { echo '-'; } ?>
            </td>
            <td>
                <div class="action-links">
                <?php if($row['status']=='Pending'){ ?>
                    <a href="view_customizations.php?approve_customization=<?= $row['id'] ?>" class="action-approve">Approve</a>
                    <a href="view_customizations.php?reject_customization=<?= $row['id'] ?>" class="action-reject">Reject</a>
                    <a href="view_customizations.php?set_price=<?= $row['id'] ?>" class="action-price">Set Price</a>
                <?php } else { echo "-"; } ?>
                </div>
            </td>
        </tr>

        <?php if(isset($_GET['set_price']) && $_GET['set_price'] == $row['id']){ ?>
        <tr>
            <td colspan="11">
                <div class="price-form">
                    <form method="post" action="view_customizations.php">
                        <input type="hidden" name="customization_id" value="<?= $row['id'] ?>">
                        <label>Enter Price (LKR):</label>
                        <input type="number" name="admin_price" step="0.01" required style="padding:6px; width:150px; margin:0 10px;">
                        <button type="submit" name="set_price" style="padding:6px 12px; background:#16a085; color:white; border:none; border-radius:5px;">Save</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php } ?>

    <?php } ?>
    </tbody>
</table>
</div>
