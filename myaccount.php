<?php session_start(); ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>
</head>

<body>

  <?php

    include('php/db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $userfname = $_POST['name'];
      $userfname;
      $useremail = $_POST['email'];
      $address = $_POST['address'];
      $pasword = $_POST['password'];
      $dob = $_POST['dob'];
      $sessionemail = $_SESSION['username'];
      $query = "UPDATE customer SET
        name='$userfname',
        email='$useremail',
        address='$address',
        password='$pasword',
        dob='$dob'
      where email='$sessionemail'";
      $stmt = $mysql->prepare($query);
      try{
        $stmt->execute();
        $_SESSION['username'] = $useremail;
      } catch ( PDOException $e ) {
          echo $e->getMessage();
      }
    }

    $FullName = "";
    $Address = "";
    $DOB = "";
    $Email = "";
    $Password = "";

    $query = "select * from customer where Email='".$_SESSION['username']."'";
    $stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
      $result = $stmt->fetch();
      $FullName = $result['Name'];
      $Address = $result['Address'];
      $DOB = $result['DOB'];
      $Email = $result['Email'];
      $Password = $result['Password'];
    } catch( PDOException $e ){
      echo $e->getMessage();
    }
  ?>

  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Create Panel -->
    <div class="container col-md-12" style="text-align:center;">
      <form method="post">
        <div class="form-group">
		  <center>
			<img src="Pics/accinfo.png" style="max-width:400px"></img>
		  </center>
          <label for="name" style="padding-top:30px;">Full Name:</label>
          <input type="text" class="form-control" id="name" value="<?php echo $FullName; ?>" name="name" style="margin: auto; width:40%;">
          <label for="address" style="padding-top:30px;">Address:</label>
          <input type="text" class="form-control" id="address" value="<?php echo $Address; ?>" name="address" style="width:40%; margin: auto;">
          <label for="dob" style="padding-top:30px;">Date Of Birth:</label>
          <input type="text" class="form-control" id="dob" value="<?php echo $DOB; ?>" name="dob" style="width:40%; margin: auto;">
          <label for="email" style="padding-top:30px;">Email:</label>
          <input type="email" class="form-control" id="email" value="<?php echo $Email; ?>" name="email" style="width:40%; margin: auto;">
          <label for="password" style="padding-top:30px;">Password:</label>
          <input type="password" class="form-control" id="password" value="<?php echo $Password; ?>" name="password" style="width:40%; margin: auto;">
          <button type="submit" class="btn btn-default" style="margin-top:30px;">Submit</button>
        </div>
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

  </div>
</body>
</html>
