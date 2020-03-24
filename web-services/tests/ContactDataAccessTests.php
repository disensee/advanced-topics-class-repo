<?php

// we need the config file to get a connection to the database
include_once("../includes/config.inc.php");
include_once("../includes/dataaccess/ContactDataAccess.inc.php");


$testResults = array();

testConstructor();
testSanitizeHtml();
testConvertDateForMySQL();
testCleanDataGoingIntoDB();
testCleanDataComingFromDB();
testGetById();
testGetAll();
testInsert();
testUpdate();
testDelete();

echo(implode($testResults,"<br>"));

function testConstructor(){

	global $testResults;
	$testResults[] = "<h3>TESTING constructor...</h3>";

	// TEST 1 - create an instance of the ConcactDataAccess class
	$da = new ContactDataAccess(get_link());
	
	if($da){
		$testResults[] = "PASS - Created instance of ContactDataAccess";
	}else{
		$testResults[] = "FAIL - DID NOT creat instance of ContactDataAccess";
	}
}

function testSanitizeHtml(){
	
	global $testResults;
	$testResults[] = "<h3>TESTING sanitizeHtml()...</h3>";
	
	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());

	// TEST 1 - Make sure it removes 'script' tags from the HTML string
	$dirtyHtml = "<h3><script>some script</sript></h3>";
	$expectedResult = "<h3>some script</h3>";
	$actuallResult = $da->sanitizeHtml($dirtyHtml);
	
	if($expectedResult == $actuallResult){
		$testResults[] = "PASS - Removed script tag from HTML string";
	}else{
		$testResults[] = "FAIL - DID NOT remove script tag from HTML string";
	}

	// TEST X - MORE TESTS TO DO...make sure it removes other tags and malicious attributes
}


function testConvertDateForMySQL(){
	global $testResults;
	$testResults[] = "<h3>TESTING convertDateForMySQL()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());

	// TEST 1 - Make sure it removes 'script' tags from the HTML string
	$stringToFormat = "2/1/2020";
	$expectedResult = "2020-02-01";
	$actuallResult = $da->convertDateForMySQL($stringToFormat);

	if($expectedResult == $actuallResult){
		$testResults[] = "PASS - Formatted 2/1/202 into 2020-02-01";
	}else{
		$testResults[] = "FAIL - DID NOT format 2/1/202 into 2020-02-01";
	}
}


function testCleanDataGoingIntoDB(){
	global $testResults;
	$testResults[] = "<h3>TESTING cleanDataGoingIntoDB()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());

	
	// TEST 1 - Make sure that id property is 'cleaned' properly
	// We need a contact model object to pass in as a param
	$contact = new Contact([
		'id' => "1';DROP TABLE users;"
	]);

	$cleanContact = $da->cleanDataGoingIntoDB($contact);
	$expectedResult = "1\';DROP TABLE users;"; // The single quote should be escaped
	$actuallResult = $cleanContact->id;
	
	if($expectedResult == $actuallResult){
		$testResults[] = "PASS - Properly cleaned the id propety";
	}else{
		$testResults[] = "FAIL - DID NOT properly cleaned the id property";
	}


	// MORE TESTS.....test to make sure each property of a contact object is 'cleaned'


}

function testCleanDataComingFromDB(){
	global $testResults;
	$testResults[] = "<h3>TESTING cleanDataComingFromDB()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());

	// TEST 1 - Make sure to clean malicious HTML from the firstName column
	// We need to simulate a row coming from the database (as an associative array)
	// There should be malicious HTML in one of the values
	$row = [
		'id' => 1,
		'firstName' => "Bob<script>location.href='www.badsite.com'</script>",
		'lastName' => "Smith",
		'email' => "bob@smith.com",
		'phone' => "555-555-5555"
	];

	$cleanRow = $da->cleanDataComingFromDB($row);
	$expectedResult = "Bob&lt;script&gt;location.href='www.badsite.com'&lt;/script&gt;";
	// notice that we expect the < and > characters to be replaced with &lt; and &gt'
	$actuallResult = $cleanRow['firstName'];
	
	if($expectedResult == $actuallResult){
		$testResults[] = "PASS - Properly removed script element from the firstName property";
	}else{
		$testResults[] = "FAIL - DID NOT properly removed script element from the firstName property";
	}

}

function testGetById(){
	global $testResults;
	$testResults[] = "<h3>TESTING getById()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());
	$contact = $da->getById(1);
	//var_dump($contact);
}

function testGetAll(){
	global $testResults;
	$testResults[] = "<h3>TESTING getAll()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());
	$contacts = $da->getAll();
	//var_dump($contacts);
}

function testInsert(){
	global $testResults;
	$testResults[] = "<h3>TESTING insert()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());
	$contact = new Contact([
		"firstName" => "Billy",
		"lastName" => "West",
		"email" => "bw@bw.com",
		"phone" => "555-555-5555"
	]);

	//$newContact = $da->insert($contact);

	//var_dump($newContact);
}

function testUpdate(){
	global $testResults;
	$testResults[] = "<h3>TESTING update()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());
	
	$contactToUpdate = $da->getById(1);
	$contactToUpdate->firstName = "Jerry";
	$contactToUpdate = $da->update($contactToUpdate);

	//var_dump($contactToUpdate);

}

function testDelete(){
	global $testResults;
	$testResults[] = "<h3>TESTING delete()...</h3>";

	// We need an instance of a ContactDataAccess object so that we can call the method we want to test
	$da = new ContactDataAccess(get_link());
	$contactDeleted = $da->delete(6);

	var_dump($contactDeleted);
}


?>