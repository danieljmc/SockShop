<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sock Shop</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=800, initial-scale=1">
</head>

<body>
  <div class="container">

    <!-- The navbar -->
    <nav class="nav navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Sock Shop</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Stores</a></li>
          <li><a href="#">My Account</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Login</a></li>
        </ul>
        <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </nav>

    <!-- Options tab -->
    <div class="container col-md-3" style="padding-top:60px; padding-bottom:60px;">
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>View Placed Orders</p>
      </div>
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>Check Stock</p>
      </div>
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>Order New Stock</p>
      </div>
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>Recieve Stock</p>
      </div>
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>Edit Account</p>
      </div>
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:gray;">
        <p>Edit Products</p>
      </div>
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>Edit Accounts</p>
      </div>
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>Edit Manufacturers</p>
      </div>
    </div>

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
    <div class="col-md-12" style="background-color:grey; padding-top:20px;">
      <ul class="col-md-4" style="text-align:center; list-style-type: none;">
        <li>Company</li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Careers</a></li>
      </ul>
      <ul class="col-md-4" style="text-align:center; list-style-type: none;">
        <li>More</li>
        <li><a href="#">Acessibility</a></li>
        <li><a href="#">Legal</a></li>
        <li><a href="#">Privacy</a></li>
        <li><a href="#">Terms of Use</a></li>
      </ul>
      <ul class="col-md-4" style="text-align:center; list-style-type: none;">
        <li>Login</li>
        <li><a href="#">Staff</a></li>
        <li><a href="#">Manufacturer</a></li>
        <li><a href="#">Customer</a></li>
      </ul>
    </div>

    </div>
    </body>
    </html>


<?php
include('php/db.php');

if (!empty($_POST["username"])) {
$email = $_POST['email'];
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
}
?>