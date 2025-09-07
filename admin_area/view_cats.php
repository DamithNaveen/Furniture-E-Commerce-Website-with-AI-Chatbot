<?php
//session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
 ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>View Categories</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    .table-container {
      max-width: 900px;
      margin: 60px auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      border: 2px solid #16a085; /* Border color updated */
      box-shadow: 0px 3px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #16a085; /* Heading matches dashboard color */
      font-size: 24px;
      margin-bottom: 20px;
      text-decoration: underline;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th {
      background: #16a085; /* Table header green */
      color: #fff;
      padding: 12px;
      text-align: center;
      font-size: 15px;
    }
    td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
    }
    tr:hover {
      background: #f1f1f1;
    }
    .btn {
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
      font-size: 13px;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-edit {
      background: #3498db;
      color: #fff;
    }
    .btn-edit:hover {
      background: #2980b9;
    }
    .btn-delete {
      background: #e74c3c;
      color: #fff;
    }
    .btn-delete:hover {
      background: #c0392b;
    }
  </style>
</head>
<body>
  <div class="table-container">
    <h2>View All Categories</h2>
    <table>
      <tr>
        <th>Category ID</th>
        <th>Category Title</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php
        include ("includes/db.php");
        $get_cats="select * from categories";
        $run_cats=mysqli_query($con,$get_cats);
        while($row_cats=mysqli_fetch_array($run_cats)){
          $cat_id=$row_cats['cat_id'];
          $cat_title=$row_cats['cat_title'];
      ?>
      <tr>
        <td><?php echo $cat_id; ?></td>
        <td><?php echo $cat_title; ?></td>
        <td><a class="btn btn-edit" href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
        <td><a class="btn btn-delete" href="index.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
      </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>
<?php } ?>
