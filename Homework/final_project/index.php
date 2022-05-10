<!DOCTYPE html>

<?php 
	include_once('login.php');
	session_start();
	if (!isset($_SESSION['user_id'])) {
		include('header.php');
	}
	else {
		include('header-signedin.php');
	}
?>

<html>
<head>
	<title>Form Test</title>
</head>
<body>
	<div class="container" style="margin-top:100px">
		<div class="row no-gutters slider-text justify-content-center">
            <div class="col-md-12 ftco-animate pb-1 mb-1 text-center fadeInUp ftco-animated"><br><br>
                <h1 class="mb-3 bread">Oh Rats!</h1>
                <span>
            		<img src="./coffee-rat-wp-thumb.jpeg" height = "50%" width = "50%" justify-content-center><br>
            		<p class = "mt-6"><br>This website is a final project for INFO-638 at the Pratt Institute. Login or sign up to
            		view a map of rodent inspections in your area.</p>
            	</span>
            </div>
        </div>
    </div>
    <?php exit();?>
</body>
</html>