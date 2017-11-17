<?php session_start(); ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(!isset($_SESSION['username'])){
    echo "<script>alert('You must be signed in to add to basket')</script>";
  }
  else{
    include_once('php/db.php');
    $query = "insert into basket (Customer_id, Product_id, Quantity)
              values((select id from customer where email = '".$_SESSION['username']."'),
		                 (select id from product where colour='".$_POST['color']."' and ProductType_id=".$_GET['id']." and size='".$_POST['size']."'),
                      ".$_POST['quantity'].");";
    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
    } catch( PDOException $e ){
      echo $e->getMessage();
    }
  }
}

?>

<!--

Notes for the php dev.

All you need to do is call 'populatePage' with the appropriate params
The current populate page is just an example and is what will change
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>

   <script type="text/javascript">
     $(document).ready(function() {

       function populatePage(id,name,description,materials,sizes,colors,price){
         for(var i = 0;i<sizes.length;i++){
           var current = sizes[i]
           $('#sizes').append("<option value=\""+current+"\">"+current+"</option>")
         }
         for(var i = 0;i<colors.length;i++){
           var current = colors[i]
           $('#colors').append("<option value=\""+current+"\">"+current+"</option>")
         }
         $('#productname').text(name);
         $('#description').text(description)
         $('#materials').text(materials)
         var imageselector = [
           "<row>",
            "<img src=\"pics/productPics/"+id+"/1.jpg\" id=\"main-img\" onerror=\"this.src='Pics/logo.png'\" class=\"col-md-12 img-thumbnail\" style = \"padding:50px; width:100%\">",
           "</row>",
           "<row>",
             "<img src=\"pics/productPics/"+id+"/1.jpg\" onerror=\"this.src='Pics/logo.png'\" id=\"img1\" class=\"col-md-3 img-thumbnail\">",
             "<img src=\"pics/productPics/"+id+"/2.jpg\" onerror=\"this.src='Pics/logo.png'\" id=\"img2\" class=\"col-md-3 img-thumbnail\">",
             "<img src=\"pics/productPics/"+id+"/3.jpg\" onerror=\"this.src='Pics/logo.png'\" id=\"img3\" class=\"col-md-3 img-thumbnail\">",
             "<img src=\"pics/productPics/"+id+"/4.jpg\" onerror=\"this.src='Pics/logo.png'\" id=\"img4\" class=\"col-md-3 img-thumbnail\">",
           "</row>",
          ]
         $('#photoselector').append(imageselector.join(""))
         //Image press functions to change the main image
         $('#img1').click(function() {
            $("#main-img").attr("src","Pics/productPics/"+id+"/1.jpg");
         });
         $('#img2').click(function() {
            $("#main-img").attr("src","Pics/productPics/"+id+"/2.jpg");
         });
         $('#img3').click(function() {
            $("#main-img").attr("src","Pics/productPics/"+id+"/3.jpg");
         });
         $('#img4').click(function() {
            $("#main-img").attr("src","Pics/productPics/"+id+"/4.jpg");
         });

         $('#price').val("£"+price);

         $("#quantity").on('change keyup paste', function () {
           var currentPrice = price * $('#quantity').val();
           $('#price').val("£"+currentPrice);
         });


       }

       var pairs = [];

       <?php
          include_once('php/db.php');
          $query = "select * from producttype where id=".$_GET['id'].";";
          $stmt = $mysql->prepare($query);
          $productID = $_GET['id'];
          $productName = "";
          $productDescription = "";
          $productMaterial = "";
          $productPrice = 0;
          try{
            $stmt->execute();
            $result = $stmt->fetch();
            $productName = $result['ProductName'];
            $productDescription = $result['Description'];
            $productMaterial = $result['Material'];
            $productPrice = $result['Price'];
            $query2 = "Select size,colour from product where ProductType_id = ".$_GET['id'];
            $stmt2 = $mysql->prepare($query2);
            try{
              $stmt2->execute();
              $result2 = $stmt2->fetchAll();
              foreach( $result2 as $row2 ) {
                echo "pairs.push(['".$row2['size']."','".$row2['colour']."']);\n";
              }
            } catch ( PDOException $e ){
              echo $e->getMessage();
            }
          } catch( PDOException $e ){
            echo $e->getMessage();
          }
       ?>

       var sizes = []
       var colors = []

       for(var i=0;i<pairs.length;i++){
         if(!sizes.includes(pairs[i][0])){
           sizes.push(pairs[i][0])
         }
         if(!colors.includes(pairs[i][1])){
           colors.push(pairs[i][1])
         }
       }

       var description = "<?php echo $productDescription; ?>";
       var materials = "<?php echo $productMaterial; ?>";
       var productID = <?php echo $productID; ?>;
       var productName = "<?php echo $productName; ?>";
       var price = <?php echo $productPrice; ?>;
       populatePage(productID,productName,description,materials,sizes,colors,price)

       $('#colors').on('change',function(e){
         var selectedColor = $("option:selected", this).text();
         $('#sizes').empty();
         for(var i=0;i<pairs.length;i++){
           if(pairs[i][1]==selectedColor){
             $('#sizes').append("<option value=\""+pairs[i][0]+"\">"+pairs[i][0]+"</option>")
           }
         }
       });

       var selectedColor = $("option:selected", $('#colors')).text();
       $('#sizes').empty();
       for(var i=0;i<pairs.length;i++){
         if(pairs[i][1]==selectedColor){
           $('#sizes').append("<option value=\""+pairs[i][0]+"\">"+pairs[i][0]+"</option>")
         }
       }

    });
  </script>

