<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('./php/head.php'); ?>
</head>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>
	
    <!-- Options tab -->
    <?php include('./php/sidepanel.php'); ?>
	
    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#d3d3d3; height:420px; margin-top:60px; padding-top:20px; text-align:center;">
      <div class="container col-md-6">
        <label for="companyname">Company Name:</label>
        <input type="text" class="form-control" id="companyname" placeholder="Enter your company name" name="companyname">
        <label for="origin" style="padding-top:20px">Country of Origin:</label>
        <input type="text" class="form-control" id="origin" placeholder="Enter the country of origin" name="origin">
        <label for="desc" style="padding-top:20px">Description:</label>
        <textarea class="form-control" rows="5" id="desc" placeholder="Enter the product description" name="desc"></textarea>
      </div>
      <div class="container col-md-6">
        <label for="rep">Rep Name:</label>
        <input type="text" class="form-control" id="rep" placeholder="Enter your rep name" name="rep">
        <label for="password" style="padding-top:20px">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter the password" name="password">
      </div>
      <div class="container col-md-12" style="text-align: center">
        <form method="post">
        <button type="button" class="btn btn-primary btn-md" id="change" style="margin: auto; width:20%; margin-top: 15px;">Submit Changes</button>
        </form>   
    </div>
    </div>

        <!-- Footer -->
    <?php include('./php/footer.php'); ?>

    </div>
    </body>
    </html>


<?php
function testfun(){
include('php/db.php');

if (!empty($_POST["username"])) {
$email = $_POST['email'];
$companyname = $_POST['companyname'];
$country = $_POST['origin'];
$description = $_POST['desc'];
$repname = $_POST['rep'];
$password = $_POST['password'];
$query = "INSERT INTO manufacturer(Email, Password, Company,  RepName, CountryOfOrigin, Description) VALUES('$email', '$password', '$companyname', '$repname', '$country', '$description')";


try{
$stmt = $mysql->prepare($query);
$stmt->execute();
$result = $stmt->fetch();
$query = "INSERT INTO manufacturer(Email, Password, Company,  RepName, CountryOfOrigin, Description) VALUES('$email', '$password', '$companyname', '$repname', '$country', '$description')";
}catch( PDOException $e ){
  echo $e->getMessage();
}

header("location: index.php");
}
}
if(array_key_exists('change',$_POST)){
  testfun();
}
?>