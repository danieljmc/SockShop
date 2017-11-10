<?php

  echo "
  <nav class=\"navbar navbar-default\">
    <div class=\"container-fluid\">
      <div class=\"navbar-header\">
         <a class=\"navbar-brand\" rel=\"home\" href=\"/\" title=\"SockDirect\" style=\"height:100px\">
    <img style=\"width:100px; margin:-15px; padding: 3px 3px\" src=\"../logo.png\">
    </a>
      </div>
    <ul class=\"nav navbar-nav\" style=\"height:100px\">
      <li class=\"active\"><a href=\"/\" style=\"padding-top:40px; padding-bottom:40px\">Home</a></li>
      <li><a href=\"about/\" style=\"padding-top:40px; padding-bottom:40px\">About</a></li>
      <li><a href=\"contact/\" style=\"padding-top:40px; padding-bottom:40px\">Contact</a></li>
      <li><a href=\"stores/\" style=\"padding-top:40px; padding-bottom:40px\">Stores</a></li>
      <li><a href=\"myaccount/\" style=\"padding-top:40px; padding-bottom:40px\">My Account</a></li>
    </ul>
    <ul class=\"nav navbar-nav navbar-right\" style=\"height:100px\">
      <li><a href=\"myaccount/\" style=\"padding-top:40px; padding-bottom:40px; margin-right:10px\">Login</a></li>
    </ul>
    <form class=\"navbar-form navbar-right\" style=\"padding-top:25px; padding-bottom:25px\" action=\"search\" method=\"get\">
    <div class=\"form-group\">
      <input type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"Search\">
    </div>
    <button type=\"submit\" class=\"btn btn-default\">Submit</button>
      </form>
    </div>
  </nav>
  ";

?>
