<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php') ?>
</head>
<script>
$('document').ready(function(){
  $('#editaccounts').css('background-color','gray')
  var staff = []
  class Staff{
    constructor(id, Name, Wage, Hours, location){
      this.id = id
      this.name = Name
      this.wage = Wage
      this.hours = Hours
      this.location = location
      staff.push(this);
    }

    getHtml(){
      return [
        "<tr>",
        "<td>"+this.id+"</td>",
        "<td>"+this.name+"</td>",
        "<td>"+this.wage+"</td>",
        "<td>"+this.hours+"</td>",
        "<td>"+this.location+"</td>",
      "</tr>"].join("")
    }
  }

  function updateTable(){
    var htmlstring = "";
    for(var i =0;i<staff.length;i++){
      htmlstring += staff[i].getHtml();
    }
    $('#tablebody').empty()
    $('#tablebody').append(htmlstring)
  }

  <?php

  include('php/db.php');

  $query = "SELECT FirstName,Surname,Wage,WeeklyHours,LocationName, sm.id FROM staffmember sm
inner join staffposition sp
	on sm.StaffPositionsID = sp.id
inner join location l
	on l.id = sm.LocationID";

  $stmt = $mysql->prepare($query);
  try{
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach($results as $row){
      echo "new Staff(".$row['id'].",'".$row['FirstName']." ".$row['Surname']."',".$row['Wage'].",".$row['WeeklyHours'].",'".$row['LocationName']."');\n";
    }
  } catch(PDOException $e){
    echo $e->getMessage();
  }

  ?>

  new Staff(0,"Gavin","10","10","Dundee")


  updateTable();
})
</script>
<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#d3d3d3; height:800px">
      <div class="container col-md-12" style="padding-top:15px; padding-bottom:15px;">
        <div class="col-md-3 container">
          <input type="text" placeholder="Staff ID" class="form-control" id="staffID">
        </div>
        <div class="col-md-3 container">
          <button type="button" class="btn btn-primary btn-md" id="update" style="width:100%">Update</button>
        </div>
        <div class="container col-md-6" style="text-align:right;">
          <button type="button" onclick='window.location.href="editaccounts2.php"' class="btn btn-primary btn-md" id="add">Add a New Staff Member</button>
        </div>
      </div>
      <div class="container col-md-12 pre-scrollable" style="background-color:#d3d3d3; max-height:600px; height:600px">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Staff ID</th>
              <th>Name</th>
              <th>Wage</th>
              <th>Weekly Hours</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody id="tablebody">
            <tr>
              <td>0</td>
              <td>Gavin Henderson</td>
              <td>£10</td>
              <td>10</td>
              <td>Dundee</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

    </div>
</body>
</html>
