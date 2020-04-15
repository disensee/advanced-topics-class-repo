<?php

$secretPassword = "test123";
$request_method = $_SERVER['REQUEST_METHOD'];

if($request_method == "POST"){

	if($_POST['password'] == $secretPassword){
		session_start(); // this will add a header to the reponse to set the phpsessid cookie
		$_SESSION['authenticated'] = "yes";
		header("Location: index.html");
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
	//empty the $_SESSION array to reset all the session variables.
	$_SESSION = array();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form method="POST">
		Password:
		<input type="text" name="password">
		<br>
		<input type="submit" value="LOG IN">
	</form>
</body>
</html>