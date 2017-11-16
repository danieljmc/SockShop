<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>
<script>
$('document').ready(function(){
  $('#editproducts').css('background-color','gray');
});
</script>
<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php');?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#d3d3d3; height:800px">
      <div class="container col-md-12" style="padding-top:15px; padding-bottom:15px;">
        <div class="col-md-2 container">
          <input type="text" placeholder="Product ID" class="form-control" id="productID">
        </div>
        <div class="col-md-2 container">
          <button type="button" class="btn btn-primary btn-md" id="update" style="width:100%">Update</button>
        </div>
        <div class="col-md-2 container">
          <button type="button" class="btn btn-primary btn-md" id="delete" style="width:100%">Delete</button>
        </div>
        <div class="container col-md-6" style="text-align:right;">
          <button type="button" class="btn btn-primary btn-md" id="add">Add a New Product</button>
        </div>
      </div>
      <div class="container col-md-12 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Product ID</th>
              <th>Product Name</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>0</td>
              <td>Colorful socks</td>
              <td>£10</td>
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
