<?php

$method = $_SERVER['REQUEST_METHOD'];
$url_path = $_GET['url_path'] ?? ""; // the url_path querystring gets appended per the .htaccess file
//die($url_path);
// NOTE that the url_path will be the part of the url that comes after "contacts/"

/*
// prevent requests from being cached in the browser
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
*/

///////////////////////////////////
// Handle the Request
///////////////////////////////////
// This IF statement will check to see if the requested URL (and method) is supported by this web service
// If so, then we need to formulate the proper response, if not then we return a 404 status code

switch($method){
  case "GET":
    
    if(empty($url_path)){
      die("GET REQUEST for contacts/");
    }else if(preg_match('/^([0-9]*\/?)$/', $url_path, $matches)){ 
      $contact_id = $matches[1];
      die("GET REQUEST for contacts/" . $contact_id);
    }else{
      die("INVALID REQUEST to ". $url_path);
    }
    
    break;

  case "POST":

    if(empty($url_path)){
      die("POST REQUEST to insert contacts/");    
    }else{
      die("INVALID POST REQUEST TO: $url_path");
    }

    break;

  case "PUT":

    if(preg_match('/^([0-9]*\/?)$/', $url_path, $matches)){
        
      $contact_id = $matches[1];
      die("PUT REQUEST to update contacts/" . $contact_id);
    }else{
      die("INVALID PUT REQUEST TO " . $url_path);
    }

    break;

  case "DELETE":
    
    if(preg_match('/^([0-9]*\/?)$/', $url_path, $matches)){
      // Get the id of the task from the URL (via regular expression)
      $contact_id = $matches[1];
      die("DELETE REQUEST to delete contacts/" . $contact_id);
    }else{
      die("INVALID DELETE REQUEST TO " . $url_path);
    }

    break;
  case "OPTIONS":

    // To allow the 'preflight' checks to work,
    header('HTTP/1.1 200', true, 200);

    break;
  default:

    header('HTTP/1.1 404 Not Found', true, 404);
    die("We're sorry, we can't find this page: {$_SERVER['REQUEST_URI']}");

}

?>