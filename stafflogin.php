<?php
session_start();

if(isset($_SESSION["staffusername"])){
  header('Location: staffindex.php');
}

include('php/db.php');
if (!empty($_POST["username"])) {
$query = "select Password from staffmember where Email=\"".$_POST["username"]."\";";
//echo $query;
$stmt = $mysql->prepare($query);
    try{
      $stmt->execute();
      $result = $stmt->fetch();
      $password = $result['Password'];
      if($_POST["password"]==$password){
        $_SESSION["staffusername"] = $_POST["username"];
        header('Location: staffindex.php');
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
    <div class="container col-md-5" style="padding-top:100px;">
      <div style="background-color:#d3d3d3; padding:20px">
        <h1>Staff Login</h1>
        <form action="stafflogin.php" method="POST">
          <div class="form-group">
            <?php
              if(isset($_SESSION["staffusername"])){
                echo "<p style=\"text-align:center\">Logged In!</p>";
              }

              if (!empty($_POST["username"])) {
                if(!isset($_SESSION["staffusername"])){
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
        </form>
      </div>
    </div>

    <!-- Ad Panel -->
    <div class="container col-md-7" style="height:600px; padding:40px">
      <div style="background-color:blue; height:100%;"></div>
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

</body>
</html>
