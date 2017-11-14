<?
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
        $stockCheck==False;
      }
    }
  } catch (PDOExecption $e){
    echo $e->getMessage();
  }

  if($stockCheck){
    $query = "INSERT INTO 17ac3d19.order(CustomerID, Location_id, Status)
              values((SELECT id from customer where Email='".$_SESSION['username']."'),".$_POST['locationID'].",'Placed')";
    $stmt = $mysql->prepare($query);
    $newOrderID = 0;
    try{
      $stmt->execute();
      $newOrderID = $mysql->lastInsertId();
    } catch( PDOExecption $e ){
      echo $e->getMessage();
    }

  }

?>
