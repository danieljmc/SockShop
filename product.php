<?php session_start(); ?>

<!--

Notes for the php dev.

All you need to do is call 'populatePage' with the appropriate params
The current populate page is just an example and is what will change
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sock Shop</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=800, initial-scale=1">

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
            $("#main-img").attr("src","../productPics/"+id+"/1.jpg");
         });
         $('#img2').click(function() {
            $("#main-img").attr("src","../productPics/"+id+"/2.jpg");
         });
         $('#img3').click(function() {
            $("#main-img").attr("src","../productPics/"+id+"/3.jpg");
         });
         $('#img4').click(function() {
            $("#main-img").attr("src","../productPics/"+id+"/4.jpg");
         });

         $('#price').val("£"+price);

         $("#quantity").on('change keyup paste', function () {
           var currentPrice = price * $('#quantity').val();
           $('#price').val("£"+currentPrice);
         });


       }

       var pairs = [];

       <?php
          include 'php/db.php';
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

       $('#sizes').on('change',function(e){
         var selectedSize = $("option:selected", this).text();
         $('#colors').empty();
         for(var i=0;i<pairs.length;i++){
           if(pairs[i][0]==selectedSize){
             $('#colors').append("<option value=\""+pairs[i][1]+"\">"+pairs[i][1]+"</option>")
           }
         }
       });

       $('#colors').on('change',function(e){
         var selectedColor = $("option:selected", this).text();
         $('#sizes').empty();
         for(var i=0;i<pairs.length;i++){
           if(pairs[i][1]==selectedColor){
             $('#sizes').append("<option value=\""+pairs[i][0]+"\">"+pairs[i][0]+"</option>")
           }
         }
       });

    });
  </script>

</head>
<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <row>

      <!-- Div for the photo selector -->
      <div class="container col-md-6" style="background-color:#d3d3d3; height:680px;" id="photoselector">

      </div>

      <!-- div for the product description area-->
      <div class="container col-md-6" style="background-color:#d3d3d3; height:680px;">

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
                <select class="form-control" id="sizes">

                </select>
              </div>
            </div>
            <div class="container col-md-6">
              <p class="col-md-3" style="text-align:right; font-size:120%; padding-top:7px;">Color:</p>
              <div class="container col-md-9">
                <select class="form-control" id="colors">

                </select>
              </div>
            </div>
          </row>
          <row>
            <div class="container col-md-6" style="padding-top:20px">
              <p class="col-md-4" style="text-align:right; font-size:120%; padding-top:7px;">Quantity:</p>
              <div class="col-md-8">
                <input type="text" value="1" class="form-control" id="quantity">
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
              <img src="pics/sizechart.jpg" style="width:80%">
            </div>
          </row>
        </form>
      </div>

      <!-- Footer -->
      <?php include('php/footer.php'); ?>


  </div>
</body>
</html>
