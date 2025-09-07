<?php
$customer_email = $_SESSION['customer_email'];

// Fetch all customization requests for this customer
$query = "SELECT * FROM furniture_customizations WHERE customer_email='$customer_email' ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
?>

<style>
/* Container for premium look */
.customization-table-container {
    max-width: 1200px;
    margin: 30px auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    font-family: 'Arial', sans-serif;
}

/* Header */
.customization-table-container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 2em;
    color: #333;
}

/* Table styling */
.customization-table {
    width: 100%;
    border-collapse: collapse;
}

.customization-table th, .customization-table td {
    padding: 12px 15px;
    text-align: center;
    vertical-align: middle;
    border-bottom: 1px solid #ddd;
}

.customization-table th {
    background: linear-gradient(90deg, #ff6600, #ff9933);
    color: #fff;
    font-weight: 600;
}

.customization-table tbody tr:hover {
    background: #fff3e6;
    transition: background 0.3s ease;
}

/* Image styling */
.customization-table img {
    border-radius: 10px;
    max-width: 80px;
    max-height: 80px;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Status colors */
.status-pending { color: orange; font-weight: bold; }
.status-approved { color: green; font-weight: bold; }
.status-rejected { color: red; font-weight: bold; }

/* Responsive */
@media screen and (max-width: 768px) {
    .customization-table-container {
        padding: 15px;
    }
    .customization-table th, .customization-table td {
        padding: 8px 10px;
        font-size: 0.9em;
    }
    .customization-table img {
        max-width: 60px;
        max-height: 60px;
    }
}
</style>

<div class="customization-table-container">
    <h2>My Furniture Customization Requests</h2>
    <table class="customization-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Furniture Name</th>
                <th>Type</th>
                <th>Wood Type</th>
                <th>Size</th>
                <th>Color</th>
                <th>Status</th>
                <th>Admin Price</th>
                <th>Reference Image</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_array($result)){ ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['furniture_name']) ?></td>
                <td><?= htmlspecialchars($row['furniture_type']) ?></td>
                <td><?= htmlspecialchars($row['wood_type']) ?></td>
                <td><?= htmlspecialchars($row['size']) ?></td>
                <td><?= htmlspecialchars($row['color']) ?></td>
                <td>
                    <?php
                    if($row['status']=='Pending'){
                        echo "<span class='status-pending'>Pending</span>";
                    } elseif($row['status']=='Approved'){
                        echo "<span class='status-approved'>Approved</span>";
                    } else{
                        echo "<span class='status-rejected'>Rejected</span>";
                    }
                    ?>
                </td>
                <td><?= $row['admin_price'] ? 'LKR '.$row['admin_price'] : '-' ?></td>
                <td>
                    <?php if($row['image']){ ?>
                        <img src="customer_images/<?= $row['image'] ?>" alt="Reference Image">
                    <?php } else { echo '-'; } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
