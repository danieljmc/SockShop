<?php
session_start();
include('php/db.php');
if (!empty($_POST["username"])) {
$query = "select Password from manufacturer where Email=\"".$_POST["username"]."\";";
//echo $query;
$stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
      $result = $stmt->fetch();
      $password = $result['Password'];
      if($_POST["password"]==$password){
        $_SESSION["manusername"] = $_POST["username"];
        header("Location: manufacturerindex.php");
      }
    } catch( PDOException $e ){
      echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>
</head>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Login Details -->
    <div class="container col-md-5" style="padding-top:80px; padding-bottom:80px; margin-left:auto; margin-right:auto; float:none;">
      <div style="background-color:#ffecd8; padding:50px; border-radius:5px;">
        <center>
		<img src="Pics/manufacturerlogin.png" style="margin-left:auto; margin-right:auto; max-width:250px; margin-top:-30px; margin-bottom:20px"></img>
		</center>
        <form action="manufacturerlogin.php" method="POST">
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
		  <center>
          <button type="submit" class="btn btn-default" style="width:100px; margin-top:10px; margin-bottom:-20px">Login</button>
		  </center>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

</body>
</html>
