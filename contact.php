<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sock Shop</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=800, initial-scale=1">
</head>

<script>
  $(document).ready(function(){
    $('#sendmessage').click(function(){
      var subject = $('#subject').val()
      var from = $('#name').val()
      var body = $('#message').val() + "\n"+from
      var email = $('#email').val()
      var mailto = "mailto:support@sockshop.com?subject="+encodeURIComponent(subject)+"&cc="+encodeURIComponent(email)+"&body="+encodeURIComponent(body)
      window.open(mailto, "_blank");
    })
  })
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Contact form -->
    <div class="container col-md-6" style="padding-bottom:30px">
      <h2>Contact form</h2>
      <form>
        <div class="form-group">
          <label for="name">Full Name:</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your fullname" name="name">
        </div>
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" id="email">
        </div>
        <div class="form-group">
          <label for="subject">Subject:</label>
          <input type="text" class="form-control" id="subject" placeholder="The subject of your message" name="subject" id="subject">
        </div>
        <div class="form-group">
          <label for="message">Message Body:</label>
          <textarea type="text" class="form-control" id="message" placeholder="Enter your message here" name="message" style="height:200px; resize:none;"></textarea>
        </div>
        <button type="button" id="sendmessage" class="btn btn-default">Send Message</input>
      </form>
    </div>

    <!-- extra contact info -->
    <div class="container col-md-6" style="padding-left:150px; padding-top:100px;">
      <h2>Other Contact Info</h2>
      <p>Phone Number: 07412523396</p>
      <p>Email Address: support@sockshop.com</p>
      <p>Address: Dundee, 10 Nethergate</p>
    </div>

    <!-- The footer -->
    <?php include('php/footer.php'); ?>


  </div>
</body>
</html>

</html>
