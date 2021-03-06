<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- The page header -->
	<?php include('php/head.php'); ?>
</head>

<script>
  function initMap() {
    var Dundee = {lat: 56.459101, lng: -2.972326};
    var Edinburgh = {lat: 55.954064, lng: -3.203514};
    var Glasgow = {lat:55.861392, lng:-4.248592};
    var Aberdeen = {lat:57.146151, lng: -2.100288};
    var map = new google.maps.Map(document.getElementById('responsive-map'), {
      zoom: 7,
      center: Edinburgh
    });
    var marker = new google.maps.Marker({
      position: Dundee,
      map: map
    });
    var marker = new google.maps.Marker({
      position: Edinburgh,
      map: map
    });
    var marker = new google.maps.Marker({
      position: Glasgow,
      map: map
    });
    var marker = new google.maps.Marker({
      position: Aberdeen,
      map: map
    });
  }

  $(document).ready(function() {
    function getDistances(stores, lat, long){
      var geocoder = new google.maps.Geocoder;
      var service = new google.maps.DistanceMatrixService;
      var origin = new google.maps.LatLng(lat, long);

      var destinations = [];
      for(var i=0;i<stores.length;i++){
        destinations.push(new google.maps.LatLng(stores[i].lat, stores[i].long));
      }

      service.getDistanceMatrix({
        origins: [origin],
        destinations: destinations,
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
      }, function(response, status) {
        if (status !== 'OK') {
          alert('Error was: ' + status);
        } else {
          for(var i=0;i<response.rows[0].elements.length;i++){
            stores[i].distanceVal = response.rows[0].elements[i].distance.value;
            stores[i].distanceText = response.rows[0].elements[i].distance.text;
            stores[i].durationText = response.rows[0].elements[i].duration.text;
          }
          sortStores(stores);
          updateStores(stores);
        }
      });
    }

    function Store(lat, long, name, address){
      this.long = long;
      this.lat = lat;
      this.name = name;
      this.address = address;
      this.distanceVal = 0;
      this.distanceText = 0;
      this.durationText = 0;
    }

    function updateStores(stores)
    {
      $('#locations').empty();

      for(var i = 0;i<stores.length;i++){
        var newLocation = "<div class=\"container col-md-12 well\" id=\"location"+i+"\" style = \"background-color:#ffecd8; padding-top:10px; font-size:120%\"><p>City: "+stores[i].name+"</p><p>Address: "+stores[i].address+"</p><p>Distance: "+stores[i].distanceText +"</p><p>Travel Time: "+stores[i].durationText+"</p></div>"
        $('#locations').append(newLocation);
      }
    }

    function sortStores(stores){
      for (var i = 1; i < stores.length; i++) {
        var tmp = stores[i];
        for (var j = i - 1; j >= 0 && (stores[j].distanceVal > tmp.distanceVal); j--) {
          stores[j + 1] = stores[j];
        }
        stores[j + 1] = tmp;
      }
    }

    var stores = [];
    stores.push(new Store(56.459101, -2.972326, "Dundee", "Nethergate"));
    stores.push(new Store(55.954064, -3.203514, "Edinburgh", "Princes Street"));
    stores.push(new Store(55.861392, -4.248592, "Glasgow", "George Square"));
    stores.push(new Store(57.146151, -2.100288, "Aberdeen", "Union Street"));

    updateStores(stores);

    var postcodeLong;
    var postcodeLat;
    $( "#search" ).click(function() {
      $.get( "https://api.postcodes.io/postcodes/"+$('#postcode').val().replace(/\s/g, ''))
      .done(function(data) {
        postcodeLat = data.result.latitude;
        postcodeLong = data.result.longitude;

        getDistances(stores, postcodeLat, postcodeLong);
        var sorted = sortStores(stores);
      })
      .fail(function() {
        alert( "The postcode you have entered was not recognised." );
      })
    });
  });
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMiZs865Ub7z9aN2gKZrfcSF8ruSoMz2E&callback=initMap">
</script>

<body>
  <div class="container">

    <!-- The navbar -->
    <?php include('php/header.php'); ?>

    <row>
	
      <!-- Locations -->
      <div class="container col-md-4" style="background-color:#f7c986; height:600px; border-radius:5px">
        <row>
		  <img src="Pics/storelocations.png" style="max-height:60px; max-width:100%; padding-top:10px; padding-left:10px"></img>
        </row>
        <row>
          <div class="container col-md-12" style="padding-top:10px">
            <div class="col-md-10" style="margin-left:-15px; margin-right:-12px">
              <input type="text" placeholder="Enter postcode" class="form-control" id="postcode">
            </div>
            <button type="button" class="btn btn-primary btn-md" id="search" style="width:70px">Search</button>
          </div>
        </row>
        <row>
          <div class="container col-md-12 pre-scrollable" id="locations" style="margin-top:10px; padding-top:10px; height:100%; max-height: 475px">
            <div class="container col-md-12 well" id="location1" style = "background-color:black; padding-top:10px; font-size:120%">
            </div>
          </div>
        </row>
      </div>

      <!-- div that the google maps uses -->
      <div class="container col-md-8" id="responsive-map" style="height: 600px; border-radius:5px"></div>

    </row>

    <!-- The footer -->
    <?php include('php/footer.php'); ?>


</div>
</body>
</html>
