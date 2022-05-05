<!DOCTYPE html>
<html>
<head>
<title>Class Example</title>
</head>
<body>
	<button></button>

	<?php
	session_start();
	if (!isset($_SESSION['fname']) || !isset($_SESSION['lname']) ) {
		header("Location: sign_in.php");
	} 

	echo "<h3>Welcome, ".$_SESSION['fname']." ".$_SESSION['lname']."!";
	?>

</body>
