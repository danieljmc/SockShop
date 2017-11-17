<?php session_start();

include('db.php');

$query = "select * from batchorder where id=".$_POST['orderID'];

$stmt = $mysql->prepare($query);
$orderresult = 0;
try{
  $stmt->execute();
  $orderresult = $stmt->fetch();
}catch(PDOException $e){
  $e->getMessage();
}

$query = "select * from productquantity
          where
            LocationID = (select location_id from batchorder where id=".$_POST['orderID'].")
          and
            ProductID = (select Product_id from batchorder where id=".$_POST['orderID'].")";


$notEmpty = False;
$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  if($stmt->rowCount()>0){
    $notEmpty = True;
    $result = $stmt->fetch();
    $query = "update productquantity set
                quantity = ".($result['Quantity']+$orderresult['Quantity'])."
              where id=".$result['id'];

    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
    } catch(PDOException $e){
      echo $e->getMessage();
    }
  }else{
    $query = "insert into productquantity set
              LocationID = ".$orderresult['Location_id'].",
              ProductID = ".$orserresult['Product_id'].",
              Quantity = ".$orderresult['Quantity'];

    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
    } catch(PDOException $e){
      echo $e->getMessage();
    }
  }
} catch(PDOException $e){
  echo $e->getMessage();
}

$query = "update batchorder
          set Status='Recieved'
          where id =".$_POST['orderID'];
          echo $query;

$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  header('Location: ../recievestock.php');
}catch(PDOException $e){
  $e->getMessage();
}
?>
