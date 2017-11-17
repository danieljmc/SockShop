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

    <div class="container col-md-9" style="background-color:#ffecd8; margin-top:100px; padding-top:20px; padding-bottom:20px; border-radius:5px">
      <div class="container col-md-12" style="padding-bottom:20px">
		  <p style="font-size:120%; width:60%; margin:auto; text-align: center">
			Use the check stock page and search by manufacturer to decide what items to restock. The destination of the order will be your store location.
		  </p>
	  </div>
      <form action="php/stockorder.php" method="post">
        <div class="col-md-12 container" style="padding-bottom:20px">
          <input style="width:50%; margin:auto;" type="text" placeholder="Product ID" name="productID" class="form-control" id="product">
        </div>
        <div class="col-md-12 container" style="padding-bottom:20px">
          <input style="width:50%; margin:auto; padding:" type="text" placeholder="Quantity" name="Quantity" class="form-control" id="quantity">
        </div>
        <div class="contatiner col-md-12" style="text-align:center" >
          <input type="submit" class="btn btn-primary" value="Submit Order" id="order">
        </div>
      </form>
	 </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

    </div>
  </body>
</html>
