<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../php/head.php'); ?>
</head>

<script>
$('document').ready(function(){
  $('#vieworders').css('background-color', 'grey');

  var orders = [];

  class Order{
    constructor(id, CustomerName, Status){
      this.id = id
      this.CustomerName = CustomerName
      this.Status = Status
      this.suborders = []
      orders.push(this);
    }

    addTo(ProductName,Quantity){
      this.suborders.push([ProductName,Quantity]);
    }

    addToString(string){
      if(this.suborders.length!=0){
        var temp = "<tr>",
          "<td>"+this.id+"</td>",
          "<td>"+this.CustomerName+"</td>",
          "<td>"+this.suborders[0][0]+"</td>",
          "<td>"+this.suborders[0][1]+"</td>",
          "<td>",
            "<select class=\"form-control\" id=\"sel1\">",
              "<option>Placed</option>",
              "<option>Ready</option>",
              "<option>Completed</option>",
            "</select>",
          "</td>",
        "</tr>"
        string += temp.join("")
      }
      for(var i=1;i<this.suborders.length;i++){
        var temp ="<tr>",
          "<td></td>",
          "<td></td>",
          "<td>"+this.suborders[i][0]+"</td>",
          "<td>"+this.suborders[i][1]+"</td>",
          "<td></td>",
        "</tr>"
        string += temp.join("")
      }
    }
  }

  function updateTable(){
    $('#tablebody').empty();
    var htmlstring= "";

    for(var i=0;i<orders.length;i++){
      orders[i].addToString(htmlstring);
    }
    $('#tablebody').append(htmlstring);
  }

  var temp = new Order(1,"Gavin Henderson","Placed");
  temp.addTo(["Smelly Socks",10])

  updateTable();
});
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('../php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Selected Option -->
    <div class="container col-md-9 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
      <table class="table table-bordered col-md-12">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Products</th>
            <th>Quantity</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="tablebody">
          <tr>
            <td>1</td>
            <td>Gavin Henderson</td>
            <td>Sock Type 1</td>
            <td>2</td>
            <td>
              <select class="form-control" id="sel1">
                <option>Placed</option>
                <option>Ready</option>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Sock Type 2</td>
            <td>2</td>
            <td></td>
          </tr>
        </tbody>
      </table>

    </div>

    <!-- Footer -->
    <?php include('../php/footer.php'); ?>

</div>
</body>
</html>
