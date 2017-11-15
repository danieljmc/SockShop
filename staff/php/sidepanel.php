<div class="container col-md-3" style="padding-top:60px; padding-bottom:60px;">
  <a href="index.php"><div id="vieworders" class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
    <p>View Placed Orders</p>
  </div></a>
  <a href="checkstock.php"><div id="checkstock" class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
    <p>Check Stock</p>
  </div></a>
  <div id="newstock" class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
    <p>Order New Stock</p>
  </div>
  <div id="recievestock" class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
    <p>Recieve Stock</p>
  </div>
  <div id="editaccount" class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
    <p>Edit Account</p>
  </div>
  <div id="editproducts" class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
    <p>Edit Products</p>
  </div>

  <?php
  include('../php/db.php');
  $query = "SELECT Admin FROM staffmember where Email='".$_SESSION['staffusername']."'";
  $stmt = $mysql->prepare($query);
  $isAdmin = False;
  try{
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['Admin']){
      $isAdmin = True;
    }
  } catch ( PDOException $e ){
    echo $e->getMessage();
  }

  if($isAdmin){
    echo "<div id=\"editaccounts\" class=\"container col-md-12\" style=\"padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;\">
      <p>Edit Accounts</p>
    </div>
    <div id=\"editmanufacturers\" class=\"container col-md-12\" style=\"padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;\">
      <p>Edit Manufacturers</p>
    </div>";
  }

  ?>
</div>
