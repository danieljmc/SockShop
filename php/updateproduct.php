<?php

session_start();

include('db.php');

$query = "update producttype set
          ProductName = '".$_POST['productname']."',
          Description = '".$_POST['desc']."',
          Price = ".$_POST['price']."
          where id=".$_POST['id'];
$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  header('Location: ../editproducts1.php');
} catch(PDOException $e){
  $e->getMessage();
}
?>
