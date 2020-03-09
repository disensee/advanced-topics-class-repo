<?php

// AFTER WE DO THIS ACTIVITY, THE STUDENTS NEED TO DO A LOT OF 
// PRACTICE!!
// I NEED A GOOD FOLLOW ASSIGNMENT WITH LOTS OF PROBLEMS
// MAYBE THEY SHOULD MAKE A REFERENCE SHEET THAT COMPARES PHP AND JS BASICS

// there are two types of arrays in php:
// Associative and Indexed


// create an INDEXED array
$ar1 = array();
$ar1[] = "hello";
$ar1[] = "world";

// dump out the array
//var_dump($ar1);

// echo out the first element in the array
//echo($ar1[0]); //prints the element at index 1 of the array

// add an element to an array
$ar1[2] = "!";

// change an element in an array
$ar1[0] = "GOOD BYE";



// populate an array by adding params to the array() method
$ar2 = array("hello", "world");


// ASSOCIATIVE ARRAYS - USE STRINGS FOR THE INDEX (KEY VALUE PAIRS)
// Let's create an associative array...
$ar3 = array();
$ar3['name'] = "Bob";  // 'name' is the KEY, 'Bob' is the VALUE
$ar3['age'] = "21";
$ar3['likes-pizza'] = true;
$ar3['gender'] = "Male";

// Dump out $ar3
//var_dump($ar3);

// Another way to create and ASSOCIATIVE array:
$ar4 = array(
	'key1' => "value1", 
	'key2' => "value2" 
);


// loop through an array
/*
foreach ($ar2 as $x) {
	echo($x . "<br>");
}
*/

// loop through an associative array
/*
foreach ($ar3 as $key => $value) {
	echo("KEY: {$key}    VALUE: {$value} <br>");
}
*/


// multi-deminsional array
/*
$ar5 = array(
	array("COLUMN1", "COLUMN2"),
	array("Bob", "JONES")
);
*/

// another way to creat a multi-dimensional array
/*
$rows = array(); 
$rows[] = array("name" => "Bob", "age" => 21);
$rows[] = array("name" => "Sally", "age" => 31);

var_dump($rows);
*/


// For loop using count() function
/*
$ar6 = array("Bob", "Sally", "Mark", "Betty");
for($x = 0; $x < count($ar6); $x++){
	echo($ar6[$x] . "<br>");
}
*/

// check to see if a variable is an array with is_array()
/*
if(is_array($ar6)){
	echo('$ar6 is an array');
}else{
	echo("$ar6 is not an array");
}
*/

// the implode() function
/*
$ar7 = array("Bob", "Sally", "Mark", "Betty");
echo(implode("<br>", $ar7));
*/

// the explode() function
/*
$someString = "Bob, Sally, Mark, Betty";
$ar8 = explode(",", $someString);
var_dump($ar8);
*/

// NOTE - You can use braket notation too (instead of array())
$employees = [
	["firstName" => "Bob", "lastName" => "Smith"],
	["firstName" => "Betty", "lastName" => "Jones"]
];

var_dump($employees);

?>