<?php
include_once('DataAccess.inc.php');
include_once(__DIR__ . "/../models/Contact.inc.php"); // I had problems including this file, not sure why!

class ContactDataAccess extends DataAccess{


	// CONSTRUCTOR

	function __construct($link){

		parent::__construct($link);
	
	}

	/**
	* 'Cleans' the data in a Contact object to prevents SQL injection attacks
	* @param {Contact}	A contact model object
	* @return {Contact} A new instance of Contact object with clean data in it
	*/
	function cleanDataGoingIntoDB($contact){
		$cleanContact = new Contact();
		$cleanContact->id = mysqli_real_escape_string($this->link, $contact->id);
		$cleanContact->id = mysqli_real_escape_string($this->link, $contact->id);
		$cleanContact->id = mysqli_real_escape_string($this->link, $contact->id);
		$cleanContact->id = mysqli_real_escape_string($this->link, $contact->id);

		return $cleanContact;
	}
	
	/**
	* 'Cleans' the data in a row from the database (a row should be an associative array)
	* @param {array}	An associative array with key value pairs for each column in the table
	* @return {array} 	A new associative array with clean data in it
	*/
	function cleanDataComingFromDB($row){
		$cleanRow = [];
		$cleanRow['id'] = htmlentities($row['id']);
		$cleanRow['firstName'] = htmlentities($row['firstName']);
		$cleanRow['lastName'] = htmlentities($row['lastName']);
		$cleanRow['email'] = htmlentities($row['email']);
		$cleanRow['phone'] = htmlentities($row['phone']);

		return $cleanRow;
	}

	/**
	* Gets all contacts from a table in the database
	* @param {assoc array} 	This optional param would allow you to filter the result set
	* 						For example, you could use it to somehow add a WHERE claus to the query
	* 
	* @return {array}		Returns an array of Contact objects
	*/
	function getAll($args = []){
		// TODO: implement the code for this method
		// Make sure to clean the data coming from the database
	}


	/**
	* Gets a Contact from the database by it's id
	* @param {number} 	The id of the item to get from a row in the database
	* @return {Contact}	 Returns an instance of a Contact model object
	*/
	function getById($id){
		// TODO: implement the code for this method
		// Make sure to clean the data coming from the database
		// How should we handle cleaning the id from SQL injection, can't call cleanDataGoingIntoDB unless we have a contact obj?
	}

	
	/**
	* Inserts a contact into a table in the database
	* @param {Contact}	The Contact object to be inserted
	* @return {Contact}	Returns the same Contact object, but with the id property set (the id is assigned by the database)
	*/
	function insert($contact){
		// TODO: implement the code for this method
		// Make sure to clean the data going into the database
	}

	/**
	* Updates a Contact in the database
	* @param {Contact}	The Contact model object to be updated
	* @return {Contact}	Returns the same Contact model object that was passed in as the param
	*/
	function update($contact){
		// TODO: implement the code for this method
		// Make sure to clean the data going into the database
	}


	/**
	* Deletes a Contact from a table in the database
	* @param {number} 	The id of the contact to delete
	* @return {boolean}	Returns true if the row was sucessfully deleted, false otherwise
	*/
	function delete($id){
		// TODO: implement the code for this method
		// Make sure to clean the data going into the database????
	}
	



} 