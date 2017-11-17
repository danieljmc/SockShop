<?php session_start();

include('db.php');

$admin = 0;
if($_POST['admin']=='Yes'){
  $admin = 1;
}

$newID = 0;
$query = "select max(id) from staffmember";
$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  $result = $stmt->fetch();
  $newID = $result['max(id)']+1;
} catch(PDOException $e){
  echo $e->getMessage();
}

$query = "insert into staffmember set
          id = ".$newID.",
          StaffPositionsID = (select id from staffposition where Name = '".$_POST['position']."'),
          LocationID = (select id from location where LocationName = '".$_POST['location']."'),
          FirstName = '".$_POST['fname']."',
          Surname = '".$_POST['lname']."',
          Address = '".$_POST['address']."',
          Postcode = '".$_POST['postcode']."',
          BankAccountNo = '".$_POST['bankacc']."',
          SortCode = '".$_POST['banksort']."',
          Email = '".$_POST['email']."',
          NationalInsuranceNo = '".$_POST['nationalinsurance']."',
          Password = '".$_POST['password']."',
          WeeklyHours = ".$_POST['weeklyhrs'].",
          PhoneNo = '".$_POST['phone']."',
          Admin = ".$admin;

$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  header('Location: ../editaccounts1.php');
} catch(PDOException $e){
  echo $e->getMessage();
}
?>
