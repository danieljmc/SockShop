<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>
<script>

$('document').ready(function(){
  $('#editproducts').css('background-color','gray');

  var sizescolors = [];
  $('#addcolor').click(function(){
    $('#selsizes').append("<option>"+$('#sizes').val()+", "+$('#colors').val()+"</option>");
    sizescolors.push([$('#sizes').val(),$('#colors').val()]);
    $('#sizes').val("")
    $('#colors').val("")

  })


  $('#change').click(function(){
    $('#mainform').append('<input type="hidden" name="manufacturer" value="'+$('#manufacturers').find(":selected").text()+'" />')
    for(var i=0;i<sizescolors.length;i++){
      $('#mainform').append('<input type="hidden" name="colorsizes['+i+'][0]" value="'+sizescolors[i][0]+'" />')
      $('#mainform').append('<input type="hidden" name="colorsizes['+i+'][1]" value="'+sizescolors[i][1]+'" />')
    }

    $('#mainform').submit()
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
    <form action="php/addproduct.php" method="post" id='mainform'>
      <div class="container col-md-9" style="background-color:#d3d3d3; height:460px; margin-top:60px; padding-top:20px; text-align:center;">
        <div class="container col-md-6">
          <label for="productname">Product Name:</label>
          <input type="text" class="form-control" id="productname" placeholder="Enter your product name" name="productname">
          <label for="price" style="padding-top:20px">Price:</label>
          <input type="text" class="form-control" id="price" placeholder="Enter the price" name="price">
          <label for="material" style="padding-top:20px">Material:</label>
          <input type="text" class="form-control" id="material" placeholder="Enter the material" name="material">
          <label for="desc" style="padding-top:20px">Description:</label>
          <textarea class="form-control" rows="5" id="desc" placeholder="Enter the product description" name="desc"></textarea>

        </div>
        <div class="container col-md-6">
          <div class="container col-md-12">
            <label for="sizes">Sizes:</label>
          </div>
          <div class="container col-md-12">
            <input type="text" class="form-control" id="sizes" placeholder="Enter your size to add">
          </div>
          <div class="container col-md-12" style="padding-top:20px;">
            <label for="colors">Colours:</label>
          </div>
          <div class="container col-md-10">
            <input type="text" class="form-control" id="colors" placeholder="Enter your color to add">
          </div>
          <div class="container col-md-2">
            <button type="button" class="btn btn-primary btn-md" id="addcolor">Add</button>
          </div>
          <div class="container col-md-12" style="padding-top:20px;">
            <label for="sizes">Size Color Combinations:</label>
          </div>
          <div class="container col-md-12">
            <select class="form-control" id="selsizes">
            </select>
          </div>
          <div class="container col-md-12" style="padding-top:20px;">
            <label for="manufacturers">Manufacturer:</label>
          </div>
          <div class="container col-md-12">
            <select class="form-control" id="manufacturers" name="test">
              <?php
              include('php/db.php');
              $query = "SELECT Company FROM manufacturer";
              $stmt = $mysql->prepare($query);
              try{
                $stmt->execute();
                $results = $stmt->fetchAll();
                foreach($results as $row){
                  echo "<option>".$row['Company']."</option>";
                }
              } catch(PDOException $e){
                echo $e->getMessage();
              }
              ?>
            </select>
          </div>
        </div>
        <div class="container col-md-12" style="text-align: center">
          <button class="btn btn-primary btn-md" id="change" style="margin: auto; width:20%; margin-top: 15px;">Submit Changes</button>
        </div>
      </div>
    </form>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

    </div>
    </body>
    </html>
