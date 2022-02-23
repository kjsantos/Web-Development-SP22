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
		  letter-spacing: 1.5px;
		}
		div.price {
		  font-family: Quattrocento, serif;
		  font-size: 24px;
		  text-decoration: underline;
		  color: red;

		}
		div.button {
			height: 10em;
			align-items: center;
		}
		div.card {
			font-family: Quattrocento, serif;
			height: 5em;
			width: 20em;
			text-align: center;
			font-size: 20px;

		}
	</style>
</head>
<body>

	<h1><br>Challenge: Book Lists<br></h1>


	<?php 

		$books = array(array("PHP and MySQL Web Development", "Luke Welling", 144, "Paperback", 31.63), 
			array("Web Design with HTML, CSS, JavaScript and jQuery", "Jon Duckett", 135, "Paperback", 41.23),
			array("PHP Cookbook: Solutions & Examples for PHP Programmers", "David Sklar", 14, "Paperback", 40.88),
			array("JavaScript and JQuery: Interactive Front-End Web Development", "Jon Duckett", 251, "Paperback", 22.09),
			array("Modern PHP: New Features and Good Practices", "Josh Lockhart", 7, "Paperback", 28.49),
			array("Programming PHP", "Kevin Tatroe", 26, "Paperback", 28.96));

		$headers = array("Title", "Author", "Number of Pages", "Type", "Price");
		$counter = 1;
		$price = 0;

		echo "
		<table class = \"table table-striped table-dark\">
			<thead>
				<tr>";
				foreach ($headers as $col) { echo "
					<th scope=\"col\">$col</th>";
				} echo "
				</tr>
			</thead>
			<tbody>";
			foreach ($books as $book) { echo "
			<tr>
				<td><a href = \"https://www.google.com/search?q=".urlencode($book[0])."\" target= \"_blank\">$book[0]</a></td>
				<td>$book[1]</td>
				<td>$book[2]</td>
				<td>$book[3]</td>
				<td>\$$book[4]</td>
			</tr>";
			$counter++;
			$price+=$book[4];
			} echo "
			</tbody>
		</table><br>
		<div class = \"card text-center mx-auto\">
			<div class = \"card-body\">
			Your total price is<br>
			<div class=\"price\">\$$price</div>
			</div>
		</div>";		



		
			
		



	?>
	<h1><br>Challenge 2B: Two in a Row</h1>

	<?php

		function in_a_row ($count) {
			echo "<br><div class=\"container\" style=\"width: 50rem;\"><div class=\"row\"><div class=\"col text-center\"><p>Beginning the coin flipping...</p>";
			$how_many = 0;
			$tries = 0;
			while ($how_many!=$count) {
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

		in_a_row(8);

	?>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>