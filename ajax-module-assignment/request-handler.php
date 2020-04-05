<?php
//header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//sleep(8); // We'll uncomment this when we start using AJAX



//////////////////// STEP 1 - REQUESTS ///////////////////////////////////////
/*
// HERE'S HOW YOU CAN GET ALL THE INFORMATION ABOUT A REQUEST IN PHP...

$_SERVER['REQUEST_METHOD'];				Tells you the method/type of request (GET, POST, etc.)
$_SERVER['REQUEST_URI'];				Tells you the URL being requested (include the query string)
file_get_contents('php://input');		This function returns the body of the request
getallheaders();						This function returns an array of all headers in the request
$_GET									This array inlcudes the URL parameters in the query string
$_POST									This array includes all the user input entered into a form
*/


function get_request_data(){

	$str = "";

	$str .= "REQUEST METHOD: {$_SERVER['REQUEST_METHOD']} \n";
	$str .= "REQUEST URI: {$_SERVER['REQUEST_URI']} \n\n";

	$str .= "REQUEST HEADERS...\n";
	$request_headers = getallheaders();
	foreach ($request_headers as $key => $value) {
		$str .= "$key : $value \n";
	}

	if(!empty($_GET)){
		$str .= "\nQUERY STRING PARAMS... \n";
		foreach ($_GET as $key => $value) {
			$str .= "$key : $value \n";
		}
	}

	if(!empty($_POST)){
		echo("\nPOST PARAMS... \n");
		foreach ($_POST as $key => $value) {
			$str .= "$key : $value \n";
		}
	}

	$request_body = file_get_contents('php://input');
	if(!empty($request_body)){
		$str .= "\nREQUEST BODY... \n";
		$str .= $request_body;
	}

	return $str;

}



//////////////////// STEP 2 - Cookies and Sessions ///////////////////////////////////////

/*
// COOKIES AND HTTP
setcookie("username", "bob");

// to delete a cookie:
//setcookie("username", null, time() - 1000);
*/

/*
// SESSIONS AND HTTP
session_start();
*/



//////////////////// STEP 3 - Response Headers (and the response body) //////////////////////////////

// We can use  the developer tools to look at the response headers sent from the server
function set_response_headers(){

	$response_body = "\n\nRESPONSE BODY...\n";
	
	// Setting the status code of an HTTP response in PHP - http://php.net/manual/en/function.header.php
	// All status codes - http://www.restapitutorial.com/httpstatuscodes.html
	
	//header("Invalid request - we can't handle this request", true, 400);


	// Custom response headers
	// You can add your own custom response headers, it used to be recommonded to start custom header names with "X-"
	// But now I'm not so sure:  https://stackoverflow.com/questions/3561381/custom-http-headers-naming-conventions
 
	//header("X-username: Bob");


	// Sending the proper data format and setting the Content-Type header...
	// The request should include an 'Accept' header, which indicates data format that the client expects to receive
	// (this should match the content that is being sent in the response body)
	// Here's a listing of common content-types:
	// https://en.wikipedia.org/wiki/Media_type
	$request_headers = getallheaders();
	if(isset($request_headers['Accept'])){

		$accept_types = explode(",", $request_headers['Accept']);
		
		if(in_array("text/html", $accept_types)){
			// set the content-type RESPONSE header
			header("Content-Type: text/html");
			$response_body .= '<h1>HELLO!</h1>';
		}else if(in_array("application/json", $accept_types)){
			// set the content-type RESPONSE header
			header('Content-Type: application/json');
			$response_body .= '{msg:"HELLO!"}';
		}else if(in_array("application/xml", $accept_types)){
			// set the content-type RESPONSE header
			header('Content-Type: application/xml');
			$response_body .= '<message>HELLO!</message>';
		}
	}

	return $response_body;
}

$request_data = get_request_data();
$response = set_response_headers();
echo($request_data . $response);
die();


?>
