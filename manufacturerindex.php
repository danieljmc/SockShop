<?php session_start();
include_once('php/db.php');
if(isset($_SESSION['username'])) {
  $query = $mysql->prepare("SELECT b.id, pt.productname, b.quantity, b.status, l.locationname, l.address, m.email FROM batchorder b INNER JOIN producttype pt ON b.product_id = pt.id INNER JOIN location l ON b.Location_id=l.id INNER JOIN manufacturer m ON b.Manufacturer_id=m.id where m.Email=:email ;");
  $query->execute(array(":email" => $_SESSION["username"]));
  $results = $query->fetchAll();
} else {
  header("Location: index.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('php/head.php'); ?>
</head>

<body>
  <div class="container">
  <?php include_once('php/header.php'); ?>
    <!-- Options tab -->
    <div class="container col-md-3" style="padding-top:60px; padding-bottom:60px;">
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:gray;">
        <p><a href="manufacturerindex.php">View Orders</a></p>
      </div>
    </div>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#d3d3d3; height:620px; padding-top:20px; text-align:center;">
      <div class="container col-md-12 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($results as $res) {
              echo '<tr>';
                echo "<td><a href=manufacturerorder.php?id=$res[id]>$res[id]</a></td>";
                echo "<td><a href=manufacturerorder.php?id=$res[id]>$res[productname]</a></td>";
                echo "<td>$res[quantity]</td>";
                echo "<td>$res[status]</td>";
                echo "<td>$res[locationname]</td>";
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer -->
    <div class="col-md-12" style="background-color:grey; padding-top:20px;">
      <ul class="col-md-4" style="text-align:center; list-style-type: none;">
        <li>Company</li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Careers</a></li>
      </ul>
      <ul class="col-md-4" style="text-align:center; list-style-type: none;">
        <li>More</li>
        <li><a href="#">Acessibility</a></li>
        <li><a href="#">Legal</a></li>
        <li><a href="#">Privacy</a></li>
        <li><a href="#">Terms of Use</a></li>
      </ul>
      <ul class="col-md-4" style="text-align:center; list-style-type: none;">
        <li>Login</li>
        <li><a href="#">Staff</a></li>
        <li><a href="#">Manufacturer</a></li>
        <li><a href="#">Customer</a></li>
      </ul>
    </div>

    </div>
    </body>
    </html>
