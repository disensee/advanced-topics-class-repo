<?php

$secretPassword = "advTopicsFinal321";
$request_method = $_SERVER['REQUEST_METHOD'];

if($request_method == "POST"){

	if($_POST['password'] == $secretPassword){
		session_start(); // this will add a header to the reponse to set the phpsessid cookie
		$_SESSION['authenticated'] = "yes";
		setcookie("authenticated", "yes", 0, "/");
		header("Location: customers.html");
		die();
	}

}else if($request_method == "OPTIONS"){

	$headers = getallheaders(); // gets an assoc array of the request headers
	$passwordSent = $headers['Authentication'] ?? null;
	if($passwordSent == $secretPassword){
		session_start(); // this will add a header to the reponse to set the phpsessid cookie
		$_SESSION['authenticated'] = "yes";
	  	header('HTTP/1.0 200 You have been authenticated');
	  	die();
	}else{
		header('HTTP/1.0 401 You are not authorized to use this web service');
	  	die();
	}

}elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
	// destroy the session when a user visits the login page
	// the session will get created again when they log in

	// destroy the session cookie (the name is usually phpsessid but to be safe use session_name())
	if (isset( $_COOKIE[session_name()])){
		setcookie( session_name(), "", time()-3600, "/" );
	}

	setcookie("authenticated", "", time()-3600, "/");
	//empty the $_SESSION array to reset all the session variables.
	$_SESSION = array();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="h-100 d-flex justify-content-center align-items-center">
		<div class="w-25 jumbotron">
			<form method="POST">
				<label for="txtPassword"><h5>Password:</h5></label>
				<input id="txtPassword" type="password" class="form-control" name="password">
				<br>
				<input type="submit" class="btn btn-outline-primary" value="LOG IN">
			</form>
		</div>
	</div>
</body>
</html>