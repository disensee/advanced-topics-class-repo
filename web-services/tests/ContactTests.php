<?php
include_once("../includes/models/Contact.inc.php");


$testResults = array();

testConstructor();
testIsValid();

echo(implode($testResults,"<br>"));

function testConstructor(){
	global $testResults;
	$testResults[] = "<h3>Testing constructor...</h3>";

	// TEST 1 - Make sure we can create a Contact object
	$c = new Contact();
	
	if($c){
		$testResults[] = "PASS - Created instance of Contact model object";
	}else{
		$testResults[] = "FAIL - DID NOT creat instance of a Contact model object";
	}

	// TEST - Make sure the firstName property gets set correctly
	$options = array(
		'firstName' => "Betty"
	);

	$c = new Contact($options);

	if($c->firstName == "Betty"){
		$testResults[] = "PASS - Set firstName properly";
	}else{
		$testResults[] = "FAIL - DID NOT set firstName properly";
	}




}

function testIsValid(){
	global $testResults;
	$testResults[] = "<h3>Testing isValid()...</h3>";

	
	// TEST 1 - It should return false if the first name is empty
	$c = new Contact(array(
		'firstName' => "",
		'lastName' => "Smith",
		'phone' => "555-555-5555",
		'email' => "bob@bobsmith.com"
	));

	if($c->isValid() === false){
		$testResults[] = "PASS - Validated invalid empty firstName properly";
	}else{
		$testResults[] = "FAIL - DID NOT validate empty firstName properly";
	}

	// TEST 2- It should return false if the last name is empty
	$c = new Contact(array(
		'firstName' => "Bob",
		'lastName' => "",
		'phone' => "555-555-5555",
		'email' => "bob@bobsmith.com"
	));

	if($c->isValid() === false){
		$testResults[] = "PASS - Validated invalid empty lasName properly";
	}else{
		$testResults[] = "FAIL - DID NOT validate empty lastName properly";
	}

	// TEST 3 - It should return false if the email is empty
	$c = new Contact(array(
		'firstName' => "Bob",
		'lastName' => "Smith",
		'phone' => "555-555-5555",
		'email' => ""
	));

	if($c->isValid() === false){
		$testResults[] = "PASS - Validated empty email properly";
	}else{
		$testResults[] = "FAIL - DID NOT validate empty email properly";
	}

	// TEST 4 - It should return false if the email is not valid
	$c = new Contact(array(
		'firstName' => "Bob",
		'lastName' => "Smith",
		'phone' => "555-555-5555",
		'email' => "BLAH"
	));

	if($c->isValid() === false){
		$testResults[] = "PASS - Validated invalid email properly";
	}else{
		$testResults[] = "FAIL - DID NOT validate email properly";
	}


	// TEST 5 - It should return false if the phone is empty
	$c = new Contact(array(
		'firstName' => "Bob",
		'lastName' => "Smith",
		'phone' => "",
		'email' => "bob@bob.com"
	));

	if($c->isValid() === false){
		$testResults[] = "PASS - Validated invalid empty phone properly";
	}else{
		$testResults[] = "FAIL - DID NOT validate empty phone properly";
	}

	// TEST 6 - It should return false if the email is not valid
	$c = new Contact(array(
		'firstName' => "Bob",
		'lastName' => "Smith",
		'phone' => "BLAH",
		'email' => "bob@bob.com"
	));

	if($c->isValid() === false){
		$testResults[] = "PASS - Validated invalid phone properly";
	}else{
		$testResults[] = "FAIL - DID NOT validate phone properly";
	}

	// TEST 7 - It should return true for the following data
	$c = new Contact(array(
		'firstName' => "Bob",
		'lastName' => "Smith",
		'phone' => "555-555-5555",
		'email' => "bob@smith.com"
	));

	if($c->isValid()){
		$testResults[] = "PASS - Validated properly";
	}else{
		$testResults[] = "FAIL - DID NOT validate properly";
	}
}



?>