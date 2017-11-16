<?php session_start();

//ensure user is logged in before they access this page (*ahem*gavin forgot this part)
if (!isset($_SESSION['username'])) {
	header("Location: index.php");
}
?>
<!--

To add to the basket simply call add to basket and pass it the correct paramaters

-->

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>
</head>

<script>
$( document ).ready(function() {
  var total = 0;
  var items = 0;
  var promo = 0;
  var basket = new Map()

  class BasketOption{
    constructor(productID,productname,size,quantity,price,basketID){
      this.basketID = basketID
      this.productID = productID
      this.productname = productname
      this.size = size
      this.quantity = quantity
      this.price = price
      basket.set(productID, this)
    }
  }

  $('#promoButton').click(function(){
    if($('#promocode').val().toLowerCase()=="socks10"){
      promo = 0.1
      updateTotal()
    }
  });

  function updateTotal(){
    $('#items').text(items + " Items");
    $('#firsttotal').text("£"+total);
    $('#promo').text((promo*100)+"%")
    $('#secondtotal').text("£"+(1-promo)*total)
  }

  function addToBasket(productname,productID,size,quantity,price,basketID){
    new BasketOption(productID,productname,size,quantity,price,basketID)
    total += (price*quantity);
    items += quantity;
    var newItem = [
      //"<form method='POST' action='php/delfrombasket.php' method='post' id='"+basketID+"'></form>",
      //"<input type = \"hidden\" name = \"basketID\" form='"+basketID+"' value = \""+basketID+"\">",
      "<tr id=\"table"+productID+"\">",
        "<input type = \"hidden\" name = \"basketID\" form='remove"+basketID+"' value = \""+basketID+"\">",
        "<td><img src=\"pics/productPics/"+productID+"/1.jpg\" onerror=\"this.src='pics/logo.png'\" style=\"width:100px; height:100px;\">"+productname+"</td>",
        "<td style=\"padding-top:50px;\">"+size+"</td>",
        "<td style=\"padding-top:50px;\">"+quantity+"</td>",
        "<td style=\"padding-top:50px;\">£"+price+"</td>",
        "<td style=\"padding-top:50px;\">£"+(quantity*price)+"</td>",
        "<td style=\"padding-top:40px;\"><input id=\"button"+productID+"\" form='remove"+basketID+"' type=\"submit\" class=\"btn btn-default\"/ value='Remove'></td>",
      "</tr>"
    ]

    updateTotal();
    $("#basket").append(newItem.join(''));

    basket.forEach(function(value,key,map){
      $('#forms').append("<form method='POST' action='php/delfrombasket.php' method='post' id='remove"+value.basketID+"'></form>");
    });
  }

  <?php
    if(isset($_SESSION['error'])){
      echo "alert('There was not enough stock for this order');";
      unset($_SESSION['error']);
    }
  ?>

  <?php
    include_once('php/db.php');
    $query = "
    SELECT *
    FROM basket b
    inner join product p
	     on b.Product_id = p.id
    inner join producttype pt
	     on p.ProductType_id = pt.id
    where Customer_id = (select id from customer where email='".$_SESSION['username']."');";
    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
      $result = $stmt->fetchAll();
      foreach($result as $row){
        echo("addToBasket('".$row['ProductName']."','".$row['ProductType_id']."','".$row['Size']."',".$row['Quantity'].",".$row['Price'].",".$row['ID'].");\n");
      }
    } catch( PDOException $e ){
      echo $e->getMessage();
    }
  ?>
  updateTotal();
});
</script>

<body>

  <div id="forms" style="display:none;"></div>

  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Basket Pane -->
    <div class="container col-md-8 pre-scrollable" style="max-height:600px; padding-top:50px; padding-bottom:50px">
      <table class="table col-md-12">
        <thead>
          <tr>
            <th>Product</th>
            <th>Size</th>
            <th>Quantiy</th>
            <th>Price</th>
            <th>Total</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody id="basket">
        </tbody>
      </table>
    </div>

    <!-- to Checkout Pane -->
    <div class="container col-md-4" style="padding:30px">
      <h2 style="text-align:center;">Order Summary</h2>
      <div class="container col-md-6" style="text-align:right; font-size:120%;">
        <p id="items">5 Items</p>
        <p id="promo">0%</p>
        <p>Total</p>
      </div>
      <div class="container col-md-6" style="text-align:center; font-size:120%;">
        <p id="firsttotal">£120</p>
        <p>Promo</p>
        <p id="secondtotal">£120</p>
      </div>
      <hr/>

      <div class="container col-md-12" style="text-align:center;">
        <button type="button" class="btn btn-primary btn-md" id="continue" style="margin-top:30px;" onclick="window.location.href='checkout.php'">Continue To Checkout</button>
      </div>
    </div>

    <!-- The footer -->
    <?php include('php/footer.php'); ?>


  </div>
</body>
</html>

</html>
