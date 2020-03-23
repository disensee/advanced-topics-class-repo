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

		if($contact instanceOf Contact){
			$cleanContact = new Contact();
			$cleanContact->id = mysqli_real_escape_string($this->link, $contact->id);
			$cleanContact->firstName = mysqli_real_escape_string($this->link, $contact->firstName);
			$cleanContact->lastName = mysqli_real_escape_string($this->link, $contact->lastName);
			$cleanContact->email = mysqli_real_escape_string($this->link, $contact->email);
			$cleanContact->phone = mysqli_real_escape_string($this->link, $contact->phone);

			return $cleanContact;
		}else{
			$cleanParam = mysqli_real_escape_string($this->link, $contact);
			return $cleanParam;
		}
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
		$qStr = "SELECT id, firstName, lastName, email, phone FROM contacts";
		//die($qStr);

		//Many people run queries like this. Shows error messages to users. 
		//$result = mysqli_query($this->link, $qStr) or die(mysqli_error($this->link));
		$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

		$allContacts = [];
		if(mysqli_num_rows($result)){
			while($row = mysqli_fetch_assoc($result)){
				$cleanRow = $this->cleanDataComingFromDB($row);
				$contact = new Contact($cleanRow);

				$allContacts[] = $contact;
			}
		}
		return $allContacts;
	}


	/**
	* Gets a Contact from the database by it's id
	* @param {number} 	The id of the item to get from a row in the database
	* @return {Contact}	 Returns an instance of a Contact model object
	*/
	function getById($id){
		$cleanId = $this->cleanDataGoingIntoDB($id);
		$qStr = "SELECT id, firstName, lastName, phone, email FROM contacts WHERE id = $cleanId";

		$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			$cleanRow = $this->cleanDataComingFromDB($row);
			$contact = new Contact($cleanRow);
			return $contact;
		}

		return false;
	}

	
	/**
	* Inserts a contact into a table in the database
	* @param {Contact}	The Contact object to be inserted
	* @return {Contact}	Returns the same Contact object, but with the id property set (the id is assigned by the database)
	*/
	function insert($contact){
		$cleanContact = $this->cleanDataGoingIntoDB($contact);
		$qStr = "INSERT INTO contacts (firstName, lastName, email, phone) VALUES (
			'{$cleanContact->firstName}',
			'{$cleanContact->lastName}',
			'{$cleanContact->email}',
			'{$cleanContact->phone}'
		)";

		$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

		if($result){
			$cleanContact->id = mysqli_insert_id($this->link);
		}else{
			$this->handleError("Unable to insert contact");
		}

		return $cleanContact;
	}

	/**
	* Updates a Contact in the database
	* @param {Contact}	The Contact model object to be updated
	* @return {Contact}	Returns the same Contact model object that was passed in as the param
	*/
	function update($contact){
		$cleanContact = $this->cleanDataGoingIntoDB($contact);
		$qStr = "UPDATE contacts SET 
				firstName = '{$cleanContact->firstName}',
				lastName = '{$cleanContact->lastName}',
				email = '{$cleanContact->email}',
				phone = '{$cleanContact->phone}'
				WHERE id = '{$cleanContact->id}'";

		$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

		return $cleanContact;
	}


	/**
	* Deletes a Contact from a table in the database
	* @param {number} 	The id of the contact to delete
	* @return {boolean}	Returns true if the row was sucessfully deleted, false otherwise
	*/
	function delete($id){
		$cleanId = $this->cleanDataGoingIntoDB($id);
		$qStr = "DELETE FROM contacts WHERE id = $cleanId";
		$result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

		if(mysqli_affected_rows($this->link) == 1){
			return true;
		}

		return false;

	}
	



} 