</head>
<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <row>

      <!-- Div for the photo selector -->
      <div class="container col-md-6" style="background-color:#f7c986; border-radius:5px; padding-top:20px; padding-bottom:20px" id="photoselector">

      </div>

      <!-- div for the product description area-->
      <div class="container col-md-6" style="background-color:#f7c986; border-radius:5px; padding-top:20px; padding-bottom:25px">
		<div class="container col-md-12" style="background-color:#ffecd8; border-radius:5px; padding-top:20px; padding-bottom:10px; border: 1px solid lightgray">
        <row>
          <h2 class="col-md-12" style="text-align: center;" id="productname">Product Name</h2>
        </row>

        <row>
          <h3 class="col-md-6" style="text-align: center;">Description</h3>
          <h3 class="col-md-6" style="text-align: center;">Materials</h3>
        </row>
        <form method="post">
          <row>
            <p class="col-md-6" style="height:120px;" id="description">

            <p class="col-md-6" style="height:120px; text-align:center;" id="materials">
            </p>
          </row>

          <row>
            <div class="container col-md-6">
              <p class="col-md-3" style="text-align:right; font-size:120%; padding-top:7px;">Size:</p>
              <div class="container col-md-9">
                <select name="size" class="form-control" id="sizes">

                </select>
              </div>
            </div>
            <div class="container col-md-6">
              <p class="col-md-3" style="text-align:right; font-size:120%; padding-top:7px;">Color:</p>
              <div class="container col-md-9">
                <select name="color" class="form-control" id="colors">

                </select>
              </div>
            </div>
          </row>
          <row>
            <div class="container col-md-6" style="padding-top:20px">
              <p class="col-md-4" style="text-align:right; font-size:120%; padding-top:7px;">Quantity:</p>
              <div class="col-md-8">
                <input name="quantity" type="text" value="1" class="form-control" id="quantity">
              </div>
            </div>
          </row>
          <row>
            <div class="container col-md-6" style="padding-top:20px">
              <p class="col-md-4" style="text-align:right; font-size:120%; padding-top:7px;">Price:</p>
              <div class="col-md-8">
                <input type="text" value="1" class="form-control" id="price" readonly>
              </div>
            </div>
          </row>
          <row>
            <div class="col-md-12" style="margin-top:20px; text-align:center;">
              <button type="submit" class="btn btn-primary btn-md" style="width:60%;">Add to Basket</button>
            </div>
          </row>
          <row>
            <p class="col-md-12" style="text-align:center; font-size:120%; padding-top:15px">Sizes:</p>
          </row>
          <row>
            <div class="col-md-12" style="text-align:center;">
              <img src="pics/sizechart.png" style="width:80%">
            </div>
          </row>
        </form>
		</div>
      </div>

      <!-- Footer -->
      <?php include('php/footer.php'); ?>


  </div>
</body>
</html>
