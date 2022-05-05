<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
	<?php
	include_once 'header.php';
	include_once 'login.php';

	session_start();
	?>
	<div class="container">		
        <div class="row no-gutters slider-text justify-content-center">        	
	        <div class="col-md-12 ftco-animate pb-5 mb-3 text-center fadeInUp ftco-animated">
				<h2 class= "mt-6">Create User</h2>
				<span class="mr-3">
					<form action="sign_up.php" method="POST">
						First Name:<br><input type="text" name="fname" size="30"><br>
						Last Name:<br><input type="text" name="lname" size="30"><br>
						Email:<br><input type="text" name="email" size="30"><br>
						Street Number:<br><input type="text" name="streetnum" size="30"><br>
						Street Name:<br><input type="text" name="streetname" size="30"><br>
						Address Line 2:<br><input type="text" name="addressline2" size="30" placeholder="(Optional)"><br>
						Borough:<br><input type="text" name="boro" size="30"><br>
						Zip Code:<br><input type="text" name="zip" size="30"><br>
						Username:<br><input type="text" name="username" size="30"><br>
						Password:<br><input type="password" name="password" size="30"><br>
						<input type="submit" name="submit" value="Create Account">
					</form>
				</span>
		</div>
	</div>

<?php

	if (isset($_POST['submit'])) { //check if the form has been submitted
	if (empty($_POST['username']) || empty($_POST['password']) ||
		empty($_POST['email']) || empty($_POST['streetname']) ||
		empty($_POST['streetnum']) || empty($_POST['zip']) || 
		empty($_POST['username']) || empty($_POST['password'])) {
			echo "<p class=\"mr-3\" align=\"center\">Whoops! Please fill out all of the requiredfields!</p>";
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);	
		$email = ($_POST['email']);
		$streetname = ($_POST['streetname']);
		$streetnum = ($_POST['streetnum']);
		$zip = ($_POST['zip']);
		$fname = ($_POST['fname']);
		$lname = ($_POST['lname']);
		$boro = ($_POST['boro']);
		if (isset($_POST['addressline2'])) {
			$addressline2 = ($_POST['addressline2']);	
		}
		else {
			$addressline2 = NULL;
		}
		$salt1 = "qm&h*";  
		$salt2 = "pg!@";  
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$email', '$username', '$password', '$streetname', '$streetnum', NULL, '$addressline2', '$boro', '$zip', NULL, NULL, NULL)"; 		    
		$result = $conn->query($query);    
		if (!$result) die($conn->error);
		else {
			$_SESSION['fname'] = $_POST['fname'];
			$_SESSION['lname'] = $_POST['lname'];	
			header("Location: index.php"); 			
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