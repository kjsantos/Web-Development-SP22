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
	$fname = ($_SESSION['fname']);
	$user_id = ($_SESSION['user_id']);
	$locations=array();
	$boro = $_SESSION['boro'];
	$lat = $_SESSION['lat'];
	$lon = $_SESSION['lon'];
	$conn = new mysqli($hn, $un, $pw, $db);
	$query  = "SELECT * FROM report_tickets WHERE ABS(lat-'$lat')<=.002 AND ABS(lon-('$lon'))<=.002"; 
	$result = $conn->query($query);
	if (!$result) die ("Error");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "<h1><Oops! Please Log in</h1><br>";
	} 
	else {
		echo '<table class="table">
							<thead>
								<tr>
									<th scope="col">Date</th>
									<th scope="col">Result</th>
								</tr>
							</thead>
							<tbody>';
		while ($row = $result->fetch_array()) {
								$date = $row['date'];
								$result = $row['result'];
			
								echo "<tr>
									<th scope=\"row\">1</th>
									<td>$date</td>
									<td>$result</td>
								</tr>";
		}
		echo "</tbody>
						</table>";
	}
	echo "<div id=\"ftco-loader\" class=\"show fullscreen\" role=\"status\"><svg class=\"circular\" width=\"48px\" height=\"48px\"><circle class=\"path-bg\" cx=\"24\" cy=\"24\" r=\"22\" fill=\"none\" stroke-width=\"4\" stroke=\"#eeeeee\"/><circle class=\"path\" cx=\"24\" cy=\"24\" r=\"22\" fill=\"none\" stroke-width=\"4\" stroke-miterlimit=\"10\" stroke=\"#F96D00\"/></svg><h1>Fetching inspections near you...</h1></div>"
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