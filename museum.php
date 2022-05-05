<!DOCTYPE html>
<html>
<head>
<title>Class Example</title>
</head>
<body>

<?php

$hn = 'localhost';
$db = 'museum_db';
$un = 'ksantos_638';
$pw = 'Cm9c2fxorsK_';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo "<h1> Looking up paintings...</h1>";

$parameter= 'description';


if (isset($_GET[$parameter])) {
	$check = sanitizeMySQL($conn, $_GET[$parameter]);
	$query = "SELECT * FROM `records` WHERE ".$parameter." = '".$check."'";
	$result = $conn->query($query);
	if (!$result) die ("Invalid description");
	$rows = $result->num_rows;

	if ($rows == 0) {
		echo "No $check works found<br>";
		} 
	else {
		while ($row = $result->fetch_assoc()) {
		echo '<h2>Painting Info</h2>';
		echo $row["name"]." is a ".$row["description"]." work from ".$row["year"].". You can find this piece in ".$row["exhibit"];
		}
	}

}

function sanitizeString($var) {
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}

function sanitizeMySQL($connection, $var) {
	$var = sanitizeString($var);
	$var = $connection->real_escape_string($var);
	return $var;
}






?>

</body>
</html>