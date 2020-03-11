<?php

// we need the config file to get a connection to the database
include_once("../includes/config.inc.php");

// TEST 1
// test the get_link() to make sure it returns a valid connection to the propeer database
$link = get_link();
//var_dump($link);


// TEST 2
// test the exception handler function
//throw new Exception("We can throw potential problems to our custom exception handler");


// TEST 3
// test the the error handler function
//include("blah.php");

// QUESTIONS:
// How does the get_link() method get the information it needs to connect to the database?
// In other words, where does it get the db user acoount, password, host, and database name

// The get_linK() function 'wraps' a built-in php function for connecting to the database. 
// What is the name of that function? 
// In other words, what php function would you use to connect to a MySQL database?
// Explain the parameters that you pass into the function.


// What does the define() function in php do? 

// Explain how the config file can 'auto-detect' the environment (whether the code is running in DEV vs your live web server) 

// Explain the difference between an exception and an error.
?>