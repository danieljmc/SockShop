<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>
</head>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

	<!-- Bootstrap photo slider -->
    <div class="col-md-12">
      <div id="promoSlider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#promoSlider" data-slide-to="0" class="active"></li>
          <li data-target="#promoSlider" data-slide-to="1"></li>
          <li data-target="#promoSlider" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox" style="border-radius:5px">
          <div class="item active">
            <img class="d-block img-fluid" src="Pics/Banners/ban1.png" alt="Promo1" style="width:100%;">
          </div>

          <div class="item">
            <img class="d-block img-fluid" src="Pics/Banners/ban2.png" alt="Promo2" style="width:100%;">
          </div>

          <div class="item">
            <img class="d-block img-fluid" src="Pics/Banners/ban3.png" alt="Promo3" style="width:100%;">
          </div>
        </div>

        <a class="left carousel-control" style="border-radius:5px" href="#promoSlider" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" style="border-radius:5px" href="#promoSlider" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

	<!-- Bootstrap category selector -->
	<div class="row text-center" style="margin-left:auto; margin-right:auto">

		<div class="col-lg-3 col-md-5 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=men" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat1.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=ladies" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat2.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=novelty" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat3.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=multicolor" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat4.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=bright" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat5.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=small" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat6.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=medium" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat7.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
		<div class="col-lg-3 col-md-4 col-xs-6" style="margin-top:15px">
		  <a href="search.php?searchterm=large" class="d-block mb-4 h-100">
			<img class="img-fluid img-thumbnail" src="Pics/Categories/cat8.png" style="max-height:240px; max-width:240px">
		  </a>
		</div>
	</div>

    <!-- The footer -->
    <?php include('php/footer.php')?>


  </div>
</body>
</html>

</html>
