<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
	<?php
	include_once 'header.php';
	include_once 'login.php';
	?>
	<div class="container"><br><br>	
        <div class="row no-gutters slider-text justify-content-center">        	
	        <div class="col-md-12 ftco-animate pb-5 mb-3 text-center fadeInUp ftco-animated">
				<h1 class= "mt-6">Please Log In</h1>
				<span class="mr-3">
					<form action="sign_in.php" method="POST">
						Username:<br><input type="text" name="username" size="40"><br>
						Password:<br><input type="password" name="password" size="40"><br><br>
						<input type="submit" name="submit" value="Log-In">
					</form>
				</span>
				<h3 class= "mt-1">New? Create a User Here:</h3><br>
				<a href="sign_up.php" class="btn btn-primary" role="button">Sign Up</a>
		</div>
	</div>
<?php

	session_start();

	if (isset($_POST['submit'])) { //check if the form has been submitted
	if ( empty($_POST['username']) || empty($_POST['password']) ) {
		echo "<p class=\"mr-3\" align=\"center\">Please fill out all of the form fields!</p>";
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);
		$query  = "SELECT fname, lname, boro FROM users WHERE username='$username' AND password='$password'"; 
		$result = $conn->query($query);    
		if (!$result) die($conn->error);
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['fname'] = $row['fname'];
			$_SESSION['lname'] = $row['lname'];	
			$_SESSION['boro'] = $row['boro'];
			header("Location: show_map.php"); 			
		} else {
			echo "<p>Invalid username/password combination!</p>";
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