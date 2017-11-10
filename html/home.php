<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sock Shop</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=800, initial-scale=1">
</head>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('../php/header.php'); ?>

	<!-- Bootstrap photo slider -->
    <div class="col-md-12" style="padding-bottom:10px">
      <div id="promoSlider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#promoSlider" data-slide-to="0" class="active"></li>
          <li data-target="#promoSlider" data-slide-to="1"></li>
          <li data-target="#promoSlider" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid" src="socks/sockbanners/ban1.png" alt="Promo1" style="width:100%;">
          </div>

          <div class="item">
            <img class="d-block img-fluid" src="socks/sockbanners/ban2.png" alt="Promo2" style="width:100%;">
          </div>

          <div class="item">
            <img class="d-block img-fluid" src="socks/sockbanners/ban3.png" alt="Promo3" style="width:100%;">
          </div>
        </div>

        <a class="left carousel-control" href="#promoSlider" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#promoSlider" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

	<!-- Bootstrap category selector -->
	<div class="row text-center text-lg-left">

		<div class="col-lg-3 col-md-5 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat1.png" style="height:210px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat2.png" style="height:210px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat3.png" style="height:210px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat4.png" style="height:210px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat5.png" style="height:210px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat6.png" style="height:210px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat7.png" style="height:210px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6">
		  <a href="#" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="socks/sockcategories/cat8.png" style="height:210px">
		  </a>
		</div>
	</div>

    <!-- The footer -->
    <?php include('../php/footer.php')?>


  </div>
</body>
</html>

</html>
