<?php session_start();

include('db.php');

$query = "update staffmember set
          FirstName = '".$_POST['fname']."',
          Surname = '".$_POST['lname']."',
          Address = '".$_POST['address']."',
          Postcode = '".$_POST['postcode']."',
          BankAccountNo = '".$_POST['bankacc']."',
          SortCode = '".$_POST['banksort']."',
          Email = '".$_POST['email']."',
          NationalInsuranceNo = '".$_POST['nationalinsurance']."',
          Password = '".$_POST['password']."',
          PhoneNo = '".$_POST['phone']."'
          where Email = '".$_SESSION['staffusername']."'";
$stmt = $mysql->prepare($query);
try{
  $stmt->execute();
  $_SESSION['staffusername'] = $_POST['email'];
  header('Location: ../editaccount.php');
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
