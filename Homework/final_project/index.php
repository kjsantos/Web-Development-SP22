<!DOCTYPE html>

<?php 
include_once 'header.php';

if (isset($_SESSION['username'])) { 
	$boro = $_SESSION['boro'];
	echo "<h1 >You live in $boro</h1>";
} else { 
	$name = "(Not entered)";
}
?>

<html>
<head>
	<title>Form Test</title>
</head>
<body>
	<div class="container">
		<div class="row no-gutters slider-text justify-content-center">
            <div class="col-md-12 ftco-animate pb-5 mb-3 text-center fadeInUp ftco-animated"><br><br>
                <h1 class="mb-3 bread">Oh Rats!</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span></p>
            </div>
        </div>
        <div class="row no-gutters slider-text justify-content-center">
	        <div class="col-md-12 ftco-animate pb-5 mb-3 text-center fadeInUp ftco-animated">
            	<span class="mr-5">
            		<img src="./coffee-rat-wp-thumb.jpeg" height = "60%" width = "50%" justify-content-center><br>
            		<p class = "mt-6"><br>This website is a final project for INFO-638 at the Pratt Institute. Login or sign up to
            		view a map of rodent inspections in your area.</p>
            	</span>

            </div>

        </div>
    </div>
</body>
</html>