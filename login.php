<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>
</head>

<body>
  <div class="container">

    <?php
      include('php/db.php');
      if (!empty($_POST["username"])) {
        $query = "select Password from customer where Email=\"".$_POST["username"]."\";";
        //echo $query;
        $stmt = $mysql->prepare($query);
        try{
          $stmt->execute();
          $result = $stmt->fetch();
					if(!($_POST["password"]=="")){
	          $password = $result['Password'];
	          if($_POST["password"]==$password){
	            $_SESSION["username"] = $_POST["username"];
	          }
					}
        } catch( PDOException $e ){
          echo $e->getMessage();
        }
      }

    ?>

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Login Details -->
    <div class="container col-md-5" style="padding-top:200px;">
      <div style="background-color:#d3d3d3; padding:20px">
        <form action="login.php" method="POST">
          <div class="form-group">
            <?php
              if(isset($_SESSION["username"])){
                echo "<p style=\"text-align:center\">Logged In!</p>";
              }

              if (!empty($_POST["username"])) {
                if(!isset($_SESSION["username"])){
                  echo "<p style=\"text-align:center\">Incorrect Password!</p>";
                }
              }
            ?>
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter your username" name="username">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
          </div>
          <button type="submit" class="btn btn-default">Login</button>
          <a href="createaccount.php">or Create a New Account</a>
        </form>
      </div>
    </div>

    <!-- Ad Panel -->
    <div class="container col-md-7" style="height:600px; padding:40px">
      <div style="background-color:blue; height:100%;"><img src="Pics/login.png"></div>
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>


</body>
</html>
