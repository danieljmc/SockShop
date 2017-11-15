<?php session_start();

include('db.php');
$query = "update `order` set
          Status = '".$_POST['status']."'
          where id=".$_POST['orderID'];
try{
  $stmt = $mysql->prepare($query);
  $stmt->execute();
} catch( PDOException $e ){
  $e->getMessage();
}

header('Location: ../staffindex.php');


?>
