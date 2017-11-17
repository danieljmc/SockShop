<?php
session_start();
include_once('php/db.php');
if (!isset($_SESSION['manusername'])) header("Location: index.php");
if (!isset($_GET['id'])) {
  header("Location: manufacturerindex.php");
}
if (isset($_POST['options']) && isset($_POST['reason'])) {
  $query = $mysql->prepare("UPDATE batchorder SET status=:options where id=:id");
  $query->execute(array(':id' => $_POST['id'], ':options' => $_POST['options']));
}
$query = $mysql->prepare('SELECT * FROM batchorder b INNER JOIN producttype pt ON b.product_id = pt.id INNER JOIN location l ON b.Location_id=l.id where b.id=:id;');
$query->execute(array(':id' => $_GET['id']));
$result = $query->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('php/head.php');?>
</head>

<body>
  <div class="container">

    <?php include_once('php/header.php'); ?>

    <!-- Options tab -->
    <div class="container col-md-3" style="padding-top:60px; padding-bottom:60px">
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#ffecd8; border-radius: 5px">
        <p style="padding-top:10px;"><a href="manufacturerindex.php">View Orders</a></p>
      </div>
    </div>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#f7c986; padding-top:10px; padding-bottom:10px; text-align:center; border-radius: 5px;">
      <div class="container col-md-6" style="font-size:120%; background-color:#ffecd8; border-radius: 5px; border: 1px solid lightgray; margin:auto;">
        <div style="padding-top:5px">
			<div class="container col-md-6">
			  <p>Product:</p>
			</div>
			<div class="container col-md-6">
			  <p><?php echo $result['ProductName'];?></p>
			</div>
		</div>
        <div class="container col-md-6" style="padding-top:20px;">
          <p>Order Status:</p>
        </div>
        <div class="container col-md-6" style="padding-top:20px;">
          <p><?php echo $result['Status']; ?></p>
        </div>
        <form action="manufacturerorder.php" method="post">
          <?php $_POST['id'] = $_GET['id']; ?>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-success">
              <input type="radio" name="options" value="Sent" id="sent" autocomplete="on" checked> Sent</input>
            </label>
          <label class="btn btn-secondary active">
            <input type="radio" name="options" value="Accepted" id="accept" autocomplete="on" checked> Accept</input>
          </label>
          <label class="btn btn-danger">
            <input type="radio" name="options" value="Declined" id="decline" autocomplete="off"> Decline </input>
          </label>
        </div>
        <div class="container col-md-12" style="padding-top:20px;">
          <p>Reason for choice:</p>
        </div>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <div class="container col-md-12" style="padding-top:0px;">
          <input type="text" placeholder="Enter your reason" name="reason" class="form-control" id="reason">
        </div>
        <div class="col-md-12 container" style="padding-top:20px;">
          <button type="submit" class="btn btn-primary btn-md" id="submit" style="max-width:25%; margin-bottom:10px;">Submit</button>
        </div>
      </div>
    </form>
	  <div class="container col-md-6" style="font-size:120%; background-color:#ffecd8; border-radius: 5px; border: 1px solid lightgray; margin:auto;">
			<p>Ordering Store:</p>
			<p><?php echo $result['Address'] . ', ' . $result['LocationName']; ?></p>
	  </div>
    </div>

    <!-- The footer -->
    <?php include('php/footer.php')?>

    </div>
    </body>
    </html>
