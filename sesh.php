<?php
   include("db.php");

   if(!isset($_SESSION))
       session_start();
       
    //sets the check variable
   $checkLoggedIn = $_SESSION["loggedIn"];
   //runs the query to check for the matching email to verify
   $sqlcmd = mysqli_query($db,"SELECT Email from customers where Email = '$checkLoggedIn' ");
   //gets the row where the logged in user exists
   $row = mysqli_fetch_array($sqlcmd,MYSQLI_ASSOC);
   //sets the session to the row of the user
   $session = $row['Email'];
   //if there's no session go to login.php
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>