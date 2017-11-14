<?php
include "db.php";

$companyname = $_POST['companyname'];
$country = $_POST['origin'];
$description = $_POST['desc'];
$repname = $_POST['rep'];
$password = $_POST['password'];

try{

$query = "INSERT INTO manufacturer(name, orgin, description, rep, password) VALUES('$companyname', '$country', '$description', '$repname', '$password')";

mysql->exec($query);
}catch(PDOException e){

}

?>