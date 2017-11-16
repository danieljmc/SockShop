<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>

<script>

$('document').ready(function(){
  $('#newstock').css('background-color','gray');
});

</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <div class="container col-md-9" style="background-color:#d3d3d3; height:800px; padding-top:20px;">
      <div class="col-md-4 container">
        <select class="form-control" id="sel1" placeholder="Manufacturer">
          <option>Nike</option>
          <option>Adidas</option>
          <option>Reebok</option>
        </select>
      </div>
      <div class="col-md-2 container">
        <button type="button" class="btn btn-primary btn-md" id="update">Update</button>
      </div>
      <div class="col-md-2 container">
        <input type="text" placeholder="Product ID" class="form-control" id="product">
      </div>
      <div class="col-md-2 container">
        <input type="text" placeholder="Quantity" class="form-control" id="quantity">
      </div>
      <div class="col-md-2 container">
        <button type="button" class="btn btn-primary btn-md" id="order">Order</button>
      </div>
      <div class="container col-md-12 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Product ID</th>
              <th>Product Type</th>
              <th>Colour</th>
              <th>Size</th>
              <th>Quantity</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>0</td>
              <td>Colorful socks</td>
              <td>Black</td>
              <td>Small</td>
              <td>10</td>
              <td>Dundee</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

    </div>
  </body>
</html>
