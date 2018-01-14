var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Άγνωστη τοποθεσία');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
	document.getElementById("lat").value = latLng.lat();
	document.getElementById("lon").value = latLng.lng();
}

function updateMarkerAddress(str) {
  document.getElementById('address').value = str;
}

function initialize() {
  var latLng = new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lon;?>);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 6,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });
  
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Τοποθετήστε το δείκτη...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Τοποθετήστε το δείκτη...');
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Τοποθετήθηκε ο δείκτης');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);