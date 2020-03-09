<?php
// Step 1 - define a function called 'dump', it should take two params:
// The first param should be a string, the second param should be an associative array.
// The function should generate the following HTML string:
// 		- An h1 that displays the string param
// 		- A table that displays the contents of the associative array (key/value pairs).
// 			The table should have two columns, the first should display the key for each element,
//			and the second column should display the value for each element
//	The function should then return the HTML string

// Step 2 - Use the function you created to 'dump' the contents of the super global arrays in PHP

// Add this php code block when we get to the $_SESSION
// We'll start a session and set a session variable just so that we have some data
// in the $_SESSION array (we'll learn more about sessions later in the course)
session_start();
$_SESSION['user'] = "John";
?>

<form method="POST">
	First Name:<input type="text" name="firstName">
	<br>
	Last Name:<input type="text" name="lastName">
	<br>
	<input type="checkbox" name="acceptTerms" value="yes!">
	Check to accept our terms of service
	<br>
	<input type="submit" value="Submit Form"> 
</form>

<?php
// Here's a good link on super global arrays...
// https://www.w3schools.com/php/php_superglobals.asp

echo(dump("SEVER VARS", $_SERVER));
echo(dump("ENV VARS", $_ENV));
echo(dump("GET VARS", $_GET));
echo(dump("POST VARS", $_POST));

//echo(dump("SESSION VARS", $_SESSION));
//echo(dump("COOKIE VARS", $_COOKIE));

// mention that there are other superglobals too
// we'll use the $_FILE array later in the course


function dump($name, $ar){

	$html = "<h3>$name</h3>";

	if(!empty($ar)){
		$html .= "<table border='1'>";

		foreach($ar as $key => $value){
			$html .= "<tr><td>$key</td><td>$value</td></tr>";
		}

		$html .= "</table>";
	}else{
		$html .= "The array $name is empty";
	}

	return $html;
}

?>



