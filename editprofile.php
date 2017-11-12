<?php

include ("db.php");

$userfname = $_POST['fname'];
$userlname = $_POST['lname'];
$accnum = $_POST ['bankacc'];
$useremail = $_POST['email'];
$phoneno = $_POST['phone'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$sortcode = $_POST['banksort'];
$natinsnumber = $_POST['nationalinsurance'];
$password = $_POST['password'];



try{
    //does query
    $query = "SELECT * FROM customer /*WHERE Email = '$usernam' and Password = '$pasword'*/";
    //executes the query
    $mysql->exec($query);
    } catch ( PDOException $e ) {}

?>