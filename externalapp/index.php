<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>TITLE</title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="placeorder.js"></script>

	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css.map">
</head>
<body>
	<h3>It is time to communicate with the exposed API, all we need is the API key to be assed in the header</h3>
	<h4>1. Feature 1 - Placing an order</h4>
	<hr>
	<form name="order_form" id="order_form">
		<fieldset>
			<legend>
				Placeholder
			</legend>
			<input type="text" name="name_of_food" id="name_of_food" placeholder="name of food" required/><br>
			<input type="number" name="number_of_units" placeholder="number of units" required/><br>
			<input type="number" name="unit_price" placeholder="unit price" required/><br><br>
			<input type="hidden" name="status" id="status" placeholder="unit price" value="order placed" required>
			<button class="btn btn-primary" type="admit">Place order</button>
		</fieldset>
	</form>

	<hr>
	<h4>2. Feature 2 - Checking order status</h4>
	<hr>
		<form name="order_status_form" id="order_status_form" method="post" action="<?=$_SERVER['PHP_SELF']?>" >
			<fieldset>
				<legend>
					Check order status
				</legend>
				<input type="number" name="order_id" placeholder="order ID" required><br><br>
				<button class="btn btn-warning" type="submit">Check order status</button>
			</fieldset>
		</form>

</body>
</html>