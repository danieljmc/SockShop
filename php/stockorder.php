<?php

session_start();
include('db.php');


$query = "Insert into batchorder(Location_id,Manufacturer_id,Product_id,Quantity,Status)
          values(
          (select LocationID from staffmember where Email='".$_SESSION['staffusername']."'),
          (select Manufacturer_id from product p
          inner join producttype pt
		        on p.ProductType_id = pt.id
          where p.id=".$_POST['productID']."),
          (".$_POST['productID']."),
          (".$_POST['Quantity']."),
          'Placed'
          )";
$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  header('Location: ../orderstock.php');
} catch (PDOException $e) {
  $e->getMessage();
}

?>
