<?php
// we need the config file to get a connection to the database
include_once("../includes/config.inc.php");
include_once("../includes/dataaccess/DataAccess.inc.php");


// Since we can't instantiate the DataAccess class (because it's abstract)
// We'll create a sub class that we CAN instantiate,
// then test the methods of the DataAccess class
class TestDataAccess extends DataAccess{

	function cleanDataGoingIntoDB($data){ 
		// DO NOTHING
	}

	function cleanDataComingFromDB($row){ 
		// DO NOTHING
	}

	function getById($id){ 
		// DO NOTHING
	}

	function getAll($args = []){ 
		// DO NOTHING
	}

	function insert($obj){ 
		// DO NOTHING
	}

	function update($obj){ 
		// DO NOTHING
	}

	function delete($id){ 
		// DO NOTHING
	}

}

// RUN THE TEST FUNCTIONS
$testResults = array();

testConstructor();
testSanitizeHtml();
testConvertDateForMySQL();

echo(implode($testResults,"<br>"));


// HERE ARE THE TEST FUNCTIONS
function testConstructor(){

	global $testResults;
	$testResults[] = "<h3>TESTING constructor...</h3>";

	// TEST 1 - create an instance of the ConcactDataAccess class
	$da = new TestDataAccess(get_link());
	
	if($da){
		$testResults[] = "PASS - Created instance of TestDataAccess";
	}else{
		$testResults[] = "FAIL - DID NOT creat instance of TestDataAccess";
	}
}

function testSanitizeHtml(){
	
	global $testResults;
	$testResults[] = "<h3>TESTING sanitizeHtml()...</h3>";
	
	// We need an instance of a TestDataAccess object so that we can call the method we want to test
	$da = new TestDataAccess(get_link());

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

	// We need an instance of a TestDataAccess object so that we can call the method we want to test
	$da = new TestDataAccess(get_link());

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


?>