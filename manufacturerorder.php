<?php
session_start();
include_once('php/db.php');
if (!isset($_GET['id'])) {
  header("Location: manufacturerindex.php");
}
$query = $mysql->prepare('SELECT * FROM batchorder b INNER JOIN producttype pt ON b.product_id = pt.id INNER JOIN location l ON b.Location_id=l.id where b.id=:id;');
$query->execute(array(':id' => $_GET['id']));
$result = $query->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('php/head.php');?>
</head>

<body>
  <div class="container">

    <?php include_once('php/header.php'); ?>

    <!-- Options tab -->
    <div class="container col-md-3" style="padding-top:60px; padding-bottom:60px;">
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:gray;">
        <p>View Orders</p>
      </div>
    </div>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#d3d3d3; height:310px; padding-top:20px; text-align:center;">
      <div class="container col-md-6" style="font-size:120%;">
        <div class="container col-md-6">
          <p>Product:</p>
        </div>
        <div class="container col-md-6">
          <p><?php echo $result['ProductName'];?></p>
        </div>
        <div class="container col-md-6" style="padding-top:20px;">
          <p>Order Status:</p>
        </div>
        <div class="container col-md-6" style="padding-top:20px;">
          <p><?php echo $result['Status']; ?></p>
        </div>
        <div class="container col-md-6" style="padding-top:20px;">
          <button type="submit" class="btn btn-default">Accept</button>
        </div>
        <div class="container col-md-6" style="padding-top:20px;">
          <button type="submit" class="btn btn-default">Decline</button>
        </div>
        <div class="container col-md-12" style="padding-top:20px;">
          <p>Reason for choice:</p>
        </div>
        <div class="container col-md-12" style="padding-top:0px;">
          <input type="text" placeholder="Enter your reason" class="form-control" id="reason">
        </div>
        <div class="col-md-12 container" style="padding-top:20px;">
          <button type="button" class="btn btn-primary btn-md" id="submit" style="width:25%; margin: auto;">Submit</button>
        </div>
      </div>
      <div class="container col-md-6" style="font-size:120%;">
        <p>Ordering Store:</p>
      </div>
      <div class="container col-md-6" style="font-size:120%;">
        <p><?php echo $result['Address'] . ', ' . $result['LocationName']; ?></p>
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
