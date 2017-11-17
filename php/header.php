<?php

  $logoutlink = "";
  $loggedin = False;
  $loggedin1 = False;
  $loggedin2 = False;

  if(isset($_SESSION["username"])){
	unset($_SESSION["staffusername"]);
	unset($_SESSION["manusername"]);
    $loggedin = True;
  } else if(isset($_SESSION["staffusername"])){
    unset($_SESSION["manusername"]);
	unset($_SESSION["username"]);
    $loggedin1 = True;
  } else if(isset($_SESSION["manusername"])){
	unset($_SESSION["staffusername"]);
	unset($_SESSION["username"]);
    $loggedin2 = True;
  }

	
  $redirect = "Login";
  $redirect1 = "login";
  $redirect2 = "createaccount";
  if($loggedin){
    $redirect = "Basket";
	$redirect1= "basket";
    $redirect2 = "myaccount";
    $logoutlink = "<li><a href=\"php/logout.php\" style=\"padding-top:40px; padding-bottom:40px; margin-right:10px\">Log Out</a></li>";
  } else if($loggedin1){
	$redirect = "Staff";
	$redirect1 = "staffindex";
	$redirect2 = "staffindex";
	$logoutlink = "<li><a href=\"php/logout.php\" style=\"padding-top:40px; padding-bottom:40px; margin-right:10px\">Log Out</a></li>";
  } else if($loggedin2){
	$redirect = "Manufacturer";
	$redirect1 = "manufacturerindex";
	$redirect2 = "manufacturerindex";
	$logoutlink = "<li><a href=\"php/logout.php\" style=\"padding-top:40px; padding-bottom:40px; margin-right:10px\">Log Out</a></li>";
  }
  
	

  $part1 = "<nav class=\"navbar navbar-default\">
    <div class=\"container-fluid\">
      <div class=\"navbar-header\">
         <a class=\"navbar-brand\" rel=\"home\" href=\"index.php\" title=\"SockDirect\" style=\"height:100px\">
    <img style=\"max-height:100px; margin:-15px; padding: 3px 3px\" src=\"Pics/logo2.png\">
    </a>
      </div>
    <ul class=\"nav navbar-nav\" style=\"height:100px; max-width:450px\">
      <li><a href=\"index.php\" style=\"padding-top:40px; padding-bottom:40px\">Home</a></li>
      <li><a href=\"about.php\" style=\"padding-top:40px; padding-bottom:40px\">About</a></li>
      <li><a href=\"contact.php\" style=\"padding-top:40px; padding-bottom:40px\">Contact</a></li>
      <li><a href=\"stores.php\" style=\"padding-top:40px; padding-bottom:40px\">Stores</a></li>
      <li><a href=\"".$redirect2.".php\" style=\"padding-top:40px; padding-bottom:40px\">My Account</a></li>
    </ul>
    <ul class=\"nav navbar-nav navbar-right\" style=\"height:100px\">
      <li><a href=\"".$redirect1.".php\" style=\"padding-top:40px; padding-bottom:40px; margin-right:10px\">".$redirect."</a></li>";



   $part2 = "</ul>
    <form class=\"navbar-form navbar-right\" style=\"padding-top:25px; padding-bottom:25px\" action=\"search.php\" method=\"get\">
    <div class=\"form-group\">
      <input type=\"text\" name=\"searchterm\" class=\"form-control\" placeholder=\"Search\" style=\"max-width:150px\">
    </div>
    <button type=\"submit\" class=\"btn btn-default\">Submit</button>
      </form>
    </div>
  </nav>";


  echo $part1.$logoutlink.$part2;

?>
