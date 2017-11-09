<?php
include "db.php";

session_start();

$usernam = $_POST['username'];
//print ($username);

$pasword = $_POST['pasword'];
//print ($username);

$query = "SELECT * FROM customer WHERE Email = '$usernam' and Password = '$pasword'";
$qresult = mysqli_query($db,$sql);
$row = mysqli_fetch_array($qresult,MYSQLI_ASSOC);
$result = $row['active'];

$count = mysqli_num_rows($result);

$_SESSION['loggedIn'] = $usernam;

?>