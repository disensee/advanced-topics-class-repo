<?php
include_once("../includes/config.inc.php");
include_once("../includes/dataaccess/ContactDataAccess.inc.php");


$method = $_SERVER['REQUEST_METHOD'];

if($method == "GET"){
	doGet();
}else if($method == "POST"){
	doPost();
}else if($method == "PUT"){
	doPut();
}else if($method == "DELETE"){
	doDelete();
}else{
	header("HTTP/1.1 404 Not Found");
}

function doGet(){
	//for getting contacts
	//getAll() or getById()
	$da = new ContactDataAccess(get_link());
	
	if(isset($_GET['contactId'])){
		$id = $_GET['contactId'];
		$contact = $da->getById($id);
		$json = $contact->toJSON();
		header("Content-Type: application/json");
		header("HTTP/1.1 200 OK");
		echo($json);
		die();
	}else{
		$contacts = $da->getAll();
		$json = json_encode($contacts); //Converts objects to JSON string
		header("Content-Type: application/json");
		header("HTTP/1.1 200 OK");
		echo($json);
		die();
	}
}

function doPost(){
	// for inserting contacts
	// check for post data in the body of the request
	$request_body = file_get_contents("php://input");
	$assoc = json_decode($request_body, true);
	//var_dump($assoc);
	$contact = new Contact($assoc);
	$da = new ContactDataAccess(get_link());
	$contact = $da->insert($contact);
	header("Content-Type: application/json");
	header("HTTP/1.1 200 OK");
	echo($contact->toJSON());
	die();
}

function doPut(){
	// for updating contacts
	// check for data in the body of the request
	 
}

function doDelete(){
	// for deleting contacts
	 
}

?>