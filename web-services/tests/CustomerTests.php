<?php
include_once("../includes/models/Customer.inc.php");

$testResults = array();

constructorTest();
isValidTest();

echo(implode($testResults, "<br />"));

function constructorTest(){
    global $testResults;
    $testResults[] = "<h3>Testing constructor...</h3>";

    //Test to ensure a customer object can be made
    $cust = new Customer();

    if($cust){
        $testResults[] = "PASS - Created instance of Customer model object";
    }else{
        $testResults[] = "FAIL - Unable to create instance of Custmoer model object";
    }

    //Testing if first name gets set properly
    $options = array('firstName' => "Dylan");

    $cust = new Customer($options);

    if($cust->firstName == "Dylan"){
        $testResults[] = "PASS - Set firstName properly";
    }else{
        $testResults[] = "FAIL - Did not set firstName properly";
    }
}

function isValidTest(){
    global $testResults;
    $testResults[] = "<h3>Testing isValid()...</h3>";

    //Test 1 - returns false if first name is empty
    $cust = new Customer(array(
        'firstName' => "",
        'lastName' => "Bufano",
        'address' => "523 Colgate Ln",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "90210",
        'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid empty firstName properly";
    }else{
        $testResults[] = "FAIL - Did not validate empty firstName properly";
    }

    //Test 2 - returns false if last name is empty
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "",
        'address' => "523 Colgate Ln",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "90210",
        'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid empty lastName properly";
    }else{
        $testResults[] = "FAIL - Did not validate empty lastName properly";
    }

    //Test 3 - returns false if address is empty
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "Bufano",
        'address' => "",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "90210",
        'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid empty address properly";
    }else{
        $testResults[] = "FAIL - Did not validate empty address properly";
    }

    //Test 4 - returns false if city is empty
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "Bufano",
        'address' => "523 Colgate Ln",
        'city' => "",
        'state' => "California",
        'zip' => "90210",
        'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid empty city properly";
    }else{
        $testResults[] = "FAIL - Did not validate empty city properly";
    }

    //Test 5 - returns false if state is empty
    $cust = new Customer(array(
    'firstName' => "Paul",
    'lastName' => "Bufano",
    'address' => "523 Colgate Ln",
    'city' => "Los Angeles",
    'state' => "",
    'zip' => "90210",
    'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid empty state properly";
    }else{
        $testResults[] = "FAIL - Did not validate empty state properly";
    }

    //Test 6 - returns false if zip is empty
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "Bufano",
        'address' => "523 Colgate Ln",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "",
        'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid empty zip properly";
    }else{
        $testResults[] = "FAIL - Did not validate empty zip properly";
    }

    //Test 7 - returns false if zip is less than 5 digits
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "Bufano",
        'address' => "523 Colgate Ln",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "9021",
        'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid zip format properly";
    }else{
        $testResults[] = "FAIL - Did not validate zip format properly";
    }

    //Test 8 - returns false if email is empty
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "Bufano",
        'address' => "523 Colgate Ln",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "90210",
        'email' => ""
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid empty email properly";
    }else{
        $testResults[] = "FAIL - Did not validate empty email properly";
    }

    //Test 9 - returns false if email is invalid format
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "Bufano",
        'address' => "523 Colgate Ln",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "90210",
        'email' => "foo"
    ));

    if($cust->isValid() === false){
        $testResults[] = "PASS - Validated invalid email format properly";
    }else{
        $testResults[] = "FAIL - Did not validate email format properly";
    }

    //Test 10 - should return true for valid customer object
    $cust = new Customer(array(
        'firstName' => "Paul",
        'lastName' => "Bufano",
        'address' => "523 Colgate Ln",
        'city' => "Los Angeles",
        'state' => "California",
        'zip' => "90210",
        'email' => "pbufano@gmail.com"
    ));

    if($cust->isValid()){
        $testResults[] = "PASS - Validated customer object properly";
    }else{
        $testResults[] = "FAIL - Did not validate customer object properly";
    }

}
?>


    
