<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
    }
    
	include_once 'DBConnector.php';

	if($_SERVER['REQUEST_METHOD'] !== 'POST'){
		header('HTTP/1.0 403 Forbidden');
		echo 'You are forbidden';
	}else{
		$api_key = null;
		$api_key = generateApiKey(64);
		header ('Content-type: application/json');
		echo generateResponse($api_key);
	}


	function generateApiKey($str_length){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

		$repl = unpack('C2', $bytes);

		$first = $chars[$repl[1]%62];
		$second = $chars[$repl[2]%62];
		return strtr(substr(base64_encode($bytes),0,$str_length), '+/', "$first$second");
	}

	function saveApiKey(){
		//WRITE THE F(x) THAT SAVES THE API FOR USER RETURNS TRUE IF SAVED, FALSE OTHERWISE
	}

	function fetchUserApiKey(){
		
	}

	function generateResponse($api_key){
		if(saveApiKey()){
			$res = ['success' => 1, 'message' => $api_key];
		}else{
			$res = ['success' => 0, 'message' => 'Something went wrong. Please generate the API key'];
		}
		return json_encode($res);
	}



?>
<html>
    <head>
        <title>Private Page</title>
            <script src="jquery-3.1.1.min.js"></script>
            <script type="text/javascript" src="validate.js"></script>
            <script type="text/javascript" src="apikey.js"></script>
            <link rel="stylesheet" type="text/css" href="validate.css">
            <!---Bootstrap file-->
            <!---js-->
            <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
            <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


            <!---css-->
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
        <p align='right'><a href="logout.php">Logout</p>
        <hr>
        <h3>Here, we will create an API that will allow Users/Developer to order items from external systems</h3>
        <hr>
        <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

        <button class="btn btn-primary" id="api-key-btn">Generate API key</button><br> <br>
        <!----This text area will hold the API key-->
        <strong>Your API key:</strong>(Note that if your API key is already in use b already running applications,generating a new key will stop the application from functioning)<br>
        <textarea cols="100" row="2" id="api_key" readonly><?php echo fetchUserApiKey();?></textarea>
        <h3>Service Description:</h3>
        We have a service/API that allows external applications to order food and also pull all order status by using order id. Lets do it.
        <hr>
    </body>
</html>
