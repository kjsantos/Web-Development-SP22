<<!DOCTYPE html>
<html>
<?php 
require_once 'login.php';
include_once 'header.php';

session_start();
$fname = ($_SESSION['fname']);
echo "<h1 style=\"text-align:center;\"><br>Hello $fname!</h1>";
$boro = $_SESSION['boro'];
echo "<h1 style=\"text-align:center;\">Displaying Rodent Inspections for $boro ...</h1>";
$conn = new mysqli($hn, $un, $pw, $db);
$query  = "SELECT * FROM test_table WHERE boro='$boro'"; 
$result = $conn->query($query);
if (!$result) die ("Error");
$rows = $result->num_rows;
if ($rows == 0) {
	echo "<h1 text-align='center'>No inspections found for $boro</h1><br>";
} 
else {
	while ($row = $result->fetch_assoc()) {
		#echo "<br>";
		#echo "<p style=\"text-align:center;\>Ticket #".$row["ticket"]." inspected on ".$row["date"].". The result was ".$row["result"].".</p>";
	}
}

?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	<script type="module" src="./index.js"></script>
	<title>Map</title>
</head>
<body>
	<script>
		let map;
		function initMap() {
			const bk = { lat: 40.6782, lng: -73.9606 };
			const map = new google.maps.Map(document.getElementById("map"), {
				zoom: 12,
				center: bk,
			});
			const marker = new google.maps.Marker({
				position: bk,
				map: map,
			});
		}
		window.initMap = initMap;
	</script>
	<br><br><br><br><br><br>
	<div id="map"></div>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPtHjYin6Pm3Lp7M7q31gOgEhlEyrMMMc&callback=initMap"defer></script>
</body>

</html>