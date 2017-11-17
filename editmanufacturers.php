<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./php/head.php'); ?>
</head>

<script>

$(document).ready(function() {
  var manufacturerArray = []

  $('#editmanufacturers').css('background-color','#f7c986')

  class ManItem{
    constructor(manID, manName, manRep){
      this.manID = manID
      this.manName = manName
      this.manRep = manRep
      this.flatstring = manID + manName + manRep
      manufacturerArray.push(this)
      var newItem = [
        "<tr>",
          "<td>"+manID+"</td>",
          "<td>"+manName+"</td>",
          "<td>"+manRep+"</td>",
        "</tr>"
      ]
      $('#tablebody').append(newItem.join(""));
      this.addToTable = function(){
        var newItem = [
          "<tr>",
            "<td>"+this.manID+"</td>",
            "<td>"+this.manName+"</td>",
            "<td>"+this.manRep+"</td>",
          "</tr>"
        ]
        $('#tablebody').append(newItem.join(""));
      }
    }
  }

   function addItem(manID, manName, manRep){
    new ManItem(manID, manName, manRep)
  }
  
  	function varcheck(input){
		return isNaN(input);  
	}
	
  $('#update').click(function() {  
  	var inputvalue = $("#manufacturerID").val();
	 
	if(varcheck(inputvalue) == false)
	{
		window.location.assign("addmanufacturer.php?id="+inputvalue);
	}
	else{
	alert("Ensure that you use a numeric value for the manufacturer ID");
	}
    });

  <?php

		include './php/db.php';

		$query = "SELECT id, Company, RepName FROM manufacturer";

		$stmt = $mysql->prepare($query);

		try{
			$stmt->execute();
			$result = $stmt->fetchAll();

			foreach($result as $row) {
				echo ("addItem(".$row['id'].",\"".$row['Company']."\",\"".$row['RepName']."\")\n");
			}
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	?>
})

  </script>

<body>
  <div class="container">

        <!-- The navbar -->
    <?php include('./php/header.php'); ?>

    <!-- Options tab -->
    <?php include('./php/sidepanel.php'); ?>

    <!-- Check Stock -->
    <div class="container col-md-9" style="background-color:#f7c986; border-radius:5px; padding:10px">
      <div class="container col-md-12 pre-scrollable" style="background-color:#ffecd8; padding:10px; max-height:600px; height:600px; border-radius:5px; border:1px solid lightgray">
        <table class="table table-bordered col-md-12">
          <thead>
            <tr>
              <th>Manufacturer ID</th>
              <th>Manufacturer</th>
              <th>Rep Name</th>
            </tr>
          </thead>
          <tbody id="tablebody">
          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer -->
    <?php include('./php/footer.php'); ?>

    </div>
</body>
</html>
