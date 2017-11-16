<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); var_dump($_POST) ?>
</head>
<script>
$('document').ready(function(){
  $('#delete').click(function(){
    var form = $('<form method="post">' +
             '<input type="hidden" name="id" value="' + $('productID').text() + '"></form>');
    $(form).submit();
    console.log($('productID').val())
  });

  $('#editproducts').css('background-color','gray');
  products = []
  class Product{
    constructor(id,name,price){
      this.id = id
      this.name = name
      this.price = price
      products.push(this)
    }

    getString(){
      return [
        "<tr>",
          "<td>"+this.id+"</td>",
          "<td>"+this.name+"</td>",
          "<td>£"+this.price+"</td>",
        "</tr>"
      ].join("")
    }
  }

  function updateTable(){
    $('#tablebody').empty();
    var html = ""
    for(var i =0;i<products.length;i++){
      html += products[i].getString()
    }
    $('#tablebody').append(html);
  }

  <?php
  include('php/db.php');

  $query = "SELECT id, ProductName, Price FROM producttype";

  $stmt = $mysql->prepare($query);
  try{
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $row){
      echo "new Product(".$row['id'].",'".$row['ProductName']."',".$row['Price'].");\n";
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }

  ?>

  updateTable();
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
          <tbody id="tablebody">
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
