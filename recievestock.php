<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>

<script>
$('document').ready(function(){
  $('#recievestock').css('background-color','gray')
});
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <div class="container col-md-9" style="background-color:#d3d3d3; height:800px; padding-top:20px;">
      <div class="col-md-5 container">
        <input type="text" placeholder="Order ID" class="form-control" id="orderid">
      </div>
      <div class="col-md-3 container">
        <button type="button" class="btn btn-primary btn-md" id="recieved">Mark as Recieved</button>
      </div>
      <div class="container col-md-12 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>0</td>
              <td>Colorful socks</td>
              <td>10</td>
              <td>Dundee</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer -->
    <?php include('php/footer'); ?>

    </div>
  </body>
</html>
