<?php
  include('db.php');
  $query = "delete from basket where id = ".$_POST['basketID'];
  $stmt = $mysql->prepare($query);
  try{
    $stmt->execute();
    header( 'Location: ../basket.php' ) ;
  } catch ( PDOException $e ){
    $e->getMessage();
  }

?>
