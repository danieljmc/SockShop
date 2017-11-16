<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>
<script>

$('document').ready(function(){
  $('#editproducts').css('background-color','gray');

  <?php
  include('php/db.php');
  $query = "SELECT ProductName, Description, Price FROM producttype where id=".$_GET['updateid'];
  $stmt = $mysql->prepare($query);
  try{
    $stmt->execute();
    $result = $stmt->fetch();
    echo "$('#productname').val('".$result['ProductName']."');\n";
    echo "$('#price').val('".$result['Price']."');\n";
    echo "$('#desc').val('".$result['Description']."');\n";
    echo "$('#productid').val('".$_GET['updateid']."');\n";
  } catch(PDOException $e){
    echo $e->getMessage();
  }

  ?>

})

</script>
<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Check Stock -->
    <form action="php/updateproduct.php" method="post">
      <input id="productid" name="id" value="" hidden>
      <div class="container col-md-9" style="background-color:#d3d3d3; height:400px; margin-top: 50px; padding-top:20px; text-align:center;">
        <div class="container col-md-12">
          <label for="productname">Product Name:</label>
          <input type="text" class="form-control" id="productname" placeholder="Enter your product name" name="productname">
          <label for="price" style="padding-top:20px">Price:</label>
          <input type="text" class="form-control" id="price" placeholder="Enter the price" name="price">
          <label for="desc" style="padding-top:20px">Description:</label>
          <textarea class="form-control" rows="5" id="desc" placeholder="Enter the product description" name="desc"></textarea>
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
