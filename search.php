<?php session_start() ?>

<!--

Now all you need to do to add to the search is create a new instance of SearchItem and the rest will be done for you
If you go down you just put it where i currently make six random instance
Look at the constructor to see the params needed
Search isnt yet implemeted yet but this can be done after the backend implementation

-->

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
$(document).ready(function() {
  var items = []
  class SearchItem{
    constructor(productID,productname,sizes,price){
      items.push(this)
      this.productID = productID
      this.productname = productname
      this.sizes = sizes
      this.price = price
      this.html = [
        "<a href='product.php?id="+productID+"'>",
        "<div class=\"container col-md-3\" style=\"text-align:center\">",
          "<img src=\"Pics/ProductPics/"+this.productID+"/1.jpg\" style=\"height:133px;\" onerror=\"this.src='Pics/logo.png'\" class=\"thumbnail\">",
          "<p>"+this.productname+"</p>",
          "<p>Price: £"+this.price+"</p>",
          "<p>Sizes: "+this.sizes+"</p>",
        "</div>",
        "</a>"
      ].join("")
    }
  }

  function highToLow(){
    for (var i = items.length-1; i>=0; i--){
      for(var j = 1; j<=i; j++){
        if(items[j-1].price<items[j].price){
          var temp = items[j-1];
          items[j-1] = items[j];
          items[j] = temp;
        }
      }
    }
  }

  function lowToHigh(){
    for (var i = items.length-1; i>=0; i--){
      for(var j = 1; j<=i; j++){
        if(items[j-1].price>items[j].price){
          var temp = items[j-1];
          items[j-1] = items[j];
          items[j] = temp;
        }
      }
    }  }

  function sortItems(){
    var sortby = $('#sortby :selected').val()
    if(sortby=="hightolow"){
      highToLow()
    }
    else if(sortby=="lowtohigh"){
      lowToHigh()
    }
  }

  $('#sortby').change(function(){
    return updateSearch()
  })

  function updateSearch(){
    sortItems()

    if(items.length==0){
      $('#searchresults').append("<h1 style='text-align:center'>No Results</h1>")
      return;
    }

    var groups = []
    var currentGroup = []
    for(var i=0;i<items.length;i++){
      if(currentGroup.length==4){
        groups.push(currentGroup)
        currentGroup = [items[i]]
      }
      else{
        currentGroup.push(items[i])
      }
    }
    if(currentGroup.length!=0){
      groups.push(currentGroup)
    }

    groupsHTML = []
    for(var i=0;i<groups.length;i++){
      var currentHTML = ""
      for(var j=0;j<groups[i].length;j++){
        currentHTML += groups[i][j].html
      }
      groupsHTML.push(currentHTML)
    }

    finalHTML = ""
    for(var i=0;i<groupsHTML.length;i++){
      finalHTML += "<div class=\"container col-md-12\">"
      finalHTML += groupsHTML[i]
      finalHTML += "</div><div class=\"container col-md-12\"><hr/></div>"
    }

    $('#searchresults').empty()
    $('#searchresults').append(finalHTML)
  }

  <?php
    include 'php/db.php';
    if(isset($_POST['searchterm'])){
      $query = "select id,ProductName,Description,price from producttype where ProductName like '%".$_POST['searchterm']."%'";
      $stmt = $mysql->prepare($query);
      try{
        $stmt->execute();
        $result = $stmt->fetchAll();
        //var_dump($result);

        //var_dump($result);
        foreach( $result as $row ) {
          $colors = array();
          $query2 = "SELECT DISTINCT Size FROM product where ProductType_id=".$row['id'].";";
          $stmt2 = $mysql->prepare($query2);
          try{
            $stmt2->execute();
            $result2 = $stmt2->fetchAll();
            foreach( $result2 as $row2 ){
              $colors[] = $row2['Size'];
            }
          } catch ( PDOException $e ){
            echo $e->getMessage();
          }
          echo ("new SearchItem(".$row['id'].",\"".$row['ProductName']."\",\"".implode(",",$colors)."\",\"".$row['price']."\");\n");
        }
      } catch( PDOException $e ){
        echo $e->getMessage();
      }
    }
  ?>

  //new SearchItem(0,"Smelly Socks1","S,M,L","1")
  //new SearchItem(1,"Smelly Socks2","S,M,L","2")
  //new SearchItem(2,"Smelly Socks3","S,M,L","3")
  //new SearchItem(3,"Smelly Socks4","S,M,L","4")
  //new SearchItem(4,"Smelly Socks5","S,M,L","5")
  //new SearchItem(5,"Smelly Socks6","S,M,L","6")

  updateSearch()

});
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <!-- Side panel -->
    <div class="container col-md-4" style="padding:20px;">
      <div class="container col-md-12">
        <label for="searchterm">Search Term:</label>
      </div>
      <form action="search.php" method="post">
        <div class="container col-md-10">
          <input type="text" class="form-control" id="searchterm" placeholder="Enter your search term" name="searchterm">
        </div>
        <div class="container col-md-2" style="padding-bottom:10px">
          <button type="submit" class="btn btn-default">Search</button>
        </div>
      </form>
      <div class="container col-md-12">
        <label for="sortby">Sort By:</label>
      </div>
      <div class="container col-md-12">
        <select class="form-control" id="sortby" style="width:50%" id="sortby">
          <option value="hightolow">Price: high to low</option>
          <option value="lowtohigh">Price: low to high</option>
        </select>
      </div>
    </div>

    <!-- Main search box -->
    <div class="container col-md-8" style="padding:20px; font-size:100%" id="searchresults">

    </div>

    <!-- The footer -->
    <?php include('php/footer.php'); ?>


  </div>
</body>
</html>

</html>
