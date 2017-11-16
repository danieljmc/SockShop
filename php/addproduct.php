<?php session_start();

  include('db.php');
  $query = "Insert into producttype set
            ProductName = '".$_POST['productname']."',
            Description = '".$_POST['desc']."',
            Material = '".$_POST['material']."',
            Price = '".$_POST['price']."',
            Manufacturer_id = (select id from manufacturer where Company = '".$_POST['manufacturer']."')";
  $stmt = $mysql->prepare($query);
  $newProductID = 0;
  try{
    $stmt->execute();
    $newProductID = $mysql->lastInsertId();
  } catch (PDOException $e){
    echo $e->getMessage();
  }

  foreach($_POST['colorsizes'] as $current){
    $query = "insert into product set
              ProductType_id = ".$newProductID.",
              Size = '".$current[0]."',
              Colour = '".$current[1]."'";
    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
    } catch(PDOException $e){
      $e->getMessage();
    }
  }

  header('Location: ../editproducts1.php')

?>
