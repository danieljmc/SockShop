<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>
<script>

$('document').ready(function(){
  $('#editproducts').css('background-color','gray');

  $('#addsize').click(function(){
    $('#selsizes').append("<option>"+$('#sizes').val()+"</option>");
  })
})

</script>
<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Check Stock -->
    <form action="php/addproduct.php" method="post">
      <div class="container col-md-9" style="background-color:#d3d3d3; height:400px; margin-top:60px; padding-top:20px; text-align:center;">
        <div class="container col-md-6">
          <label for="productname">Product Name:</label>
          <input type="text" class="form-control" id="productname" placeholder="Enter your product name" name="productname">
          <label for="price" style="padding-top:20px">Price:</label>
          <input type="text" class="form-control" id="price" placeholder="Enter the price" name="price">
          <label for="desc" style="padding-top:20px">Description:</label>
          <textarea class="form-control" rows="5" id="desc" placeholder="Enter the product description" name="desc"></textarea>

        </div>
        <div class="container col-md-6">
          <div class="container col-md-12">
            <label for="sizes">Sizes:</label>
          </div>
          <div class="container col-md-10">
            <input type="text" class="form-control" id="sizes" placeholder="Enter your size to add" name="sizes">
          </div>
          <div class="container col-md-2">
            <button type="button" class="btn btn-primary btn-md" id="addsize">Add</button>
          </div>
          <div class="container col-md-12" style="padding-top:20px;">
            <label for="colors">Colours:</label>
          </div>
          <div class="container col-md-10">
            <input type="text" class="form-control" id="colors" placeholder="Enter your color to add" name="colors">
          </div>
          <div class="container col-md-2">
            <button type="button" class="btn btn-primary btn-md" id="addcolor">Add</button>
          </div>
          <div class="container col-md-12" style="padding-top:20px;">
            <label for="sizes">Sizes:</label>
          </div>
          <div class="container col-md-12">
            <select class="form-control" id="selsizes">
              <option>Small</option>
              <option>Medium</option>
            </select>
          </div>
          <div class="container col-md-12" style="padding-top:20px;">
            <label for="colors">Colours:</label>
          </div>
          <div class="container col-md-12">
            <select class="form-control" id="selcolors">
              <option>Black</option>
              <option>Blue</option>
            </select>
          </div>
        </div>
        <div class="container col-md-12" style="text-align: center">
          <button type="submit" class="btn btn-primary btn-md" id="change" style="margin: auto; width:20%; margin-top: 15px;">Submit Changes</button>
        </div>
      </div>
    </form>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

    </div>
    </body>
    </html>
