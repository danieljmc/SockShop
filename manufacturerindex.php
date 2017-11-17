<?php session_start();
include_once('php/db.php');
if(isset($_SESSION['manusername'])) {
  $query = $mysql->prepare("SELECT b.id, pt.productname, b.quantity, b.status, l.locationname, l.address, m.email FROM batchorder b INNER JOIN producttype pt ON b.product_id = pt.id INNER JOIN location l ON b.Location_id=l.id INNER JOIN manufacturer m ON b.Manufacturer_id=m.id where m.Email=:email ;");
  $query->execute(array(":email" => $_SESSION["manusername"]));
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
    <div class="container col-md-3" style="padding-top:60px; padding-bottom:60px">
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#ffecd8; border-radius: 5px">
        <p style="padding-top:10px;"><a href="manufacturerindex.php">View Orders</a></p>
      </div>
    </div>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#f7c986; height:620px; padding-top:20px; text-align:center; border-radius:5px">
      <div class="container col-md-12 pre-scrollable" style="background-color:#ffecd8; max-height:600px; height:600px; margin-top:-10px; border-radius:5px; border: 1px solid lightgray">
        <table class="table table-bordered col-md-12" style="margin-top:10px">
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

    <!-- The footer -->
    <?php include('php/footer.php')?>

    </div>
    </body>
    </html>
