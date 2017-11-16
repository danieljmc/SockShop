<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>

<script>
$('document').ready(function(){
  $('#recievestock').css('background-color','gray')
  var orders = []

  class Order{
    constructor(id, name, quantity, location){
      this.id = id
      this.name = name
      this.quantity = quantity
      this.location = location
      orders.push(this)
    }

    addToString(){
      return [
        "<tr>",
          "<td>"+this.id+"</td>",
          "<td>"+this.name+"</td>",
          "<td>"+this.quantity+"</td>",
          "<td>"+this.location+"</td>",
        "</tr>"
      ].join("")

    }
  }

  function updateTable(){
    var html = ""
    for(var i=0;i<orders.length;i++){
      console.log(i)
      html += orders[i].addToString(html)
    }
    $('#tablebody').empty();
    $('#tablebody').append(html);
    console.log(orders)
  }

  <?php
    include('php/db.php');
    $query = "
    SELECT b.id, ProductName, Quantity, LocationName FROM batchorder b
    inner join product p
    	on b.Product_id = p.id
    inner join producttype pt
    	on pt.id = p.ProductType_id
    inner join location l
    	on l.id = b.Location_id
    where b.Status = 'Sent'";
    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
      $result = $stmt->fetchAll();
      foreach($result as $row){
        echo "new Order(".$row['id'].",'".$row['ProductName']."',".$row['Quantity'].",'".$row['LocationName']."');\n";
      }
    } catch(PDOException $e){
      $e->getMessage();
    }
  ?>

  //new Order(1,"Socks",10,"Dundee");
  updateTable();


});
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <div class="container col-md-9" style="background-color:#d3d3d3; height:800px; padding-top:20px;">
      <form action="php/markrecieved.php" method="post">
        <div class="col-md-5 container">
          <input name="orderID" type="text" placeholder="Order ID" class="form-control" id="orderid">
        </div>
        <div class="col-md-3 container">
          <input type="submit" value="Mark As Recieved" class="btn btn-primary btn-md" id="recieved">
        </div>
      </form>
      <div class="container col-md-12 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody id="tablebody">
            <tr>
              <td>0</td>
              <td>Colorful socks</td>
              <td>10</td>
              <td>Dundee</td>
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
