<?php session_start();


$admin = 0;
if($_POST['admin']=='Yes'){
  $admin = 1;
}

$query = "update staffmember set
            StaffPositionsID = (select id from staffposition where Name = '".$_POST['position']."'),
            LocationID = (select id from location where LocationName = '".$_POST['location']."'),
            FirstName = '".$_POST['fname']."',
            Surname = '".$_POST['lname']."',
            Address = '".$_POST['address']."',
            Postcode = '".$_POST['postcode']."',
            BankAccountNo = '".$_POST['bankacc']."',
            SortCode = '".$_POST['banksort']."',
            NationalInsuranceNo = '".$_POST['nationalinsurance']."',
            Password = '".$_POST['password']."',
            WeeklyHours = ".$_POST['weeklyhrs'].",
            PhoneNo = '".$_POST['phone']."',
            Admin = ".$admin."
          where Email='".$_POST['email']."'";

include('db.php');
$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  header('Location: ../editaccounts1.php');
} catch(PDOException $e){
  echo $e->getMessage();
}

?>
