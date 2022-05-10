<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<?php
	include_once('login.php');
	session_start();
	if (!isset($_SESSION['user_id'])) {
		include('header.php');
	}
	else {
		include('header-signedin.php');
	}

	if (isset($_POST['submit'])) { //check if the form has been submitted
	if ( empty($_POST['username']) || empty($_POST['password']) ) {
		echo "<p class=\"mr-3\" align=\"center\">Please fill out all of the form fields!</p>";
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$salt1 = "qm&h*";  
		$salt2 = "pg!@"; 
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);
		$password = hash('ripemd128', $salt1.$password.$salt2);
		echo $password;
		$query  = "SELECT * FROM users WHERE username='$username' AND password='$password'"; 
		$result = $conn->query($query);    
		if (!$result) die($conn->error);
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['fname'] = $row['fname'];
			$_SESSION['lname'] = $row['lname'];	
			$_SESSION['boro'] = $row['boro'];
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['lat'] = $row['lat'];
			$_SESSION['lon'] = $row['lon'];
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
	<div class="container" style="margin-top:150px">	
        <div class="row no-gutters slider-text justify-content-center">        	
	        <div class="col-md-12 ftco-animate pb-5 mt-6 text-center fadeInRight ftco-animated">
				<h1 class= "mt-6"><b>Please Log In</b></h1>
				<span>
					<form action="sign_in.php" method="POST">
						Username:<br><input type="text" name="username" size="40" placeholder="Username"><br>
						Password:<br><input type="password" name="password" size="40" placeholder="Password"><br><br>
						<input type="submit" name="submit" value="Log-In">
					</form>
				</span>
				<h4 class= "mt-5">New? Create a User Here:<br></h4>
				<a href="sign_up.php" class="btn btn-primary" role="button">Sign Up</a>
			</div>
	</div>
</div>
<?php exit();?>




</body>