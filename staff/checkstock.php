<!--

The search on this page is totally front end so just add the entire stock table
there is an add item function that should be used

-->

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../php/head.php'); ?>
</head>

<script>

$(document).ready(function() {
  var stock = []

  class StockItem{
    constructor(productID, type, manufacturer, color, size, quantity, location){
      this.productID = productID
      this.type = type
      this.manufacturer = manufacturer
      this.color = color
      this.size = size
      this.quantity = quantity
      this.location = location
      this.flatstring = productID + type + manufacturer + color + size + location
      stock.push(this)
      var newItem = [
        "<tr>",
          "<td>"+productID+"</td>",
          "<td>"+type+"</td>",
          "<td>"+manufacturer+"</td>",
          "<td>"+color+"</td>",
          "<td>"+size+"</td>",
          "<td>"+quantity+"</td>",
          "<td>"+location+"</td>",
        "</tr>"
      ]
      $('#tablebody').append(newItem.join(""));
      this.addToTable = function(){
        var newItem = [
          "<tr>",
            "<td>"+this.productID+"</td>",
            "<td>"+this.type+"</td>",
            "<td>"+this.manufacturer+"</td>",
            "<td>"+this.color+"</td>",
            "<td>"+this.size+"</td>",
            "<td>"+this.quantity+"</td>",
            "<td>"+this.location+"</td>",
          "</tr>"
        ]
        $('#tablebody').append(newItem.join(""));
      }
    }
  }

  function addItem(productid, type, manufacturer, color, size, location, quantity){
    new StockItem(productid, type, manufacturer, color, size, location, quantity)
  }

  $('#checkstock').css('background-color','grey');

  $('#search').click(function(){
    $('#tablebody').empty()
    var searchcat = $('#searchcategory option:selected').text()
    var searchterm = $('#searchterm').val().toLowerCase()
    for (var i in stock){
      if(searchcat=="Product ID"){
        if(stock[i].productID.toLowerCase()==searchterm){
          stock[i].addToTable()
        }
      }
      if(searchcat=="Product Type"){
        if(stock[i].type.toLowerCase()==searchterm){
          stock[i].addToTable()
        }
      }
      if(searchcat=="Manufacturer"){
        if(stock[i].manufacturer.toLowerCase()==searchterm){
          stock[i].addToTable()
        }
      }
      if(searchcat=="Colour"){
        if(stock[i].color.toLowerCase()==searchterm){
          stock[i].addToTable()
        }
      }
      if(searchcat=="Location"){
        if(stock[i].location.toLowerCase()==searchterm){
          stock[i].addToTable()
        }
      }
    }
  })


  <?php
	include '../php/db.php';

	//Below are the tables and the columns taken from them
	//	product - Size, Colour
	//	producttype - Name, id
	//	productquantity - Quantity
	//	manufacturer - Company name
	//	location - location name

	$query = "SELECT producttype.id, producttype.ProductName, manufacturer.Company, product.Size, product.Colour, productquantity.Quantity, location.LocationName FROM ((((product
		INNER JOIN producttype ON product.ProductType_id = producttype.id)
		INNER JOIN productquantity ON product.id = productquantity.ProductID)
        INNER JOIN location ON productquantity.locationID = location.id)
        INNER JOIN manufacturer ON producttype.Manufacturer_id = manufacturer.id)";

	$stmt = $mysql->prepare($query);

	try{
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach($result as $row) {
			echo ("addItem(".$row['id'].",\"".$row['ProductName']."\",\"".$row['Company']."\",\"".$row['Colour']."\",\"".$row['Size']."\",".$row['Quantity'].",\"".$row['LocationName']."\")\n");
		}
	}
	catch (PDOException $e)
	{
		echo $e->getMessage();
	}

  ?>
  //addItem(1,"sock","nike","black","small",100,"Dundee")


})
</script>

<body>
  <div class="container">

    <!-- The navbar -->
	<?php include('../php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#d3d3d3; height:800px">
      <div class="col-md-6 container">
        <input type="text" placeholder="Search Term" class="form-control" id="searchterm">
      </div>
      <div class="col-md-4 container">
        <select class="form-control" id="searchcategory">
          <option>Product ID</option>
          <option>Product Type</option>
          <option>Manufacturer</option>
          <option>Colour</option>
          <option>Size</option>
          <option>Location</option>
        </select>
      </div>
      <div class="col-md-2 container">
        <button type="button" class="btn btn-primary btn-md" id="search">Search</button>
      </div>
      <div class="container col-md-12 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Product ID</th>
              <th>Product Type</th>
              <th>Manufacturer</th>
              <th>Colour</th>
              <th>Size</th>
              <th>Quantity</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody id="tablebody">
          </tbody>
        </table>
      </div>
    </div>
		<!-- FOOTER -->
       <?php include('../php/footer.php'); ?>

    </div>
    </body>
    </html>
