<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
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

	if (isset($_POST['submit'])) { 
		if (empty($_POST['username']) || empty($_POST['password']) ||
			empty($_POST['email']) || empty($_POST['streetname']) ||
			empty($_POST['streetnum']) || empty($_POST['zip']) || 
			empty($_POST['username']) || empty($_POST['password'])) {
				echo "<p class=\"mr-3\" align=\"center\">Whoops! Please fill out all of the required fields!</p>";
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
			$address = $streetnum." ".$streetname.", ".$boro.", NY ".$zip;
			$data_arr = geocode($address);
			if($data_arr){
				$latitude = $data_arr[0];
        		$longitude = $data_arr[1];
        		$formatted_address = $data_arr[2];
        	}
        	else {
        		echo "<br><br><p class=\"mr-3\" align=\"center\">Please enter a valid address</p>";
        		header("Refresh: 2; sign_in.php");
        		exit();
        	}
			$salt1 = "qm&h*";  
			$salt2 = "pg!@";  
			$password = hash('ripemd128', $salt1.$password.$salt2);
			$query  = "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$email', '$username', '$password', '$streetname', '$streetnum', '$addressline2', '$boro', '$zip', '$latitude', '$longitude', NULL)"; 		    
			$result = $conn->query($query);    
			if (!$result) die($conn->error);
			else {
				echo "<div class=\"col-md-12 ftco-animate pb-5 mb-3 text-center fadeInUp ftco-animated\"><br><br>
                		<h4 class=\"mb-3 bread\">Account Creation Successful! Redirecting to Sign In...</h4>
            			</div>";
				header("Refresh: 2; sign_in.php");
				exit();
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

	function geocode($address) {

    $address = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCPtHjYin6Pm3Lp7M7q31gOgEhlEyrMMMc";
    $resp_json = file_get_contents($url);
    $resp = json_decode($resp_json, true);

    if($resp['status']=='OK'){
  
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
          
        if($lati && $longi && $formatted_address){
          
            // put the data in the array
            $data_arr = array();            
              
            array_push($data_arr, $lati, $longi, $formatted_address);              
            return $data_arr;
              
        }
        else {
        	return false;
        }
          
    }
  
    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
}


?>
	<br><br>
	<div class="container">		
        <div class="row no-gutters slider-text justify-content-center">        	
	        <div class="col-md-8 ftco-animate pb-5 mb-3 fadeInLeft ftco-animated">
				<h2 class= "mt-6" align="center"><br><br><b>Create an Account</b></h2>
				<span class="mr-3">
					<form action="sign_up.php" method="POST" role="form" class="form-horizontal">
						<div class="form-row">
    						<div class="form-group col-md-6">
								<label for="fname">First Name:</label>
								<input type="text" class = "form-control" id="fname" name="fname" placeholder = "First Name">
							</div>
							<div class="form-group col-md-6">
								<label for="lname">Last Name:</label>
								<input type="text" class = "form-control" name="lname" id="lname" placeholder = "First Name">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="username">Username</label>
								<input type="text" class = "form-control" name="username" id="username" placeholder = "Username">
							</div>
							<div class="form-group col-md-6">
								<label for="password">Password:</label>
								<input type="password" class = "form-control" name="password" id="password" placeholder = "Password">
							</div>
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" class="form-control" name="email" id="email"  placeholder="Email">
						</div>
						<div class="form-row">
						    <div class="form-group col-md-2">
						      <label for="streetnum">Street #</label>
						      <input type="text" class="form-control" name="streetnum" id="streetnum">
						    </div>
						    <div class="form-group col-md-6">
						      <label for="streetname">Street Name</label>
						      <input type="text" class="form-control" name="streetname" id="streetname">
						    </div>
							<div class="form-group col-md-4">
    							<label for="addressline2">Address Line 2:</label>
    							<input type="text" class="form-control" name="addressline2" id="addressline2" placeholder="(Optional)">
  							</div>
  						</div>
  						<div class="form-row">
						    <div class="form-group col-md-8">
						      <label for="boro">Borough</label>
						      <select id="boro" name="boro" class="form-control">
						        <option selected>Choose...</option>
						        <option value="Bronx">Bronx</option>
								<option value="Brooklyn">Brooklyn</option>
								<option value="Manhattan">Manhattan</option>
								<option value="Queens">Queens</option>
								<option value="Staten Island">Staten Island</option>
						      </select>
						    </div>							    
						    <div class="form-group col-md-4">
						      <label for="zip">Zip</label>
						      <input type="text" class="form-control" name="zip" id="zip">
						    </div>
						</div>
						<div class="form-group">
    						<div class=" col-sm-10">
								<input type="submit" id="submit" name="submit" class="btn btn-lg btn-primary" value ="Create Account">
							</div>
						</div>
					</form>
				</span>
			</div>
		</div>
	</div>



</body>