<?php

//When running regular expressions, you can 'capture' data from strings that match the pattern.

$string = "products/7";               // The string to test
$pattern = '/^products\/([0-9]*)$/';   // The pattern - the () encloses the part of the match that we want to capture
$matches = null;                      // Used to capture data from the matching string

//$string = "blah-products/7/111/fooo";
//$pattern = '/products\/([0-9]*)\/([0-9])*/';   //notice that we removed the ^ and $ from the pattern   

preg_match($pattern, $string, $matches);

// $matches will be an array
// The first item in the array will be the entire string that matches the pattern you are looking for
// the remaining elements will contain the captured data

var_dump($matches);

?>