<?php session_start();

include('db.php');

$query = "update batchorder
          set Status='Recieved'
          where id =".$_POST['orderID'];
$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  header('Location: ../recievestock.php');
}catch(PDOException $e){
  $e->getMessage();
}
?>
