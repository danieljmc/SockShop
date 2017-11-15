<?php
include "db.php";

$email = $_POST['email']
$companyname = $_POST['companyname'];
$country = $_POST['origin'];
$description = $_POST['desc'];
$repname = $_POST['rep'];
$password = $_POST['password'];

try{

$query = "INSERT INTO manufacturer(Email, Password, Company,  RepName, CountryOfOrigin, Description) VALUES('$email', '$password', '$companyname', '$repname', '$country', '$description')";

mysql->exec($query);
}catch(PDOException e){

}

header("location: index.php");

?>