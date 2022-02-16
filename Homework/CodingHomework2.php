<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Code Homework 3</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quattrocento|Quattrocento+Sans">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style> 
		h1 {
		  text-align: center;
		  text-transform: uppercase;
		  text-decoration: underline;
		  color: #a47053;
		  font-family: Quattrocento, serif;
		  font-size: 60px;
		}

		p {
		  text-align: center;
		  font-family: Quattrocento Sans, sans-serif;
		  font-size: 26px;
		  color: #909cac;
		  letter-spacing: 1.5px;
		}

		a {
		  text-align: center;
		  font-family: Quattrocento Sans, sans-serif;
		  font-size: 20px;
		  text-decoration: none;
		  color: skyblue;
		}
		div.button {
			height: 10em;
			align-items: center;
		}
	</style>
</head>
<body>

	<h1>Challenge: ISBN Validation<br></h1>


	<?php 

	$isbn1 = "0525657746";
	$isbn2 = "364928343X";
	$isbn3 = "0140444785";

	$isbns = array($isbn1, $isbn2, $isbn3);

	function checker ($isbn) {

		echo "<br><div class=\"container\"><div class=\"p-3 mb-2 bg-light text-white\"><div class=\"row\"><div class=\"col text-center\"><p>Checking ISBN: $isbn for validity...</p>";

		$check = [];
		$dep = 10;
		$sum = 0;


		for ($i=0; $i < 10; $i++) { 
			array_push($check, substr($isbn, $i, 1));
		}
		foreach ($check as $x) {
			if ($x == "X") {
				$sum += 10;
			}
			else {
				$sum += (float)$x*$dep;  
			}
			$dep--;
		}
		$sum = ($sum/(float)11);


		if (($sum)-(floor($sum))==0) {
			return true;
		}
		else {
			return false;
		}


	}

	foreach ($isbns as $isbn) {
		if (checker($isbn) == true) {
			echo "<p>This is a Valid ISBN!</p>";
			echo "<a class=\"btn btn-link\" href =\"http://www.isbnsearch.org/isbn/$isbn\" role=\"button\" target = \"_blank\">Click to learn more!</a>";
		}
		else {
			echo "<p>This is NOT a Valid ISBN!</p>";
		}
		echo "</div></div></div></div><br>";
	}
		



	?>
	<h1><br>Challenge 2A: Coin Toss!</h1>

	<?php

		$odds = [1,3,5,7,9];

		function toss ($num) {
			echo "<div class=\"container\"><div class=\"row\"><div class=\"col text-center\"><p>Flipping a coin $num times...</p><br>";
			for ($i=0; $i < $num; $i++) { 
				
				$flip = mt_rand(0,1);
				if ($flip==0) {
					echo "<img src=\"985351.png\"width=\"100\"height=\"100\">";
				}
				else {

					echo "<img src=\"985360.png\"width=\"100\"height=\"100\">";
				}
			}

		echo "</div></div></div><br>";

		}

		foreach ($odds as $x) {
			toss ($x);
		}

		echo "<h1>Challenge 2B: Two in a Row</h1>";

		function two () {
			echo "<br><div class=\"container\" style=\"width: 50rem;\"><div class=\"row\"><div class=\"col text-center\"><p>Beginning the coin flipping...</p>";
			$how_many = 0;
			$tries = 0;
			while ($how_many!=2) {
				$flip = mt_rand(0,1);
				if ($flip==0) {
					echo "<img src=\"985351.png\"width=\"100\"height=\"100\">";
					$how_many++;
				}
				else {
					echo "<img src=\"985360.png\"width=\"100\"height=\"100\">";
					$how_many = 0;
				}
				$tries++;
			}
			echo "<p>Flipped two heads in a row, in $tries flips!</p>";
			echo "</div></div></div><br>";
		}

		two();

	?>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>