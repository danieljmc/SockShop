<?php
include ("db.php");

if(!isset($_SESSION))
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{

$usernam = $_POST['username'];
//print ($usernam);

$pasword = $_POST['pasword'];


try{
//does query
$query = "SELECT * FROM manufacturer WHERE Email = '$usernam' and Password = '$pasword'";
//executes the query
$mysql->exec($query);
} catch ( PDOException $e ) 
{

}
//gets query, gets row, sets active row
$qresult = mysqli_query($db, $mysql);
$row = mysqli_fetch_array($qresult,MYSQLI_ASSOC);
$aresult = $row['active'];
//tests the resultsi n that row against the input
$rownum = mysqli_num_rows($result);
if($rownum == 1) {
$_SESSION['loggedIn'] = $usernam;
header("location: index.php");
}else 
    $error = "Invalid credentials";


}

?>