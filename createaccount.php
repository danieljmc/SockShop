<?php session_start(); ?>

<?php

  include ("php/db.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userfname = $_POST['name'];
    $useremail = $_POST['email'];
    $address = $_POST['address'];
    $pasword = $_POST['password'];
    $dob = $_POST['dob'];
    try{
      //does query
      $query = "INSERT INTO customer(name, email, address, password, dob) VALUES('$userfname', '$useremail', '$address', '$pasword', '$dob')";
      $_SESSION['username'] = $useremail;
      //executes the query
      $mysql->exec($query);
      //header("location: /index.php");
      $_SESSION['username'] == $useremail;
    } catch ( PDOException $e ) {
        echo $e->getMesssage();
    }
  }
  ?>

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
    <?php include('php/header.php'); ?>



    <!-- Create Panel -->
    <div class="container col-md-12" style="text-align:center;">
      <form method="post">
        <div class="form-group">
          <label for="name" style="padding-top:30px;">Full Name:</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your fullname" name="name" style="margin: auto; width:40%;">
          <label for="address" style="padding-top:30px;">Address:</label>
          <input type="text" class="form-control" id="address" placeholder="Enter your address" name="address" style="width:40%; margin: auto;">
          <label for="dob" style="padding-top:30px;">Date Of Birth:</label>
          <input type="text" class="form-control" id="dob" placeholder="dd/mm/yyyy" name="dob" style="width:40%; margin: auto;">
          <label for="email" style="padding-top:30px;">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" style="width:40%; margin: auto;">
          <label for="password" style="padding-top:30px;">Password:</label>
          <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" style="width:40%; margin: auto;">
          <button type="submit" class="btn btn-default" style="margin-top:30px;">Create</button>
        </div>
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

  </div>
</body>
</html>
