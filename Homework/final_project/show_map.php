<!DOCTYPE html>
<html>
<?php 
	include_once('login.php');
	session_start();
	if (!isset($_SESSION['user_id'])) {
		include('header.php');
	}
	else {
		include('header-signedin.php');
	}
	$fname = ($_SESSION['fname']);
	$user_id = ($_SESSION['user_id']);
	$locations=array();
	$boro = $_SESSION['boro'];
	$conn = new mysqli($hn, $un, $pw, $db);
	$query  = "SELECT * FROM users WHERE user_id='$user_id'"; 
	$result = $conn->query($query);
	if (!$result) die ("Error");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "<h1><Oops! Please Log in</h1><br>";
	} 
	else {
		while ($row = $result->fetch_assoc()) {
			$lat = $row['lat'];
			$lon = $row['lon'];
		}
	}
	echo "<div id=\"ftco-loader\" class=\"show fullscreen\" role=\"status\"><svg class=\"circular\" width=\"48px\" height=\"48px\"><circle class=\"path-bg\" cx=\"24\" cy=\"24\" r=\"22\" fill=\"none\" stroke-width=\"4\" stroke=\"#eeeeee\"/><circle class=\"path\" cx=\"24\" cy=\"24\" r=\"22\" fill=\"none\" stroke-width=\"4\" stroke-miterlimit=\"10\" stroke=\"#F96D00\"/></svg><h1>Fetching inspections near you...</h1></div>"
?>





<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=5">

	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	<title>Map</title>
	<script>
		let map;

		function initMap() {
			const home =  new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lon; ?>);
			var myOptions = {
				zoom: 17,
				center: home,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var infoWindow = new google.maps.InfoWindow;
			var map = new google.maps.Map(document.getElementById("map"), myOptions);
			var bounds = new google.maps.LatLngBounds();
			<?php
			$conn2 = new mysqli($hn, $un, $pw, $db);
			$query =  "SELECT * FROM report_tickets WHERE (`date` > '2021-01-01') AND ABS(lat-'$lat')<=.002 AND ABS(lon-('$lon'))<=.002";
			$result = $conn2->query($query);
			if (!$result) die ("Error");
			$rows = $result->num_rows;
			$count = 0;
			if ($rows == 0) {
				echo "<h1 text-align='center'>No inspections found in your area</h1><br>";
			} 
			else {
				while ($row = $result->fetch_array()) {

					$outcome = $row['result'];
					$y = $row['lon'];                              
					$x = $row['lat'];
					$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$x},{$y}&key=AIzaSyCPtHjYin6Pm3Lp7M7q31gOgEhlEyrMMMc";
					$resp_json = file_get_contents($url);
					$resp = json_decode($resp_json, true);

					if($resp['status']=='OK'){
						$formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
					}

					echo ("addMarker($x, $y, '<b>$outcome</b>', '<b>$formatted_address</b>');\n"); 
					$count += 1;
				}
			}?>
			function addMarker(lat, lng, info, address) {
				var point = new google.maps.LatLng(lat, lng);
				var marker = new google.maps.Marker({
					map: map,
					position: point
				});
				const contentString =(
					'<div id="content">' +
					'<div id="siteNotice">' +
					"</div>" +
					'<h4 style=\"color: black; font-size: 20px\">'+(address)+'</h4>' +
					'<div id="bodyContent">' +
					"<p style=\"color: black; font-size: 16px\"><b>Current Inspection Status: </b>" + (info) + "</p>" +
					"</div>" +
					"</div>");
				bindInfoWindow(marker, map, infoWindow, contentString);
				}
		
			// Displays information on markers that are clicked
			function bindInfoWindow(marker, map, infoWindow, info) {
				google.maps.event.addListener(marker, 'click', function() {
				infoWindow.setContent(info);
				infoWindow.open(map, marker);
				});

			}
			window.initMap = initMap;
			window.onload= function(){
    			$("#ftco-loader").hide();
			}
		}

	</script>
</head>
<body>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCPtHjYin6Pm3Lp7M7q31gOgEhlEyrMMMc&callback=initMap"defer></script>
	<div class="container-fluid" style="margin-top:150px"> 
		<div class="row align-items-center" style="justify-content: space-around ">
			<div class="col col-lg-4 animate pb-5 mb-3 mx-1 text-left slideInUp animated">
				<h1 style="margin-left:40px; font-size: 64px"><b>Hello <?php echo $fname?>!</b></h1>
				<h3 style="margin-left:40px">We found <?php echo $count;?> recent inspection tickets in your area (yikes!)<br></h3>
				<p style="margin-left:40px">To see the result of an inspection, click a marker on the map.</p>
				</div>
			<div class="col col-lg-7 animate pb-5 mb-3 mr-1 text-left slideInUp animated">
				<div class="panel panel-default">
					<div class="panel-body">
						<div id="map" style="height: 800px"></div>
					</div>
				</div>
			</div>
		</div>
	</div> 

	<!-- 
	 The `defer` attribute causes the callback to execute after the full HTML
	 document has been parsed. For non-blocking uses, avoiding race conditions,
	 and consistent behavior across browsers, consider loading using Promises
	 with https://www.npmjs.com/package/@googlemaps/js-api-loader.--->
	<?php exit();?>
</body>

</html>