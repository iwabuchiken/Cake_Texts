<!DOCTYPE html>
<html>
  <head>
	<style type="text/css">
		  html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
		</style>

	<script type="text/javascript"
		  src="/cake_apps/Cake_NR5/js/main.js"
		  >
	</script>
		
	
	<script type="text/javascript"
		  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ4kJ7aLUGSzMzti5hGeY-W2kOI_WtIgQ"
		  >
		</script>
		
		<script type="text/javascript">
		  function initialize() {
		    var mapOptions = {
		      center: { lat: -34.397, lng: 140.644},
		      zoom: 5
		    };
		    var map = new google.maps.Map(document.getElementById('map-canvas'),
		        mapOptions);
		  }
		  google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</head>
	<body>
		map
		
		<br>
		<br>
		
		<div id="map-canvas"></div>
	</body>
</html>
