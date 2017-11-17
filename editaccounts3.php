<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('php/head.php'); ?>
</head>
<script>
$('document').ready(function(){
  $('#editaccounts').css('background-color','#f7c986')

  <?php

  include('php/db.php');
  $query = 'select * from staffmember
            inner join staffposition
              on staffposition.id = staffmember.StaffPositionsID
            inner join location
              on location.id = staffmember.LocationID
            where staffmember.id='.$_GET['staffID'];
  $stmt = $mysql->prepare($query);
  try{
    $stmt->execute();
    $result = $stmt->fetch();
    echo "$('#fname').val('".$result['FirstName']."');\n";
    echo "$('#lname').val('".$result['Surname']."');\n";
    echo "$('#bankacc').val('".$result['BankAccountNo']."');\n";
    echo "$('#email').val('".$result['Email']."');\n";
    echo "$('#phone').val('".$result['PhoneNo']."');\n";
    echo "$('#weeklyhrs').val('".$result['WeeklyHours']."');\n";
    echo "$('#position').val('".$result['Name']."');\n";
    echo "$('#address').val('".$result['Address']."');\n";
    echo "$('#postcode').val('".$result['Postcode']."');\n";
    echo "$('#banksort').val('".$result['SortCode']."');\n";
    echo "$('#nationalinsurance').val('".$result['NationalInsuranceNo']."');\n";
    echo "$('#password').val('".$result['Password']."');\n";
    echo "$('#wage').val('".$result['Wage']."');\n";
    echo "$('#location').val('".$result['LocationName']."');\n";

    if($result['Admin']==1){
      echo "$('#admin').val('Yes');\n";
    }
    else{
      echo "$('#admin').val('No');\n";
    }

  }catch(PDOException $e){
    echo $e->getMessage();
  }

  ?>
})
</script>
<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Options tab -->
    <?php include('php/sidepanel.php'); ?>

    <!-- Check Stock -->
    <form action='php/updatestaffaccount.php' method='post'>
      <div class="container col-md-9" style="background-color:#ffecd8; height:700px; padding-top:20px; text-align:center; border-radius:5px">
        <div class="container col-md-6">
          <label for="fname">First Name:</label>
          <input type="text" class="form-control" id="fname" placeholder="Enter your first name" name="fname">
          <label for="lname" style="padding-top:20px">Last Name:</label>
          <input type="text" class="form-control" id="lname" placeholder="Enter your last name" name="lname">
          <label for="bankacc" style="padding-top:20px">Bank Account No:</label>
          <input type="text" class="form-control" id="bankacc" placeholder="Enter your bank account" name="bankacc">
          <label for="email" style="padding-top:20px">Email Address:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your Email" name="email" readonly>
          <label for="phone" style="padding-top:20px">Phone No:</label>
          <input type="text" class="form-control" id="phone" placeholder="Enter your Phone No" name="phone">
          <label for="weeklyhrs" style="padding-top:20px">Weekly Hours:</label>
          <input type="text" class="form-control" id="weeklyhrs" placeholder="Enter your Weekly Hrs" name="weeklyhrs">
          <label for="position" style="padding-top:20px">Position:</label>
          <input type="text" class="form-control" id="position" placeholder="Enter your Position" name="position">
        </div>
        <div class="container col-md-6">
          <label for="address">Address:</label>
          <input type="text" class="form-control" id="address" placeholder="Enter your address" name="address">
          <label for="postcode" style="padding-top:20px">Postcode:</label>
          <input type="text" class="form-control" id="postcode" placeholder="Enter your postcode" name="postcode">
          <label for="banksort" style="padding-top:20px">Bank Sort Code:</label>
          <input type="text" class="form-control" id="banksort" placeholder="Enter your bank sort code" name="banksort">
          <label for="nationalinsurance" style="padding-top:20px">National Insurance:</label>
          <input type="text" class="form-control" id="nationalinsurance" placeholder="Enter your National Insurance" name="nationalinsurance">
          <label for="password" style="padding-top:20px">Password:</label>
          <input type="text" class="form-control" id="password" placeholder="Enter your password" name="password">
          <label for="wage" style="padding-top:20px">Wage P/H:</label>
          <input type="text" class="form-control" id="wage" placeholder="Enter your wage" name="wage">
          <label for="location" style="padding-top:20px">Location:</label>
          <select class="form-control" id="location" name="location">
            <option value='Dundee'>Dundee</option>
            <option value='Edinburgh'>Edinburgh</option>
            <option value='Glasgow'>Glasgow</option>
            <option value='Aberdeen'>Aberdeen</option>
          </select>
          <label for="admin" style="padding-top:20px">Admin Access:</label>
          <select class="form-control" id="admin" name="admin">
            <option value='No'>No</option>
            <option value='Yes'>Yes</option>
          </select>
        </div>
        <div class="container col-md-12" style="text-align: center">
          <button type="submit" class="btn btn-primary btn-md" id="change" style="margin: auto; width:20%; margin-top: 15px;">Submit Changes</button>
        </div>
      </div>
    </form>

    <!-- Footer -->
    <?php include('php/footer.php'); ?>

    </div>
    </body>
    </html>
