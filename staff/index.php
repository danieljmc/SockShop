<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../php/head.php'); ?>
</head>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('../php/header.php'); ?>

    <!-- Options tab -->
    <div class="container col-md-3" style="padding-top:60px; padding-bottom:60px;">
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:grey;">
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
      <div class="container col-md-12" style="padding-top:10px; padding-bottom: 10px; font-size:120%; background-color:#d3d3d3;">
        <p>Edit Products</p>
      </div>
    </div>

    <!-- Selected Option -->
    <div class="container col-md-9 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
      <table class="table table-bordered col-md-12">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Products</th>
            <th>Quantity</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Gavin Henderson</td>
            <td>Sock Type 1</td>
            <td>2</td>
            <td>
              <select class="form-control" id="sel1">
                <option>Placed</option>
                <option>Ready</option>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Sock Type 2</td>
            <td>2</td>
            <td></td>
          </tr>
        </tbody>
      </table>

    </div>

    <!-- Footer -->
    <?php include('../php/footer.php'); ?>

</div>
</body>
</html>
