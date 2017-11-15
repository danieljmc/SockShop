<?php
  session_start();
  include('db.php');

//  var_dump($_POST);

  $query1 = "SELECT *,
	         if(b.Quantity < pq.Quantity, True, False) as QuantCheck
           From basket b
           inner join customer c
	         on b.Customer_id = c.id
           inner join productquantity pq
	         on pq.ProductID = b.Product_id
           where c.Email = '".$_SESSION['username']."' and pq.LocationID = ".$_POST['locationID'];

  $query2 = "SELECT * FROM basket b
            inner join customer c
            on b.Customer_id = c.id
            where c.Email='".$_SESSION['username']."'";

  $stockCheck = True;
  $stmt1 = $mysql->prepare($query1);
  $stmt2 = $mysql->prepare($query2);
  try{
    $stmt1->execute();
    $stmt2->execute();
    $result = $stmt1->fetchAll();
    if($stmt1->rowCount()!=$stmt2->rowCount()){
      $stockCheck = False;
    }
    foreach($result as $row){
      if($row['QuantCheck']==0){
        $stockCheck=False;
      }
    }
  } catch (PDOExecption $e){
    echo $e->getMessage();
  }

  if($stockCheck==True){
    $query1 = "INSERT INTO `order`(CustomerID, Location_id, Status)
              values((SELECT id from customer where Email='".$_SESSION['username']."'),".$_POST['locationID'].",'Placed')";
    $query2 = "select * from basket where customer_id=(select id from customer where email='".$_SESSION['username']."')";
    $query3 = "delete from basket where customer_id=(select id from customer where email='".$_SESSION['username']."')";
    $stmt1 = $mysql->prepare($query1);
    $stmt2 = $mysql->prepare($query2);
    $stmt3 = $mysql->prepare($query3);
    $newOrderID = 0;
    try{
      $stmt1->execute();
      $newOrderID = $mysql->lastInsertId();
      $stmt2->execute();
      $stmt3->execute();
      $result1 = $stmt1->fetchAll();
      $result2 = $stmt2->fetchAll();
      $result3 = $stmt3->fetchAll();
      foreach($result2 as $row){
        $query = "insert into suborder(OrderID,ProductID,Quantity)
                  values(".$newOrderID.",".$row['Product_id'].",".$row['Quantity'].")";
        $updatequery = "update productquantity set quantity = Quantity-".$row['Quantity']."
                        where ProductID = ".$row['Product_id']." and LocationID = ".$_POST['locationID'];
        $stmt = $mysql->prepare($query);
        $stmt->execute();
        $stmt = $mysql->prepare($updatequery);
        $stmt->execute();
        //var_dump($stmt->fetchAll());

      }
    } catch( PDOExecption $e ){
      echo $e->getMessage();
    }
    header('Location: ../index.php');
    }else{
      $_SESSION['error'] = True;
      header('Location: ../basket.php');

    }

?>
