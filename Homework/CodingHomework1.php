<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Coding Homework #1</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
	<style> 
		div {
			box-shadow: lightslategray;
			shape-outside: border-box;
		}
		h1 {
		  text-align: center;
		  text-transform: uppercase;
		  color: #4CAF50;
		  font-family: Ubuntu, sans-serif;
		  font-size: 60px;
		}

		p {
		  text-align: center;
		  font-family: Lora, serif;
		  font-size: 26px;
		  letter-spacing: 2px;
		}

		a {
		  text-decoration: none;
		  color: darkred;
		}
	</style>
</head>
<body>
	<h1>Challenge 1: Correct Change</h1><br>

	<?php
		$payment = 6067; //sets the total change due back in cents
		$curr = array(100, 25, 10, 5, 1); //creates a list of different tender values to loop through

		echo "<p>You are due $payment cents back in change total.</p>"; //call $payment to display original amount due

		#Now I can iterate through the list of tenders, since we want to return the highest amount of higer value change first. The following for loop first checks to see if any dollars fit in the remaining total due and calculates the number of bills to give back. It then subtracts that amount and moves through the list of tenders until only pennies fit.

		foreach($curr as &$x) {
			$how_many = floor($payment/$x);

			//If $x is equal to a dollar, echo the number of dollars, else check for other values

			if ($x == 100) {
				echo "<p>You due back $how_many dollar(s), "; 
			}
			elseif ($x == 25) {
				echo "$how_many quarter(s), ";
			}
			elseif ($x == 10) {
				echo "$how_many dime(s), ";
			}
			elseif ($x == 5) {
				echo "$how_many nickel(s), ";
			}
			else {
				echo "and $how_many cent(s).</p><br>";
			}

			//step to subtract the cent amount from the payment to keep a running tab on the change due

			$payment-=($how_many*$x);
		}


		echo "<h1>Challenge 2: 99 Bottles of Beer</h1>";

		$bottles = 99; //Setting the variable for how many bottles we need to pass

		#Using a for loop to subtract one bottle from the running total is one way to do this. By doing this, we only need two echo statements. One line uses the variables $i—which is the number of beers to start with—and $next, which is the next number of beers to print. We need the other echo statement because once there is only one more bottle to pass, we cannot print the word "bottles" as a plural.

		for ($i = $bottles; $i>0; $i--) {
			$next =$i-1;
			if ($i == 1) { //check to see if there is only one left. If so, print this line
				echo "<p>1 bottle of beer on the wall, 1 bottle of beer!<br>Take one down, pass it around, <a target = \"_blank\">0 bottles of beer on the wall!</a></p>";
			}
			else {
				echo "<p>$i bottles of beer on the wall, $i bottles of beer!<br>Take one down, pass it around, $next bottles of beer on the wall!</p>";
			}
		}



	 ?>

</body>
</html>