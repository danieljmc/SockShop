<?php session_start(); ?>

<!--

To add an item to the table and the total just call addItem with the paramaters of the object
You cannot delete this point

-->

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>
</head>

<style>
.table td{
  border: black solid 1px !important;
}

.table th{
    border: black solid 1px !important;
}
</style>

<script>
$(document).ready(function() {
  var total=0;
  var promo=0;

  function updateTotal(){
    $('#subtotal').text("Subtotal: £"+total);
    $('#discount').text("Discounts: "+(promo*100)+"%")
    $('#total').text("Total: £"+(total*(1-promo)))
  }

  function addItem(productname,size,quantity,price){
    total += (price*quantity)
    var newItem = [
      "<tr>",
        "<td>"+productname+"</td>",
        "<td>"+size+"</td>",
        "<td>"+quantity+"</td>",
        "<td>£"+price+"</td>",
        "<td>£"+(quantity*price)+"</td>",
      "</tr>"
    ]
    $('#tablebody').append(newItem.join(""));
    updateTotal();
  }

  <?php
    include_once('php/db.php');

    $query = "
    select pt.ProductName, b.Quantity, p.size, pt.price  from basket b
    inner join customer c
	     on c.id = b.Customer_id
    inner join product p
	     on p.id = b.Product_id
    inner join producttype pt
	     on p.ProductType_id = pt.id
    where Email = '".$_SESSION['username']."'";
    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
      $result = $stmt->fetchAll();
      foreach($result as $row){
        echo("addItem('".$row['ProductName']."','".$row['size']."',".$row['Quantity'].",".$row['price'].");\n");
      }
    } catch( PDOException $e ){
      echo $e->getMessage();
    }
  ?>

  /*addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)
  addItem("Sport Socks", "Small", 2, 10)*/


  function getDistances(stores, lat, long){
    var geocoder = new google.maps.Geocoder;
    var service = new google.maps.DistanceMatrixService;
    var origin = new google.maps.LatLng(lat, long);

    var destinations = [];
    for(var i=0;i<stores.length;i++){
      destinations.push(new google.maps.LatLng(stores[i].lat, stores[i].long));
    }

    service.getDistanceMatrix({
      origins: [origin],
      destinations: destinations,
      travelMode: 'DRIVING',
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status !== 'OK') {
        alert('Error was: ' + status);
      } else {
        for(var i=0;i<response.rows[0].elements.length;i++){
          stores[i].distanceVal = response.rows[0].elements[i].distance.value;
          stores[i].distanceText = response.rows[0].elements[i].distance.text;
          stores[i].durationText = response.rows[0].elements[i].duration.text;
        }
        sortStores(stores);
        updateStores(stores);
      }
    });
  }

  function Store(id, lat, long, name, address){
    this.id = id;
    this.long = long;
    this.lat = lat;
    this.name = name;
    this.address = address;
    this.distanceVal = 0;
    this.distanceText = 0;
    this.durationText = 0;
  }

  function selectStore(i) {
    return function() {
      $('#locationID').val(i+1);
      $('#selectedstore').text(stores[i].name + ", "+stores[i].address)
    }
  }

  function updateStores(stores)
  {
    $('#locations').empty();
    for(var i = 0;i<stores.length;i++){
      var newLocation = "<div class=\"container col-md-12 well\" id=\"location"+i+"\" style = \"background-color:#d3d3d3; padding-top:10px; font-size:120%\"><p>City: "+stores[i].name+"</p><p>Address: "+stores[i].address+"</p><p>Distance: "+stores[i].distanceText +"</p><p>Travel Time: "+stores[i].durationText+"</p><button type=\"button\" class=\"btn btn-primary btn-md\" id=\"select"+i+"\">Select</button></div>"
      var newButton = $(newLocation).click(selectStore(i));
      $('#locations').append(newButton);
    }
  }

  function sortStores(stores){
    for (var i = 1; i < stores.length; i++) {
      var tmp = stores[i];
      for (var j = i - 1; j >= 0 && (stores[j].distanceVal > tmp.distanceVal); j--) {
        stores[j + 1] = stores[j];
      }
      stores[j + 1] = tmp;
    }
  }

  var stores = [];
  stores.push(new Store(1, 56.459101, -2.972326, "Dundee", "Nethergate"));
  stores.push(new Store(2, 55.954064, -3.203514, "Edinburgh", "Princess Street"));
  stores.push(new Store(3, 55.861392, -4.248592, "Glasgow", "George Square"));
  stores.push(new Store(4, 57.146151, -2.100288, "Aberdeen", "Union Street"));

  updateStores(stores);

  var postcodeLong;
  var postcodeLat;
  $( "#search" ).click(function() {
    $.get( "https://api.postcodes.io/postcodes/"+$('#postcode').val().replace(/\s/g, ''))
    .done(function(data) {
      postcodeLat = data.result.latitude;
      postcodeLong = data.result.longitude;

      getDistances(stores, postcodeLat, postcodeLong);
      var sorted = sortStores(stores);
    })
    .fail(function() {
      alert( "postcode doesnt exist" );
    })
  });
  var x = selectStore(0)
  x();
});
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMiZs865Ub7z9aN2gKZrfcSF8ruSoMz2E&callback=initMap">
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Location picker -->
    <div class="container col-md-4 border" style="background-color:#d3d3d3; height:600px; border:1px solid black;">
      <row>
        <h3 class="col-12-md" style="text-align:center;">Find Locations</h3>
      </row>
      <row>
        <div class="container col-md-12" style="padding-top:20px">
          <p class="col-md-3" style="text-align:left; font-size:120%; padding-top:7px;">Postcode:</p>
          <div class="col-md-6">
            <input type="text" placeholder="postcode" class="form-control" id="postcode">
          </div>
          <button type="button" class="btn btn-primary btn-md" id="search">Search</button>
        </div>
      </row>
      <row>
        <div class="container col-md-12 pre-scrollable" id="locations" style="padding-top:10px; height:100%; max-height: 480px">
          <div class="container col-md-12 well" id="location1" style = "background-color:#d3d3d3; padding-top:10px; font-size:120%">
          </div>
        </div>
      </row>
    </div>

    <!-- Checkout Pane -->
    <div class="container col-md-8" style="background-color:#d3d3d3; height:600px; border:1px solid black;">
      <row style="text-align:center;">
        <h2>Order Summary</h3>
      </row>

      <row>
        <div class="container col-md-12 pre-scrollable" style="height:200px;">
          <table class="table table-bordered col-md-12">
            <thead>
              <tr>
                <th>Product</th>
                <th>Size</th>
                <th>Quantiy</th>
                <th>Price</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="tablebody">

            </tbody>
          </table>
        </div>
      </row>
      <row>
        <div class="container col-md-6" style="padding-top:20px; text-align:center;">
          <h3>Selected Store:</h3>
          <h3 id="selectedstore">Pick A Store</h3>
        </div>
        <div class="container col-md-6" style="padding-top:50px; text-align:right; font-size:120%; padding-right:80px;">
          <p id="subtotal">SubTotal: £20</p>
          <p id="discount">Discounts: £-6</p>
          <p id="total">Total: £14</p>
          <form style="display-type:none;" method="post" action="php/completeorder.php">
            <input name='locationID' id='locationID' hidden />
            <button type="submit" class="btn btn-primary btn-md" id="pay">Pay now with PayPal</button>
          </form>
        </div>
      </row>
      <row>
        <div class="container col-md-12" style="font-size:120%; padding-top: 40px;">
          <p>
            Your order will be ready to pick up in the store by tomorrow. Please bring ID to prove who you are.
          </p>
        </div>
      </row>
    </div>

    <!-- The footer -->
    <?php include('php/footer.php'); ?>

  </div>
</body>
</html>
