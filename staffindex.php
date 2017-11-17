<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
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
      //console.log(this)
      if(this.suborders.length!=0){


        var temp = ["<tr>",
          "<td>"+this.id+"</td>",
          "<td>"+this.CustomerName+"</td>",
          "<td>"+this.suborders[0][0]+"</td>",
          "<td>"+this.suborders[0][1]+"</td>",
          "<td>",
            "<select class=\"form-control\" id=\"sel"+this.id+"\">",
              "<option value='1'>Placed</option>",
              "<option value='2'>Ready</option>",
              "<option value='3'>Completed</option>",
            "</select>",
          "</td>",
        "</tr>"]
        string += temp.join("")
      }
      for(var i=1;i<this.suborders.length;i++){
        var temp = ["<tr>",
          "<td></td>",
          "<td></td>",
          "<td>"+this.suborders[i][0]+"</td>",
          "<td>"+this.suborders[i][1]+"</td>",
          "<td></td>",
        "</tr>"]
        string += temp.join("")
      }
      return string
    }
  }

  function updateTable(){
    console.log(orders)
    $('#tablebody').empty();
    var htmlstring= "";

    for(var i=0;i<orders.length;i++){
      htmlstring = orders[i].addToString(htmlstring);
    }



    function dropDownChange(i,selectdropdown){
      return function(){
        $('body').html('<form action="php/changestatus.php" name="changestatus" method="post" style="display:none;"><input type="text" name="orderID" value="' + orders[i].id + '" /><input type="text" name="status" value="' + $(selectdropdown).find(":selected").text() + '" /></form>');
        document.forms['changestatus'].submit();

      }
    }

    $('#tablebody').append(htmlstring);
    for(var i =0;i<orders.length;i++){
      $('#sel'+orders[i].id).change(dropDownChange(i,'#sel'+orders[i].id));
    }

    for(var i=0;i<orders.length;i++){
      if(orders[i].Status.toLowerCase()=="placed"){
        $('#sel'+orders[i].id).val(1);
        console.log("placed")
      }else if(orders[i].Status.toLowerCase()=="ready"){
        $('#sel'+orders[i].id).val(2);
        console.log("ready")
      }else if(orders[i].Status.toLowerCase()=="complteted"){
        $('#sel'+orders[i].id).val(3);
        console.log("completed")

      }
      else{
        console.log("no match");
      }
    }
  }

  <?php

  include_once('php/db.php');

  $query = "Select * from suborder so
  inner join `order` o
  on so.OrderID = o.ID
  inner join customer c
	on c.ID = o.CustomerID
  inner join product p
	on so.ProductID = p.id
  inner join producttype pt
	on pt.id = p.ProductType_id
  where Status !='Completed'
  and
  o.Location_id = (Select LocationID from staffmember where Email = '".$_SESSION['staffusername']."')";
  $stmt = $mysql->prepare($query);
  try{
    $stmt->execute();
    $prevOrder = -1;
    //echo "var temp = new Order("+$prevOrder['OrderID']+",'"+$prevOrder['Name']+"','Placed');\n";
    $result = $stmt->fetchAll();
    foreach($result as $row){
      if($row['OrderID']!=$prevOrder){
        $prevOrder = $row['OrderID'];
        echo "var temp = new Order(".$row['OrderID'].",'".$row['Name']."','".$row["Status"]."');\n";
        echo "temp.addTo('".$row['ProductName']."',".$row['Quantity'].");\n";
      }
      else{
        echo "temp.addTo('".$row['ProductName']."',".$row['Quantity'].");\n";
      }
    }
  } catch( PDOException $e ){
    $e->getMessage();
  }

  ?>

  //var temp = new Order(1,"Gavin Henderson","Placed");
  //temp.addTo("Smelly Socks",10)
  //temp.addTo("another test",14)

  updateTable();
});
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Selected Option -->
	<div class="container col-md-9" style="background-color:#f7c986; border-radius:5px; padding:10px">
		<div class="container col-md-12 pre-scrollable" style="background-color:#ffecd8; padding:10px; max-height:600px; height:600px; border-radius:5px; border:1px solid lightgray">
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
			<div class="container" style="border-radius:5px">
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
			</div>
		  </table>

		</div>
	</div>
    <!-- Footer -->
    <?php include('php/footer.php'); ?>

</div>
</body>
</html>
