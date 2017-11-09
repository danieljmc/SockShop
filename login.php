<?php
include "db.php";

IF()

session_start();

$usernam = $_POST['username'];
//print ($username);

$pasword = $_POST['pasword'];
//print ($username);

try{
// Create the SQL Query
$query = "SELECT * FROM customer WHERE Email = '$usernam' and Password = '$pasword'";
// Execute the query on the database
$mysql->exec($query);
} catch ( PDOException $e ) {
}

$qresult = mysqli_query($db,$sql);
$row = mysqli_fetch_array($qresult,MYSQLI_ASSOC);
$result = $row['active'];

$count = mysqli_num_rows($result);

$_SESSION['loggedIn'] = $usernam;

?>