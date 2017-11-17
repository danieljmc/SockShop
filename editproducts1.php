<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php');?>
</head>
<script>
$('document').ready(function(){
  $('#update').click(function(){
    var form = $('<form method="get" action="editproducts3.php">' +
             '<input type="hidden" name="updateid"  value="' + $('#productID').val() + '"></form>');
    $(document.body).append(form)
    $(form).submit();
  });

  $('#editproducts').css('background-color','#f7c986');
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
    <div class="container col-md-9" style="background-color:#f7c986; padding-top:10px; padding-bottom:10px; max-height:800px; border-radius:5px">
	<div class="container col-md-12" style="background-color:#ffecd8; padding-top:10px; border-radius:5px; border: 1px solid lightgray">
      <div class="container col-md-12" style="padding-top:15px; padding-bottom:15px;">
        <div class="col-md-3 container">
          <input type="text" placeholder="Product ID" class="form-control" id="productID">
        </div>
        <div class="col-md-3 container">
          <button type="button" class="btn btn-primary btn-md" id="update" style="width:100%">Update</button>
        </div>
        <div class="container col-md-6" style="text-align:right;">
          <button onclick="window.location.href='editproducts2.php'" type="button" class="btn btn-primary btn-md" id="add">Add a New Product</button>
        </div>
      </div>
      <div class="container col-md-12 pre-scrollable" style="background-color:#ffecd8; max-height:600px;">
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
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

    </div>
    </body>
    </html>
